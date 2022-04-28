<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Oscar Arámbula',
            'email' => 'oscar.arambula4388@alumnos.udg.mx',
            'password' => bcrypt('abcd1234'),
        ]);
    }
}
