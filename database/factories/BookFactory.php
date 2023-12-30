<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'user_id' => mt_rand(1, 3),
            'category_id' => mt_rand(1, 5),
            'judul' => fake()->sentence(),
            'deskripsi' => fake()->paragraph(),
            'jumlah' => mt_rand(1, 999),
            'file' => fake()->numerify('file-###'),
            'cover' => fake()->numerify('cover-###'),
        ];
    }
}
