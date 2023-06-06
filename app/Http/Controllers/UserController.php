<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kecamatan;
use App\Models\Log as l;
use Auth;
use Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role_id', '>=', Auth()->user()->role)->with('Rts.kelurahan.kecamatan')->get();
        $kecs = Kecamatan::all();
        return view('users.index', compact('users', 'kecs'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $baru = $request->all();
        $baru["password"] = Hash::make($baru["password"]);
        $create = User::create($baru);
        // dd($create);
        $hasil = $create->save();
        if($hasil){
            return back()->with(['success' => 'Data Berhasil Disimpan!']);
        }
        else{
            return back()->with(['warning' => 'Data Gagal Disimpan!']);
        }
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
        // dd($id);
        $data = User::with('Rts.Kelurahan.Kecamatan')->find($id);
        return response()->json($data);
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
        $user = User::find($id);
        $add = $request->all();
        // dd($user->password);
        if($add["password"] === null){
            $add["password"] = $user->password;
        }
        else{
            $add["password"] = Hash::make($add["password"]);
        }

        $user->fill($add);
        $hasil = $user->push();
        if($hasil){
            return back()->with(['success' => 'Data Berhasil Diubah!']);
        }
        else{
            return back()->with(['warning' => 'Data Gagal Diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $hasil = $user->delete();
        if($hasil){
            return back()->with(['success' => 'Data Berhasil Dihapus!']);
        }
        else{
            return back()->with(['warning' => 'Data Gagal Dihapus!']);
        }
    }

    public function get_pengantar()
    {
        $pengirims = User::where('role_id', 8)->get();
        Return response()->json($pengirims);
    }
}
