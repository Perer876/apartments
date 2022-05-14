<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Apartment;
use App\Models\Contract;
use App\Models\Tenant;

class HomePage extends Controller
{
    public function __invoke()
    {
        return view('home',[
            'buildings_count' => Building::ofCurrentUser()->count(),
            'apartments_count' => Apartment::ofCurrentUser()->count(),
            'tenants_count' => Tenant::ofCurrentUser()->count(),
            'contracts_count' => Contract::ofCurrentUser()->count(),
        ]);
    }
}
