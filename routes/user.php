<?php

use App\Http\Controllers\UserController;

Route::match(['GET', 'POST'], 'login', [UserController::class, 'login'])->name('login');
Route::match(['GET', 'POST'], 'register', [UserController::class, 'register'])->name('user.register');

Route::prefix('/user')->namespace('\App\Http\Controllers')->middleware(['auth:user'])->group(function () {
    Route::get('/', 'UserController@profile')->name('user.profile');
    Route::get('logout', 'UserController@logout')->name('user.logout');

    Route::post('comment', 'PostCommentController@create')->name('user.comment');
});
