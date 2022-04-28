<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => $this->faker->numberBetween(1,3333),
            'floor' => $this->faker->numberBetween(0,4),
            'garages' => $this->faker->numberBetween(0,3),
            'bathrooms' => $this->faker->numberBetween(1,3),
            'bedrooms' => $this->faker->numberBetween(1,5),
            'monthly_rent' => $this->faker->randomFloat(2,1000,12000),
        ];
    }
}
