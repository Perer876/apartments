<?php

use App\Http\Controllers\BuildingController;
use App\Http\Controllers\ApartmentController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('buildings', BuildingController::class);

Route::resource('buildings.apartments', ApartmentController::class)->shallow();

Route::get('/bienvenido', function () {
    return view('bienvenido');
})->name('home');