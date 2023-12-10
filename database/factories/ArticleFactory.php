<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(10),
            'content' => fake()->text(50),
            'img' => fake()->image('public/storage/images', 640, 480, null, false),
            'category_id' => Category::query()->inRandomOrder()->value('id'),
            'link' => fake()->url(),
            'author' => fake()->name(),
        ];
    }
}
