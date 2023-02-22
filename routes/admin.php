<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\PostsController;


//routes de autenticação
Route::get('admin/login', [AdminController::class, 'login'])->name('login');
Route::post('/admin/auth', [AuthController::class, 'login'])->name('login.auth');
Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

//routes protegidas
Route::group(['prefix' => 'admin', 'middleware' => 'auth:sanctum'], function () {

    //dashboard
    Route::get('/', [AdminController::class, 'home'])->name('admin.home');


    //categorias
    Route::get('categoria/adicionar', [CategorieController::class, 'create'])->name('admin.category.create');
    Route::post('category/add', [CategorieController::class, 'store'])->name('admin.category.store');
    Route::get('category/delete/{id}', [CategorieController::class, 'destroy'])->name('admin.category.delete');
    Route::post('categoria/update/{id}', [CategorieController::class, 'update'])->name('admin.category.update');


    //posts
    Route::post('post/add', [PostsController::class, 'store'])->name('admin.post.store');
    Route::get('post/edit/{id}', [PostsController::class, 'show'])->name('admin.post.edit');
    Route::get('post/delete/{id}', [PostsController::class, 'destroy'])->name('admin.posts.delete');
    Route::post('post/update/{id}', [PostsController::class, 'update'])->name('admin.post.update');

    //users
    Route::get('users/add', [UsersController::class, 'create'])->name('admin.users.add');
    Route::post('users/add', [UsersController::class, 'store'])->name('admin.users.store');

    Route::get('users/delete/{id}', [UsersController::class, 'destroy'])->name('admin.users.delete');
    Route::get('users/edit/{id}', [UsersController::class, 'edit'])->name('admin.users.edit');
    Route::post('users/update/{id}', [UsersController::class, 'update'])->name('admin.users.update');
    Route::post('users/new-password/{id}', [UsersController::class, 'change_password'])->name('admin.users.password');
});



//routes sem proteção
Route::get('admin/cadastro', [AdminController::class, 'register'])->name('admin.register');
Route::post('register', [AdminController::class, 'store'])->name('admin.register.store');


Route::get('admin/users', [UsersController::class, 'index'])->name('admin.list.users');
Route::get('admin/user/{id}', [UsersController::class, 'show'])->name('admin.show.user');


Route::get('admin/categorias', [CategorieController::class, 'index'])->name('admin.list.categorys');
Route::get('admin/categoria/{id}', [CategorieController::class, 'show'])->name('admin.show.category');


Route::get('admin/posts', [PostsController::class, 'index'])->name('admin.list.posts');
Route::get('post/adicionar', [PostsController::class, 'create'])->name('admin.post.create');
Route::post('admin/posts/filter', [PostsController::class, 'filter'])->name('admin.filter.posts');
