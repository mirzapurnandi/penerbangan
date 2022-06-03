<?php

namespace App\Http\Controllers;

use App\Models\Town;
use App\Models\Flight;
use App\Models\Transaction;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 10;
        $result = Flight::paginate($pagination);

        $page = !request('page') ? 1 : request('page');

        return view('admin.flight.index', [
            'result' => $result,
            'page' => ($page - 1) * $pagination
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dropdown_keberangkatan = $this->dropdown('Keberangkatan', 'kota_berangkat');
        $dropdown_tujuan = $this->dropdown('Tujuan', 'kota_tujuan');
        return view('admin.flight.add', [
            'kota_berangkat' => $dropdown_keberangkatan,
            'kota_tujuan' => $dropdown_tujuan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kota_berangkat' => 'required',
            'kota_tujuan' => 'required',
            'berangkat' => 'required|date',
            'tiba' => 'required|date',
            'harga' => 'required|numeric'
        ]);

        $flight = new Flight();
        $flight->kota_berangkat = $request->kota_berangkat;
        $flight->kota_tujuan = $request->kota_tujuan;
        $flight->berangkat = $request->berangkat;
        $flight->tiba = $request->tiba;
        $flight->harga = $request->harga;
        $flight->save();

        return redirect()->route('admin-flight.index')->with('message', '<div class="alert alert-success alert-dismissible">Jadwal Penerbangan Berhasil ditambahkan</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pagination = 10;
        $result = Transaction::where('flight_id', $id)->paginate($pagination);

        $page = !request('page') ? 1 : request('page');

        return view('admin.flight.show', [
            'result' => $result,
            'page' => ($page - 1) * $pagination
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = Flight::findOrFail($id);
        $dropdown_keberangkatan = $this->dropdown('Keberangkatan', 'kota_berangkat', $result->kota_berangkat);
        $dropdown_tujuan = $this->dropdown('Tujuan', 'kota_tujuan', $result->kota_tujuan);
        return view('admin.flight.edit', [
            'result' => $result,
            'kota_berangkat' => $dropdown_keberangkatan,
            'kota_tujuan' => $dropdown_tujuan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kota_berangkat' => 'required',
            'kota_tujuan' => 'required',
            'berangkat' => 'required|date',
            'tiba' => 'required|date',
            'harga' => 'required|numeric'
        ]);

        $flight = Flight::findOrFail($id);
        $flight->kota_berangkat = $request->kota_berangkat;
        $flight->kota_tujuan = $request->kota_tujuan;
        $flight->berangkat = $request->berangkat;
        $flight->tiba = $request->tiba;
        $flight->harga = $request->harga;
        $flight->save();

        return redirect()->route('admin-flight.index')->with('message', '<div class="alert alert-success alert-dismissible">Jadwal Penerbangan Berhasil diperbaharui</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Flight::find($id);
        if ($result->delete()) {
            return redirect()->back()->with('message', '<div class="alert alert-info alert-dismissible">Jadwal Penerbangan terhapus...</div>');
        }
    }

    public function dropdown($label, $name, $selected = false)
    {
        $html = '<select name="' . $name . '" class="form-select" aria-label="' . $label . '">';
        $result = Town::all();
        $html .= '<option value="">== Pilih Kota ==</option>';
        foreach ($result as $key => $val) {
            $select = $val->id == $selected ? 'selected' : '';
            $html .= '<option value="' . $val->id . '" ' . $select . '>' . $val->nama . '</option>';
        }
        $html .= '</select>';
        return $html;
    }

    public function buy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'SUCCESS';
        $transaction->save();
        return back()->withInput();
    }
}
