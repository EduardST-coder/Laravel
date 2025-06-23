<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence(rand(3, 8));
        $text = $this->faker->realText(rand(1000, 4000));
        $date = $this->faker->dateTimeBetween('-3 months', '-1 month');

        return [
            'category_id'   => BlogCategory::inRandomOrder()->value('id') ?? 1,
            'user_id'       => User::inRandomOrder()->value('id') ?? 1,
            'title'         => $title,
            'slug'          => Str::slug($title),
            'excerpt'       => $this->faker->text(rand(40, 100)),
            'content_raw'   => $text,
            'content_html'  => $text,
            'is_published'  => rand(1, 5) > 1,
            'published_at'  => rand(1, 5) > 1 ? $date : null,
            'created_at'    => $date,
            'updated_at'    => $date,
        ];
    }
}
