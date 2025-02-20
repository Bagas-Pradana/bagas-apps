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
// Guest and Auth Accesss
Route::controller(PostinganController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/blog', 'blog')->name('blog');
    Route::get('/categories', 'categories')->name('categories');
    Route::get('/listuser', 'userlist')->name('userlist');
    // Single Route Extend posts
    Route::get('/post/{postingan:slug}', 'post')->name('post');
    // Single Route for category Group
    Route::get('/categories/{category:slug}', 'category')->name('category');
    // Single Route for User Group
    Route::get('/listuser/{author:username}', 'author')->name('author');
    Route::middleware('guest')->group(function (){
        Route::get('/trial', 'welcome')->name('welcome');  //Default Laravel
    });
});

// Login Access
Route::controller(LoginController::class)->group(function () {
    Route::post('/login', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
    Route::middleware('guest')->group(function() {
        Route::get('/login', 'index')->name('login');
    });
});

// Register Access
Route::controller(RegisterController::class)->group(function () {
    Route::post('/register', 'store')->name('store');
    Route::middleware('guest')->group(function () {
        Route::get('/register', 'index')->name('register');
    });
});
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.dashboard', ['hidup' => 'dashboard']);
    })->name('dashboard');
});

// Dashboard User
Route::resource('/dashboard/blog', DashboardPostinganController::class)->parameters(['blog' => 'postingan']);
Route::get('/dashboard/blog/checkSlug', [DashboardPostinganController::class, 'checkSlug']);
Route::middleware('auth')->group(function () {
});

// data PopUp Postingan bedasarkan Ajax
Route::get('/post/{postingan:slug}', function (Postingan $postingan) {
    return response()->json($postingan);
});

// Admin Access
Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('is_admin'); //menghapus fungsi show

// Route like dan Unlike
Route::middleware('auth')->group(function(){
    Route::post('/like/{id}', [LikeController::class, 'likePostingan'])->name('likePostingan');
});
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


