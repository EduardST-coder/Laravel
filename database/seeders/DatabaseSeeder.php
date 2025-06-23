<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\BlogPost;
use App\Models\BlogCategory;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Користувач із ID = 1
        if (!User::where('id', 1)->exists()) {
            User::factory()->create([
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('123123'),
            ]);
        }

        // 2. Категорія з ID = 1
        if (!BlogCategory::where('id', 1)->exists()) {
            BlogCategory::create([
                'id' => 1,
                'title' => 'Default Category',
                'slug' => 'default-category',
                'parent_id' => 0,
            ]);
        }

        // 3. Додаткові категорії (опціонально)
        $this->call([
            BlogCategoriesTableSeeder::class,
        ]);

        // 4. Генерація постів
        BlogPost::factory(100)->create();
    }
}
