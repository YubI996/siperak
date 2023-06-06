<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use Illuminate\Http\Request;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::with('pokmas')->get();
        return view('menus.index', compact('menu'));
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
     * @param  \App\Http\Requests\StoreMenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuRequest $request)
    {
        $input = $request->all();
        // dd($request->all());
        $foto = $request->foto;
        // $filenameWithExt = $foto->getClientOriginalName();
            $filenameWithExt = "Menu_".$input['pokmas'];

                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $foto->getClientOriginalExtension();
                $filenameSimpan = $filename.'_'.$input["pokmas"].'.'.$extension;
                $path = $foto->storeAs('public/menu', $filenameSimpan);
                // array_fill($fileField,1,$path);
                $input['foto'] = $filenameSimpan;
                // dd($input);
        $save = Menu::create($input);
        if($save->id)
        {
            logit('Membuat menu : '.$save->id);
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
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        $menu = Menu::with('Pokmas')->find($menu->id);
        return response()->json($menu);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $menu = Menu::with('Pokmas')->find($menu->id);
        return response()->json($menu);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMenuRequest  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $input = $request->all();
        if ($request->hasFile('foto')) {
            $val = $input['foto'];
            $pokmas = str_replace(" ","",ucwords($menu->Pokmas->nama));
            $filenameWithExt = "Menu_".$pokmas."_".date('d-m-Y');
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $val->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.$menu->id.'.'.$extension;
            $path = $val->storeAs('public/menu', $filenameSimpan);
            // dd($path);
            $input['foto'] = $filenameSimpan;
             unlink(public_path().'\storage\menu/'.$menu->foto);
        }
        else{
            $input['foto'] = $menu->foto;
        }
        $menu->update($input);
        $menu->save();
        return back()->with(['success' => 'Data Berhasil Diubah!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        unlink(public_path().'\storage\menu/'.$menu->foto);
        $menu->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
