<?php

Route::prefix('/admin')->namespace('\App\Http\Controllers')->group(function () {
    Route::match(['GET', 'POST'], '/', 'AdminController@login')->name('admin.login');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
        Route::get('logout', 'AdminController@logout')->name('admin.logout');
        Route::prefix('base')->group(function () {
            Route::match(['GET', 'POST'], 'new-post', 'PostController@newPost')->name('admin.newPost');
            Route::match(['GET', 'POST'], 'update-post', 'PostController@updatePost')->name('admin.updatePost');

            Route::get('show-post', 'PostController@showPosts')->name('admin.showPost');
            Route::get('get-post', 'PostController@getPosts')->name('admin.getPost');

            Route::post('delete-post', 'PostController@deletePost')->name('admin.deletePost');

            Route::get('show-trash-post', 'TrashPostController@showTrashPosts')->name('admin.showTrashPost');
            Route::get('get-trash-post', 'TrashPostController@getTrashPosts')->name('admin.getTrashPost');
            Route::post('delete-trash-post', 'TrashPostController@deleteTrashPost')->name('admin.deleteTrashPost');
            Route::post('restore-trash-post', 'TrashPostController@restoreTrashPost')->name('admin.restoreTrashPost');
        });
    });
});

// FILE MANAGER
Route::group(['prefix' => 'filemanager', 'middleware' => ['auth:admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
