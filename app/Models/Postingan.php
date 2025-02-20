<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Postingan extends Model
{
    use HasFactory;
    use Sluggable;

    // Yang Boleh Diiisi
    protected $fillable = [
        'user_id', 'category_id', 'judul', 'nama', 'slug', 'excerpt', 'body', 'images'
    ];
    protected $with = ['author', 'category'];

    // Yang Gak Boleh DIisi
    // protected $guarded = ['id'];

    //Query Scope
    public function scopePencarian($query, array $hasil) {
        // if(request()->filled('klik') && isset($hasil['key']) ? $hasil['key'] : false) {
        //     $query->where(function ($que) use ($hasil) {
        //         return $que->where('judul', 'like', '%' . $hasil['key'] . '%')
        //         ->orWhere('body', 'like', '%' . $hasil['key'] . '%');
        //     });
        // }
        // isset($hasil['key']) ? $hasil['key'] : false) menjadi ($hasil['key'] ?? false)
        $query->when($hasil['key'] ?? false, function($query, $key){
            return $query->where(function ($que) use ($key) {
                $que->where('judul', 'like', '%' . $key . '%')
                ->orWhere('body', 'like', '%' . $key . '%');
            });
        });
        $query->when($hasil['category'] ?? false, function($query, $category){
            // tambahkan join table
            return $query->whereHas('category', function ($que) use ($category) {
                $que->where('slug', $category);
            });
        });
        $query->when($hasil['author'] ?? false, function($query, $author){
            return $query->whereHas('author', function ($que) use ($author){
                $que->where('username', $author);
            });
        });
    }

    // One Post has One Category (Belongs To)
    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function likes() {
        return $this->hasMany(Like::class, 'postingan_id');
    }
    // Customizing Route Model Binding
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul'
            ]
        ];
    }
}
