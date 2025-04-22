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
            'proposal'      => $this->faker->boolean(70) ? $this->faker->url() : null,
            'prd'           => $this->faker->boolean(70) ? $this->faker->url() : null,
            'figma'         => $this->faker->boolean(50) ? $this->faker->url() : null,
            'github'        => $this->faker->boolean(80) ? 'https://github.com/'.$this->faker->userName().'/'.$this->faker->word() : null,
            'about'         => $this->faker->paragraph(),
            'thumbnail'     => null,
            'qr'            => null,
            'design_system' => $this->faker->boolean(60) ? $this->faker->url() : null,
        ];
    }
}
