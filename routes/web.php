<?php

use App\Http\Controllers\HomePage;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TenantRegistrationTokenController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', HomePage::class)->name('dashboard');
Route::get('/home', HomePage::class)->middleware('auth')->name('home');

Route::resource('buildings', BuildingController::class)->middleware('auth');

Route::get('/apartments', [ApartmentController::class, 'index'])->middleware('auth')->name('apartments.index');
Route::resource('buildings.apartments', ApartmentController::class)->shallow()->middleware('auth');

Route::controller(TenantController::class)->prefix('tenants')->name('tenants.')->middleware('auth')->group( function () {
    Route::get('archived', 'archived')->name('archived');
    Route::delete('{tenant}/archive', 'archive')->name('archive');
    Route::match(['patch', 'put'], '{tenant}/restore', 'restore')->name('restore');
});
Route::resource('tenants', TenantController::class)->except(['store','update'])->middleware('auth');

Route::controller(TenantRegistrationTokenController::class)->prefix('tenants')->name('tenant.')->group(function () {
    Route::get('/{tenant}/invite', 'invite')->middleware('auth')->name('invite');
    Route::post('/{tenant}/invite', 'send_invite')->middleware('auth')->name('send_invite');
    Route::get('/register/{tenantToken}', 'register')->name('register');
    Route::get('/loging/{tenantToken}', 'login')->name('login');
    Route::post('/invites/accept', 'accept')->middleware('auth')->name('accept');
});

Route::controller(ContractController::class)->prefix('contracts')->name('contracts.')->middleware('auth')->group(function (){
    Route::match(['get', 'head'], '/', 'index')->name('index');
    Route::match(['get', 'head'], '/tenants/{tenant}/create', 'create')->name('create');
    Route::post('/tenants/{tenant}/', 'store')->name('store');
    Route::delete('/{contract}', 'cancel')->name('cancel');
});