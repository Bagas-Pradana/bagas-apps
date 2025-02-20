<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Postingan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Postingan>
 */
class PostinganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // latihan membuat faker untuk postingan
            'category_id' => mt_rand(1, 2),
            'user_id' => mt_rand(1, 5),
            'judul' => $this->faker->sentence(mt_rand(2, 4)),
            'slug' => $this->faker->slug(mt_rand(2, 4)),
            'excerpt' => $this->faker->sentence(mt_rand(8, 15)),
            // 'body' => '<p>' . implode('</p><p>', $this->faker->paragraphs(mt_rand(6, 12))) . '</p>',
            'body' => collect($this->faker->paragraphs(mt_rand(6, 12)))
                    ->map(function($p) {
                        return "<p>$p</p>";
                    })->implode(''),
            // 'images' => 'https://fastly.picsum.photos/id/318/300/200.jpg?hmac=9s-HqE4Jk695t8is5UuwS-FEc5rNvbKOOQNaPAMkZeE'
        ];
    }
}
