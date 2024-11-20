<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manga>
 */
class MangaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => fake()->unique()->sentence(),
            'portada' => fake()->imageUrl(),
            'categoria_id' => Categoria::all()->random()->id,
            'subcategoria_id' => Subcategoria::all()->random()->id,
        ];
    }
}
