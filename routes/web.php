<?php

namespace App\Models;

// use App\Models\Admin;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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
Route::match(['GET', 'POST'], 'login', [UserController::class, 'login'])->name('login');
Route::match(['GET', 'POST'], 'register', [UserController::class, 'register'])->name('user.register');


Route::prefix('/user')->namespace('\App\Http\Controllers')->middleware(['auth:user'])->group(function () {
    Route::get('/', 'UserController@profile')->name('user.profile');
    Route::get('logout', 'UserController@logout')->name('user.logout');
});

// FILE MANAGER
Route::group(['prefix' => 'filemanager', 'middleware' => ['auth:admin', 'auth:user']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


require __DIR__ . '/admin.php';
