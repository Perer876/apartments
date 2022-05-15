<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Building;
use App\Http\Resources\BuildingResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/buildings', function (){
    return BuildingResource::collection(Building::all());
});

Route::get('/buildings/{building}', function (Building $building){
    return new BuildingResource($building);
});
