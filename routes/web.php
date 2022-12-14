<?php

namespace App\Models;

// use App\Models\Admin;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageUploadController;
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

Route::prefix('/admin')->namespace('\App\Http\Controllers')->group(function () {
    Route::match(['GET', 'POST'], '/', 'AdminController@login')->name('admin.login');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
        Route::get('logout', 'AdminController@logout')->name('admin.logout');
        Route::prefix('base')->group(function () {
            Route::match(['GET', 'POST'], 'new-post', 'PostController@newPost')->name('admin.newPost');
        });
    });
});

Route::post('/image-upload', [ImageUploadController::class, 'storeImage'])->name('image.upload');
Route::get('/', [HomeController::class, 'home']);
