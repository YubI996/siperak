<?php

namespace App\Http\Controllers;

use App\Models\Pokmas;
use App\Models\Kecamatan;
use App\Models\Log as l;
use App\Http\Requests\StorePokmasRequest;
use App\Http\Requests\UpdatePokmasRequest;
use Illuminate\Http\Request;
use Auth;


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
        $kecs = Kecamatan::all();
        return view('pokmases.index', compact('pokmases', 'kecs'));
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
    // public function store(StorePokmasRequest $request)
    public function store(StorePokmasRequest $request)
    {
        $input = $request->all();
        // dd($request->all());
        $save = Pokmas::create($input);
        if($save->id)
        {
            l::create(
                [
                    'action' => 'Membuat pokmas : '.$save->id,
                    'actor' => Auth::id()
                ]
            );
            return back()->with('success', 'Data Pokmas berhasil disimpan.');
        }
        else
        {
            return back()->with('warning', 'Data Pokmas gagal disimpan.');
        }
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
        dd('destroyy');
    }
}
