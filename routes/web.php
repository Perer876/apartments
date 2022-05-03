<?php

use App\Http\Controllers\BuildingController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TenantRegistrationTokenController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/apartments', [ApartmentController::class, 'index']);
Route::resource('buildings.apartments', ApartmentController::class)->shallow();

Route::resource('tenants', TenantController::class)->except(['store','update']);
Route::controller(TenantRegistrationTokenController::class)->prefix('tenants')->group(function () {
    Route::match(['get', 'head'], '/{tenant}/invite', 'invite');
    Route::post('/{tenant}/invite', 'send_invite');
    Route::match(['get', 'head'], '/register/{token}', 'register')->name('tenant.register');
});


Route::get('/bienvenido', function () {
    return view('bienvenido');
})->name('home');