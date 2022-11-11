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
        // dd($request);
        $this->validate($request, [
            'foto_penerima' => 'image|nullable|max:10000',
            'foto_ktp' => 'image|nullable|max:10000',
            'foto_kk' => 'image|nullable|max:10000',
            'foto_rumah' => 'image|nullable|max:10000'
        ]);

        $input = $request->all();
        // $slug = ["slug" => $this->random_slug()];
        // $input = array_merge($input, $slug);
        $input["slug"] = $this->random_slug();
        $files = $request->file();
        if (count($files) > 0){
            foreach ($files as $fileField => $val) {
                $filenameWithExt = $val->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $val->getClientOriginalExtension();
                $filenameSimpan = $filename.'_'.$input["slug"].'.'.$extension;
                $path = $val->storeAs('public/'.$fileField, $filenameSimpan);
                // array_fill($fileField,1,$path);
                $input[$fileField] = $filenameSimpan;
                // dd($input);
            }
        }

        // dd($input);
        $reception = Reception::create($input);
        $reception->slug = $input["slug"];
        $reception->save();
        // dd($reception);
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
    public function show($slug)
    {
        $data['penerima'] = Reception::where('slug', $slug)->with('Histories','Rts.Kelurahans.Kecamatans')->first();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $data['penerima'] = Reception::where('slug', $slug)->with('Histories','Rts.Kelurahans.Kecamatans')->first();
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReceptionRequest  $request
     * @param  \App\Models\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    // public function update(UpdateReceptionRequest $request, $slug)
    public function update(Request $request, $slug)
    {
        // dd($request);
         //validate form
        // $validator = $this->validate($request, [
        //     'nama' => 'required|min:3|max:100|string',
        //     'bd' => 'required|date|before:01/01/1996',
        //     'nik' => 'numeric|digits:16',
        //     'foto_penerima' => 'mimes:jpg,bmp,png,jpeg,svg,tiff,tif|image',
        //     'no_hp' => 'numeric',
        //     'jenkel' => 'required',
        //     'alamat' => 'required',
        //     'pekerjaan' => 'required',
        //     'penyakit' => '',
        //     'rt' => 'numeric',
        //     'foto_ktp' => 'mimes:jpg,bmp,png,jpeg,svg,tiff,tif|image',
        //     'foto_kk' => 'mimes:jpg,bmp,png,jpeg,svg,tiff,tif|image',
        //     'foto_rumah' => 'mimes:jpg,bmp,png,jpeg,svg,tiff,tif|image',
        //     'status_rumah' => '',
        //     'long' => '',
        //     'lat' => ''
        // ]);

        // //check if validator fails
        // if ($validator->fails()) {
        //     return back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }
        $input = $request->all();
        $receptor = Reception::where("slug", $slug)->first();
        //check if image is uploaded
        $files = $request->file();
        if (count($files) > 0) {

            //upload new files
            foreach ($files as $fileField => $val) {
            $filenameWithExt = $val->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $val->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.$slug['slug'].'.'.$extension;
            $path = $val->storeAs('public/'.$fileField, $filenameSimpan);
            $input[$fileField] = $filenameSimpan;

            //delete old image
            Storage::delete('public/'.$fileField.'/'.$receptor->$fileField);
            }

            //update post with new image
            // $post->update([
            //     'image'     => $image->hashName(),
            //     'title'     => $request->title,
            //     'content'   => $request->content
            // ]);
            $receptor->fill($input);
            $changes = $receptor->getDirty();
            $receptor->save();
            // $receptor->update(Input::all());
        } else {
            //update post without file
            $receptor->fill($input);
            $changes = $receptor->getDirty();
            $receptor->save();
        }

        //redirect to index
        return back()->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     * menggunakan slug sebagai id
     * @param  \App\Models\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function destroy($idx)
    {
        $rec = Reception::where("slug", $idx)->first();
        $his = History::where("reception", $rec->id)->get();
        foreach ($his as $hi) {
            $hi->delete();
        }
        $rec->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
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
