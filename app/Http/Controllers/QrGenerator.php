<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrGenerator extends Controller
{
    public function index()
    {
        return view('qrcode');
    }
}
