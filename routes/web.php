<?php

namespace App\Models;

// use App\Models\Admin;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
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

Route::get('/', [HomeController::class, 'home']);
Route::get('/p', [HomeController::class, 'news'])->name('post');

Route::get('search-tag', [SearchController::class, 'searchTagByTitle'])->name('searchTag');
Route::get('search', [SearchController::class, 'searchPosts'])->name('searchPost');

require __DIR__ . '/admin.php';
require __DIR__ . '/user.php';
