<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(3)->create();

        Book::factory(25)->create();

        Category::factory()->create([
            'kategori' => 'fiksi',    
        ]);

        Category::factory()->create([
            'kategori' => 'self development',
        ]);

        Category::factory()->create([
            'kategori' => 'keuangan',
        ]);

        Category::factory()->create([
            'kategori' => 'sains',
        ]);

        Category::factory()->create([
            'kategori' => 'komputer',
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }

}
