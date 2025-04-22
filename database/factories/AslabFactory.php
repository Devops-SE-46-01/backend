<?php

namespace Database\Factories;

use App\Models\Aslab;
use Illuminate\Database\Eloquent\Factories\Factory;

class AslabFactory extends Factory
{
    protected $model = Aslab::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'image' => $this->faker->url(), 
            'position' => $this->faker->jobTitle(),
            'social_media' => '@' . $this->faker->userName(),
        ];
    }
}
