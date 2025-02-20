<?php

// use App\Http\Controllers\DashboardController;

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardPostinganController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostinganController;
use App\Http\Controllers\RegisterController;
use App\Models\Postingan;
use App\Models\Category;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

// dd(bcrypt('password'));
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them willweb
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/trial', function() { return view('welcome'); })->name('welcome');  //Default Laravel
Route::get('/', [PostinganController::class, 'index'])->name('home');
Route::get('/about', [PostinganController::class, 'about'])->name('about');
Route::get('/blog', [PostinganController::class, 'blog'])->name('blog');
Route::get('/categories', [PostinganController::class, 'categories'])->name('categories');
Route::get('/listuser', [PostinganController::class, 'userlist'])->name('userlist');
// Single Route Extend posts
Route::get('/post/{postingan:slug}', [PostinganController::class, 'post'])->name('post');
// Single Route for category Group
Route::get('/categories/{category:slug}', [PostinganController::class, 'category'])->name('category');
// Single Route for User Group
Route::get('/listuser/{author:username}', [PostinganController::class, 'author'])->name('author');
// data PopUp Postingan bedasarkan Ajax
Route::get('/post/{postingan:slug}', function (Postingan $postingan) {
    return response()->json($postingan);
});

Route::middleware('guest')->group(function (){
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/register',[RegisterController::class, 'store'])->name('store');
    Route::get('/register',[RegisterController::class, 'index'])->name('register');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    // Dashboard User
    Route::get('/dashboard', function () {
        return view('dashboard.dashboard', ['hidup' => 'dashboard']);
    })->name('dashboard');
    Route::resource('/dashboard/blog', DashboardPostinganController::class)->parameters(['blog' => 'postingan']);
    Route::get('/dashboard/blog/checkSlug', [DashboardPostinganController::class, 'checkSlug']);
    // Admin Access
    Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('is_admin'); //menghapus fungsi show
    // Route like dan Unlike
    Route::post('/like/{id}', [LikeController::class, 'likePostingan'])->name('likePostingan');
    // Route like dan Unlike
    Route::get('/get-likes/{postingan}', function ($id) {
        $postingan = App\Models\Postingan::findOrFail($id);
        // return response()->json(['likes' => $postingan->like()->count()]);
        if (!$postingan) {
            return response()->json(['error' => 'Postingan tidak ditemukan'], 404);
        }
        return response()->json([
            'likes' => $postingan->likes()->count()  //response yang diterima ketika klik tombol read more dan diberikan ke html button like
        ]);
    });
});










