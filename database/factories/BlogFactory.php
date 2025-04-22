<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'author' => $this->faker->name,
            'thumbnail' => null, // opsional karena akan dihandle manual saat testing
        ];
    }
}
