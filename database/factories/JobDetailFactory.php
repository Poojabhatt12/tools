<?php

namespace Database\Factories;

use Faker\Core\Uuid;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'job_id' => $this->faker->uuid(),
            'job_name' => $this->faker->company(),
            'city' => $this->faker->city(),
        ];
    }
}
