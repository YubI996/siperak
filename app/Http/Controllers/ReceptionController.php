<?php

namespace App\Http\Controllers;

use App\Models\Reception;
use App\Models\History;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Rt;

use App\Http\Requests\StoreReceptionRequest;
use App\Http\Requests\UpdateReceptionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ReceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penerima = Reception::with('Histories')->get();
        $kecs = Kecamatan::all();
        return view('receptions.index', compact('penerima', 'kecs'));
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
     * @param  \App\Http\Requests\StoreReceptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StoreReceptionRequest $request)
    public function store(Request $request)
    {
        $this->validate($request, [
            'foto_penerima' => 'image|nullable|max:10000'
        ]);

        $slug = ['slug' => $this->random_slug()];
        $input = $request->all();
        if ($request->hasFile('foto_penerima')) {
            $filenameWithExt = $request->file('foto_penerima')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('foto_penerima')->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.$slug['slug'].'.'.$extension;
            $path = $request->file('foto_penerima')->storeAs('public/foto_penerima', $filenameSimpan);
            $input['foto_penerima'] = $filenameSimpan;
        }
        else{

        }

        $input = array_merge($input, $slug);
        // dd($input);
        $reception = Reception::create($input);

        // Storage::disk('local')->put('foto_'.$request->id, $request->foto_penerima);

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
     * @param  \App\Models\Reception  $Reception
     * @return \Illuminate\Http\Response
     */
    public function show(Reception $reception)
    {
        $data['penerima'] = Reception::where('slug', $reception->slug)->first();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function edit(Reception $reception)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReceptionRequest  $request
     * @param  \App\Models\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReceptionRequest $request, Reception $reception)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reception $reception)
    {
        //
    }

    public function random_slug(int $length = 15,
        string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): string
    {
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
}
