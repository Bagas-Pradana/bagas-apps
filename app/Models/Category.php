<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kategory', 'slug'
    ];

    // One Category has Many Postingan (hasMany)
    public function postingan() {
        return $this->hasMany(Postingan::class);
    }
}
