<?php

namespace App\Http\Controllers;

use App\Models\Delivery as D;
use App\Http\Requests\StoreDeliveryRequest;
use App\Http\Requests\UpdateDeliveryRequest;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Dvs = D::with('Penerima', 'Pengantar', 'Menus.Pokmas')->get();
        return view('deliveries.index', compact(['Dvs']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('deliveries.index', compact(['Dvs']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDeliveryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeliveryRequest $request)
    {
        // dd($request);
        $input = $request->all();
        $dok = $request->file();
        if (count($dok) > 0){
            foreach ($dok as  $val) {
                $filenameWithExt = $val->getClientOriginalName();
                $filenameWithExt = str_replace('-', '_', $filenameWithExt);
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $val->getClientOriginalExtension();
                $filenameSimpan = $filename.'_'.$input["menu"].$input["penerima"].'.'.$extension;
                $path = $val->storeAs('public/dok_deliv', $filenameSimpan);
                // array_fill($fileField,1,$path);
                $input["dok"] = $filenameSimpan;
                // dd($input);
            }
        }
        $delivery = D::create($input);
        $pengiriman = $delivery->save();
        if($pengiriman){
            logit('Input data pengiriman. Records: |'.$delivery->id.'|');//fungsi ada di Helpers
            return back()->with('success', 'Data pengiriman berhasil disimpan.');

        }
        else{
            return back()->with('warning', 'Data pengiriman gagal disimpan.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function show(D $delivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit(D $delivery)
    {

        // $data['penerima'] = D::find(->with('Histories','Rts.Kelurahan.Kecamatan')->first();
        $delivery = D::where('id', $delivery->id)->with('Penerima', 'Pengantar', 'Menus.Pokmas.Rts.Kelurahan.Kecamatan')->get();
        return response()->json($delivery);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDeliveryRequest  $request
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeliveryRequest $request, D $delivery)
    {
        $input = $request->all();
        //check if image is uploaded
        $files = $request->file();
        $wkt = now()->timestamp;
        if (count($files) > 0) {

            //upload new files
            foreach ($files as $fileField => $val) {
            $filenameWithExt = $val->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $val->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.$wkt.'.'.$extension;
            $path = $val->storeAs('public/dok_deliv/', $filenameSimpan);
            $input[$fileField] = $filenameSimpan;

            //delete old image
            Storage::delete('public/dok_deliv/'.$delivery->$fileField);
            }
        $delivery->fill($input);
            $changes = $delivery->getDirty();
            $hasil = $delivery->save();
            // $delivery->update(Input::all());
        } else {
            //update post without file
            $delivery->fill($input);
            $changes = $delivery->getDirty();
            $hasil = $delivery->save();
        }
        if($hasil){
            return back()->with(['success' => 'Pengantaran berhasil dicatat!']);
        }
        else{
            return back()->with(['warning' => 'Pengantaran gagal dicatat!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(D $delivery)
    {
        //
    }

    public function catat($slug)
    {
        $Dv = D::with('Penerima', 'Pengantar', 'Menus.Pokmas.Rts.Kelurahan.Kecamatan')
        ->whereHas('Penerima', function ($query) use ($slug) {
            $query->where('slug', $slug);})
        ->first();
        return view('deliveries.create', compact('Dv'));
    }
}
