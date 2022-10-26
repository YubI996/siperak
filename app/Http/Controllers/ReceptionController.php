<?php

namespace App\Http\Controllers;

use App\Models\reception;
use App\Models\History;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('aplikasi.create');
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
            'alasan' => $input['alasan']
        ]);

        return back()->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function show(reception $reception)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\reception  $reception
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
     * @param  \App\Models\reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatereceptionRequest $request, reception $reception)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function destroy(reception $reception)
    {
        //
    }
}
