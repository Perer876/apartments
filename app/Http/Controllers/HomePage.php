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
        $apartments = Apartment::with('building')
            ->with('images')
            ->withCount('images')
            ->ofCurrentUser()
            ->orderBy('images_count', 'desc')
            ->get();

        return view('home',[
            'apartments' => $apartments,
            'buildings_count' => Building::ofCurrentUser()->count(),
            'apartments_count' => Apartment::ofCurrentUser()->count(),
            'tenants_count' => Tenant::ofCurrentUser()->count(),
            'contracts_count' => Contract::ofCurrentUser()->count(),
        ]);
    }
}
