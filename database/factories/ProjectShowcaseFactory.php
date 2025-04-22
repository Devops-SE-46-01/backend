<?php

namespace Database\Factories;

use App\Models\ProjectShowcase;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectShowcaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectShowcase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $membersCount = $this->faker->numberBetween(1, 5);
        $members = [];
        for ($i = 0; $i < $membersCount; $i++) {
            $members[] = $this->faker->name();
        }

        return [
            'project_name'  => $this->faker->sentence(3),
            'team_name'     => $this->faker->company(),
            'team_members'  => implode(', ', $members),
            'proposal'      => $this->faker->url() ,
            'prd'            => $this->faker->url,
            'figma'          => $this->faker->url,
            'github'         => $this->faker->url,
            'about'         => $this->faker->paragraph(),
            'thumbnail'     => $this->faker->url,
            'qr'            => $this->faker->url,
            'design_system' => $this->faker->url(),
        ];
    }
}
