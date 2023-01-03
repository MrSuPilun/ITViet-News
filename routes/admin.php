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

        Route::prefix('table')->group(function () {
            Route::prefix('tag')->group(function () {
                Route::get('show-tag', 'TagController@showTags')->name('admin.showTag');
                Route::get('get-tag', 'TagController@getTags')->name('admin.getTag');
                Route::post('delete-tag', 'TagController@deleteTag')->name('admin.deleteTag');
                Route::post('new-tag', 'TagController@newTag')->name('admin.newTag');
                Route::match(['GET', 'POST'], 'update-tag', 'TagController@updateTag')->name('admin.updateTag');
            });

            Route::prefix('user')->group(function () {
                Route::get('show-user', 'UserManagementController@showUsers')->name('admin.showUser');
                Route::get('get-user', 'UserManagementController@getUsers')->name('admin.getUser');
                Route::post('delete-user', 'UserManagementController@deleteUser')->name('admin.deleteUser');
                Route::post('new-user', 'UserManagementController@newUser')->name('admin.newUser');
                Route::match(['GET', 'POST'], 'update-user', 'UserManagementController@updateUser')->name('admin.updateUser');
            });

            Route::prefix('manager')->group(function () {
                Route::get('show-manager', 'AdminManagementController@showManagers')->name('admin.showManager');
                Route::get('get-manager', 'AdminManagementController@getManagers')->name('admin.getManager');
                Route::post('delete-manager', 'AdminManagementController@deleteManager')->name('admin.deleteManager');
                Route::post('new-manager', 'AdminManagementController@newManager')->name('admin.newManager');
                Route::match(['GET', 'POST'], 'update-manager', 'AdminManagementController@updateManager')->name('admin.updateManager');
            });
        });

        Route::prefix('custom-layout')->group(function () {
            Route::prefix('feature-post')->group(function () {
                Route::get('show', 'FeaturePostController@show')->name('admin.showFeaturePost');
                Route::get('get', 'FeaturePostController@get')->name('admin.getFeaturePost');
                Route::post('new', 'FeaturePostController@new')->name('admin.newFeaturePost');
                Route::post('delete', 'FeaturePostController@delete')->name('admin.deleteFeaturePost');
                Route::match(['GET', 'POST'], 'update', 'FeaturePostController@update')->name('admin.updateFeaturePost');
            });
        });

        Route::prefix('preview')->group(function () {
            Route::get('show-feature-post', 'PreviewController@showFeaturePost')->name('admin.preview.showFeaturePost');
        });
    });
});

// FILE MANAGER
Route::group(['prefix' => 'filemanager', 'middleware' => ['auth:admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
