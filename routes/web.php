<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\centrePointController;
use App\Http\Controller\dataController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// MENAMBAHKAN ROUTE BARU UNTUK MENAMPILKAN MAP
Route::get('/map', function () {
    return view('map');
})->name('map');
Route::resource('centre-point', (centrePointController::class));
Route::get('/centrepoint/data', [dataController::class, 'centrepoint'])->name('centre-point-data');

require __DIR__.'/auth.php';
