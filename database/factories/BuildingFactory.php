<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BuildingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'alias' => $this->faker->company,
            'street' => $this->faker->streetName,
            'neighborhood' => ucfirst($this->faker->word),
            'number' => $this->faker->buildingNumber,
            'postcode' => $this->faker->numberBetween(10000,99999),
            'city' => $this->faker->city,
            'state' => $this->faker->city,
            'builded_at' => $this->faker->year,
        ];
    }
}
