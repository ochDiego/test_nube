<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Manga;
use App\Models\Subcategoria;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Categoria::factory(10)->create();
        Subcategoria::factory(50)->create();
        Manga::factory(100)->create();

        /*  User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
    }
}
