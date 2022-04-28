<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Building;
use App\Models\Apartment;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buildings = Building::factory(6)->create();
        foreach($buildings as $building)
        {
            Apartment::factory(rand(0, 7))->create([
                'building_id' => $building->id
            ]);
        }
    }
}
