<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    // Set Faker ke bahasa Indonesia
    protected $locale = "id_ID";

    public function definition(): array
    {
        $faker = \Faker\Factory::create('id_ID'); // ← Pakai Faker Indonesia langsung

        $title = $faker->sentence(4);  // Akan jadi kalimat dalam bahasa Indonesia

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $faker->paragraph(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
