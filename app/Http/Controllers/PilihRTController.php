<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Rt;

class PilihRTController extends Controller
{
    public function index()
    {
        $data['kecs'] = Kecamatan::get(["nama_kec", "id"]);
        return view('dropdown', $data);
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function fetchKel(Request $request)
    {
        $data['kels'] = Kelurahan::where("kecamatan_id", $request->kec_id)->get(["nama_kel", "id"]);
        return response()->json($data);
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function fetchRt(Request $request)
    {
        $data['rts'] = Rt::where("kelurahan_id", $request->kel_id)->get(["nama_rt", "id"]);
        return response()->json($data);
    }
}
