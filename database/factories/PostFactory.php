<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'summary' => $this->faker->paragraph(),
            'content' => $this->faker->paragraph(10),
            'author_id' => 1,
        ];
    }
}
