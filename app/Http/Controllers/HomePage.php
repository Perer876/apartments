<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Apartment;
use App\Models\Tenant;

class HomePage extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('home',[
            'buildings_count' => Building::ofCurrentUser()->count(),
            'apartments_count' => Apartment::ofCurrentUser()->count(),
            'tenants_count' => Tenant::ofCurrentUser()->count(),
        ]);
    }
}
