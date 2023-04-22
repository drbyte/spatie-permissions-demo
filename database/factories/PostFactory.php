<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(4),
            'body' => fake()->paragraph(3),
            'published' => fake()->numberBetween(0,1),
            'user_id' => 1, // @TODO could generate a user here when none is passed through
        ];
    }
}
