<?php

use App\Http\Controllers\HomePage;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TenantRegistrationTokenController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', HomePage::class
    /* function () { return view('dashboard');} */
)->name('dashboard');
Route::get('/home', HomePage::class)->middleware('auth')->name('home');

Route::resource('buildings', BuildingController::class)->middleware('auth');

Route::get('/apartments', [ApartmentController::class, 'index'])->middleware('auth')->name('apartments.index');
Route::resource('buildings.apartments', ApartmentController::class)->shallow()->middleware('auth');

Route::resource('tenants', TenantController::class)->except(['store','update'])->middleware('auth');
Route::controller(TenantRegistrationTokenController::class)->prefix('tenants')->name('tenant.')->middleware('auth')->group(function () {
    Route::match(['get', 'head'], '/{tenant}/invite', 'invite')->name('invite');
    Route::post('/{tenant}/invite', 'send_invite')->name('send_invite');
    Route::match(['get', 'head'], '/register/{token}', 'register')->name('register');
});

Route::controller(ContractController::class)->prefix('contracts/tenants/{tenant}')->middleware('auth')->group(function (){
    Route::match(['get', 'head'], '/create', 'create');
    Route::post('/', 'store');
});