<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Frontend\PostController as FrontendPostController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\Frontend\CommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [FrontendPostController::class, 'index'])->name('home');
Route::get('/post/{slug}', [FrontendPostController::class, 'singlePost'])->name('post');
Route::get('/about', [FrontendPostController::class, 'about'])->name('about');
Route::get('/contact', [FrontendPostController::class, 'contact'])->name('contact');
Route::post('/posts/{post_id}/comments', [CommentController::class, 'store'])->name('comment.store');
Route::get('/category/{category_url}', [FrontendCategoryController::class, 'show'])->name('category.show');



Route::prefix('admin')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [PostController::class,'show'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('posts', PostController::class);
});

