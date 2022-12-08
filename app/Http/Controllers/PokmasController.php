<?php

namespace App\Http\Controllers;

use App\Models\Pokmas;
use App\Http\Requests\StorePokmasRequest;
use App\Http\Requests\UpdatePokmasRequest;

class PokmasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pokmases = Pokmas::all();
        return view('pokmases.index', compact('pokmases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePokmasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePokmasRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pokmas  $pokmas
     * @return \Illuminate\Http\Response
     */
    public function show(Pokmas $pokmas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pokmas  $pokmas
     * @return \Illuminate\Http\Response
     */
    public function edit(Pokmas $pokmas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePokmasRequest  $request
     * @param  \App\Models\Pokmas  $pokmas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePokmasRequest $request, Pokmas $pokmas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pokmas  $pokmas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pokmas $pokmas)
    {
        //
    }
}
