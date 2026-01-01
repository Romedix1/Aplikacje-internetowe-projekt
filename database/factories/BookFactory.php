<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'isbn' => $this->faker->isbn13(),
            'publication_year' => $this->faker->year(),
            'description' => $this->faker->paragraph(),
            'author_id' => Author::factory(),
            'publisher_id' => Publisher::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
