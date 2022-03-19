<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buildings')->insert([
            'alias' => Str::random(),
            'street' => Str::random(20),
            'number' => strval(mt_rand(1,3000)),
            'postcode' => strval(mt_rand(10000,99999)),
            'city' => Str::random(12),
            'state' => Str::random(12),
            'builded_at' => strval(mt_rand(1902,2022)),
        ]);
    }
}
