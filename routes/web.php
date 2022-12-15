<?php

namespace App\Models;

namespace App\Http\Controllers;

// use App\Models\Admin;

use App\Http\Controllers\HomeController;
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


Route::get('/', [HomeController::class, 'home']);

Route::match(['GET', 'POST'], 'login', [UserController::class, 'login'])->name('login');

Route::prefix('/user')->namespace('\App\Http\Controllers')->middleware(['auth:user'])->group(function () {
    Route::get('/', 'UserController@profile')->name('user.profile');
});


Route::group(['prefix' => 'filemanager', 'middleware' => ['auth:admin', 'auth:user']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
