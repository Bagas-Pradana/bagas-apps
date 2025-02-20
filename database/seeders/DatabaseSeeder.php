<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Postingan;
use App\Models\Category;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(5)->create();

        // // \App\Models\User::factory()->create([
        // //     'name' => 'Test User',
        // //     'email' => 'test@example.com',
        // // ]);

        // // // Latihan Membuat Sedder Manual
        // User::create([
        //     'name' => 'Bagas Pradana',
        //     'username' => 'bagas',
        //     'email' => 'bagaspradana@gmail.com',
        //     'password' => bcrypt('123456'),
        // ]);
        // Category::create([
        //     'nama_kategory' => 'Jurnalis',
        //     'slug' => 'kode-jurnalis',
        // ]);
        // Postingan::create([
        //     'category_id' => '1',
        //     'user_id' => '1',
        //     'judul' => 'Judul Pertama',
        //     'slug' => 'judul-kesatu',
        //     'excerpt' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit.',
        //     'body' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corrupti vitae ab ratione nobis libero recusandae cum sed aliquid, beatae incidunt minus voluptas soluta a optio facilis nulla totam. Natus dolorum ad maxime nisi beatae debitis iste incidunt.',
        //     'images' => 'https://fastly.picsum.photos/id/318/300/200.jpg?hmac=9s-HqE4Jk695t8is5UuwS-FEc5rNvbKOOQNaPAMkZeE'
        // ]);

        // Latihan ditambah factory
        // Latihan Membuat Sedder Manual

        // Category::create([
        //     'nama_kategory' => 'Jurnalis',
        //     'slug' => 'kode-jurnalis',
        // ]);
        // Category::create([
        //     'nama_kategory' => 'Culinary',
        //     'slug' => 'kode-culinary',
        // ]);
        // Category::create([
        //     'nama_kategory' => 'Foody',
        //     'slug' => 'kode-foody',
        // ]);
        \App\Models\Postingan::factory(20)->create();
    }
}
