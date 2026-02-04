<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 * 
 * 🏭 THE FACTORY = THE MOLD
 * This file is just the blueprint. It creates nothing by itself.
 * It just tells Laravel: "When I ask for a Category, use this design".
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 🎨 Here we define the materials for a SINGLE piece.
            // "Use a random word for the name and a random hex color"
            'name' => $this->faker->unique()->word(),
            'color' => $this->faker->hexColor(),
        ];
    }
}
