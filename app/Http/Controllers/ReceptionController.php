<?php

namespace App\Http\Controllers;

use App\Models\Reception;
use App\Models\History;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Rt;
use App\Http\Requests\StorereceptionRequest;
use App\Http\Requests\UpdatereceptionRequest;
use Illuminate\Http\Request;


class ReceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penerima = Reception::with('History')->get();
        return view('receptions.index', compact('penerima'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecs = Kecamatan::all();
        $kels = Kelurahan::all();
        $rts = Rt::all();
        return view('receptions.create', compact('kecs', 'kels', 'rts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorereceptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StorereceptionRequest $request)
    public function store(Request $request)
    {
        $input = $request->all();
        $reception = reception::create($input);
        $history = History::create([
            'reception' => $reception->id,
            'status_trima' => 'Diajukan',
            'alasan' => $input['alasan'],
            'actor' => $input['actor']
        ]);

        return back()->with('success', 'Data penerima berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function show(reception $reception)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function edit(reception $reception)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatereceptionRequest  $request
     * @param  \App\Models\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatereceptionRequest $request, reception $reception)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function destroy(reception $reception)
    {
        //
    }
}
