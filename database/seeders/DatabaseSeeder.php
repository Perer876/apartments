<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Tenant::factory(20)->create();

        $this->call([
            BuildingSeeder::class,
            UserSeeder::class,
        ]);
    }
}
