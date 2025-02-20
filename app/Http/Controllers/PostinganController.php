<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Postingan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;


class PostinganController extends Controller
{
        /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // Main Laravel
    public function welcome (): \Illuminate\Contracts\View\View {return view('welcome');}
    // My App
    public function index(): \Illuminate\Contracts\View\View {return view('url.home', ['hidup' => 'home']);}
    public function about(): \Illuminate\Contracts\View\View {
        return view('url.about',
        [
            'hidup' => 'about',
            'nama' => 'Bagas Pradana',
            'images' => 'https://fastly.picsum.photos/id/688/300/200.jpg?hmac=EUPWOoQM1k6_VLj-mTnOpfmjWtwsXTcgYFpM0BPFmc0'
        ]);
    }
    public function post(Postingan $postingan): \Illuminate\Contracts\View\View {
        // $postingan = new Postingan();
        return view('url.post',
        [
            'hidup' => '',
            'post' => $postingan
        ]);
    }
    public function blog(): \Illuminate\Contracts\View\View {
        // $postingan = new Postingan();
        // $post = Postingan::latest();
        // if(request('key')) {
        //     $post->where('judul', 'like', '%' . request('key') . '%')
        //         ->orWhere('body', 'like', '%' . request('key') . '%');
        // }
        $title = '';
        if(request('category')){
            $category = Category::firstWhere('slug', request('category'));
            $title = 'Jenis: ' . $category->nama_kategory;
        }
        if(request('author')){
            $author = User::firstWhere('username', request('author'));
            $title = 'User: ' . $author->name;
        }
        return view('url.blog',
        [
            'title' => 'About Post ' . $title,
            'hidup' => 'blog',
            // 'post' => Postingan::with(['author', 'category'])->latest()->get()
            // 'post' => Postingan::latest()->pencarian(request(['key', 'category', 'author']))->get()
            'post' => Postingan::latest()->pencarian(request(['key', 'category', 'author']))->paginate(4)->withQueryString()
        ]);
    }
    // public function category(Category $category): \Illuminate\Contracts\View\View {
    //     return view('url.category',
    //     [
    //         'hidup' => '',
    //         'title' => $category,
    //         'post' => $category->postingan->load('category', 'author'),
    //         'category' => $category->nama_kategory
    //     ]);
    // }
    public function categories(): \Illuminate\Contracts\View\View {
        // $category = new Category();
        // @dd($category->first());
        $hasil = Category::with('postingan')->get();
        return view('url.listcategory',
        [
            'hidup' => 'categories',
            'post' => Category::with('postingan')->get(),
        ]);

    }
    // public function author(User $author): \Illuminate\Contracts\View\View {
    //     return view('url.user',
    //     [
    //         'hidup' => '',
    //         'title' => $author,
    //         'post' => $author->postingan->load('category', 'author'),
    //         'user' => $author->name,
    //     ]);
    // }
    public function userlist(): \Illuminate\Contracts\View\View {
        // $user = new User();
        return view('url.listuser',
        [
            'hidup' => 'userlist',
            'post' => User::with('postingan')->get(),
        ]);
    }
}
