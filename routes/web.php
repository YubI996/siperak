<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrGenerator;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReceptionController;
use App\Http\Controllers\PilihRTController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('receptions.index');
    // return view('welcome');
});

require __DIR__.'/auth.php';




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// ROUTES AT DEVELOPMENT
Route::get('/map', function () {
    return view('map');
})->name('map');

Route::get('/form', function () {
    return view('form');
})->name('form');

Route::get('/scan', function () {
    return view('scan');
})->name('scan');

Route::get('/home2', function () {
    return view('aplikasi.dashboard2');
})->name('home2');
Route::get('qrcode',[QrGenerator::class, 'index'])->name('qrcode');

Route::get('table', function(){
    return view('table', [
        'users' => User::get(),
    ]);
})->name('datatable');
//ROUTES TEMPLATE
Route::get('/celendar', function () {
    return view('aplikasi.calendar');
})->name('calendar');

Route::get('/form2', function () {
    return view('aplikasi.create');
})->name('form2');

Route::post('api/fetch-kelurahan', [PilihRTController::class, 'fetchKel']);
Route::post('api/fetch-rt', [PilihRTController::class, 'fetchRt']);

Route::resource('receptions', ReceptionController::class)->middleware(['auth']);

