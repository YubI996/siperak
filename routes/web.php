<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrGenerator;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\PokmasController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\KecamatanController;
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
    return redirect()->route('home2');
    // return redirect()->route('recipients.index');
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
})->middleware(['auth'])->name('home2');

Route::get('qrcode',[QrGenerator::class, 'index'])->name('qrcode');

Route::get('table', function(){
    return view('table', [
        'users' => User::get(),
    ]);
})->name('datatable');
//ROUTES TEMPLATE
Route::get('/calendar', function () {
    return view('aplikasi.calendar');
})->name('calendar');

Route::get('/dash', function () {
    return view('aplikasi.dashboard2');
})->name('dash');

Route::get('/form2', function () {
    return view('aplikasi.create');
})->name('form2');

Route::get('api/pokmas', [PokmasController::class, 'fetchPokmas'])->name('api.pokmas');

Route::get('fetch-penerima', [RecipientController::class, 'get_penerima']);
Route::post('api/fetch-kelurahan', [PilihRTController::class, 'fetchKel']);
Route::post('api/fetch-rt', [PilihRTController::class, 'fetchRt']);

Route::resource('recipients', RecipientController::class)->middleware(['auth']);
Route::resource('pokmases', PokmasController::class)->middleware(['auth']);
Route::resource('users', UserController::class)->middleware(['auth']);
Route::resource('deliveries', DeliveryController::class)->middleware(['auth']);
Route::resource('menus', MenuController::class)->middleware(['auth']);
Route::resource('kecamatan', KecamatanController::class)->middleware(['auth']);

Route::get('penerima/{slug}', [DeliveryController::class, 'catat'])->middleware('role');
Route::get('/profil/qr/{slug}', [RecipientController::class, 'profil'])->name('recipients.profil');
Route::get('recipients/qr/{slug}', [RecipientController::class, 'qr'])->name('recipients.qr');
