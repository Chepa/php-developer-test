<?php

namespace Database\Factories;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Apartment>
 */
class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->numberBetween(10000, 1000000),
            'bathrooms' => $this->faker->numberBetween(0, 5),
            'bedrooms' => $this->faker->numberBetween(0, 5),
            'storeys' => $this->faker->numberBetween(0, 5),
            'garages' => $this->faker->numberBetween(0, 5),
        ];
    }
}
