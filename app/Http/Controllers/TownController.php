<?php

namespace App\Http\Controllers;

use App\Models\Town;
use Illuminate\Http\Request;

class TownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 10;
        $result = Town::paginate($pagination);

        $page = !request('page') ? 1 : request('page');

        return view('admin.town.index', [
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
        return view('admin.town.add');
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
            'nama' => 'required|string'
        ]);

        $town = new Town();
        $town->nama = $request->nama;
        $town->save();

        return redirect()->route('town.index')->with('message', '<div class="alert alert-success alert-dismissible">Kota Berhasil ditambahkan</div>');
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
        $result = Town::find($id);
        return view('admin.town.edit', [
            'result' => $result
        ]);
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
        $request->validate([
            'nama' => 'required|string'
        ]);

        $town = Town::findOrFail($id);
        $town->nama = $request->nama;
        $town->save();

        return redirect()->route('town.index')->with('message', '<div class="alert alert-success alert-dismissible">Kota Berhasil diperbaharui</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Town::find($id);
        if ($result->delete()) {
            return redirect()->back()->with('message', '<div class="alert alert-info alert-dismissible">Kota terhapus...</div>');
        }
    }
}
