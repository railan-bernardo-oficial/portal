<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;




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

//home
Route::get('/', [HomeController::class, 'index'])->name('site.home');

include __DIR__ . '/admin.php';


//routes do site
Route::get('pesquisa', [HomeController::class, 'search'])->name('site.search');
Route::get('{category}', [HomeController::class, 'category'])->name('site.list.news');
Route::get('{category}/{slug}', [HomeController::class, 'details'])->name('site.post.news');





