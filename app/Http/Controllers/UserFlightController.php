<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Flight;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserFlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dateNow = Carbon::now();
        $pagination = 10;
        $result = Flight::where('berangkat', '>=', $dateNow)->paginate($pagination);

        $page = !request('page') ? 1 : request('page');

        return view('user.flight.index', [
            'result' => $result,
            'page' => ($page - 1) * $pagination
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *admin
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function buy(Request $request)
    {
        $result = Flight::findOrFail($request->id);

        return view('user.flight.buy', [
            'result' => $result,
            'flight_id' => $request->id
        ]);
    }

    public function buyStore(Request $request)
    {
        $request->validate([
            'qty' => 'required|numeric',
            'flight_id' => 'required'
        ]);

        ## Get data Flight
        $flight = Flight::findOrFail($request->flight_id);

        $transaksi = new Transaction();
        $transaksi->user_id = Auth::id();
        $transaksi->flight_id = $request->flight_id;
        $transaksi->qty = $request->qty;
        $transaksi->total = $request->qty * $flight->harga;
        $transaksi->status = 'WAITING';
        $transaksi->save();

        return redirect()->route('transaction.index');
    }
}
