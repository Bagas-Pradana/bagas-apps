<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory; //->connect database
// use Illuminate\Database\Eloquent\Model;

// class Postingan extends Model
// {
//     use HasFactory;
// }

class Postingan {
    private $post = [
        [
            'title' => 'Judul-Pertama',
            'slug' => 'judul-tulisan-pertama',
            'nama' => 'Bagas pradana',
            'body' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit.',
            'post' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corrupti vitae ab ratione nobis libero recusandae cum sed aliquid, beatae incidunt minus voluptas soluta a optio facilis nulla totam. Natus dolorum ad maxime nisi beatae debitis iste incidunt.',
            'images' => 'https://fastly.picsum.photos/id/318/300/200.jpg?hmac=9s-HqE4Jk695t8is5UuwS-FEc5rNvbKOOQNaPAMkZeE'
        ],
        [
            'title' => 'Judul-Kedua',
            'slug' => 'judul-tulisan-kedua',
            'nama' => 'Waluyo Ganas',
            'body' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit.',
            'post' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corrupti vitae ab ratione nobis libero recusandae cum sed aliquid, beatae incidunt minus voluptas soluta a optio facilis nulla totam. Natus dolorum ad maxime nisi beatae debitis iste incidunt.',
            'images' => 'https://fastly.picsum.photos/id/230/300/200.jpg?hmac=VVMe8CzEegYw1ywi_-8JRuQV6Ewc8PGAjLf-d5-lZD4'
        ]
    ];

    public function all() {
        return collect($this->post);
    }
    public function find($slug) {
        $new_post = $this->all();
        return $new_post->firstWhere('slug', $slug);

        // ----Fungsi ini akan digantikan oleh fungsi collect
        // $post = [];
        // foreach($new_post as $row){
        //     if($row['slug'] === $slug){
        //         $post = $row;
        //     }
        // }
    }
}

