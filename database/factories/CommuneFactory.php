<?php

namespace Kossa\AlgerianCities\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Kossa\AlgerianCities\Models\Commune;
use Kossa\AlgerianCities\Models\Wilaya;

class CommuneFactory extends Factory
{
    protected $model = Commune::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->city,
            'wilaya_id' => Wilaya::factory(),
            'arabic_name' => $this->faker->city,
            'post_code' => $this->faker->postcode,
            'longitude' => $this->faker->longitude,
            'latitude' => $this->faker->latitude,

        ];
    }
}
