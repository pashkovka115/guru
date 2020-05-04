<?php

Route::prefix('admin')->middleware('admin_auth')->group(function() {
//    После добавления маршрута необходимо создать разрешения для этого маршрута в
//    \App\Http\Middleware\CheckPermissions::class и в базе данных(или в сиде RolesAndPermissionsSeeder.php)

    Route::resource('/', 'DashboardController')
        ->only(['index'])->names('admin.dashboard');

    Route::resource('user', 'UserController')
        ->names('admin.user');

    Route::resource('permission', 'PermissionController')
        ->except(['create', 'store', 'destroy'])->names('admin.permission');

    Route::resource('role', 'RoleController')
        ->names('admin.role');

    Route::resource('user_role', 'UserRoleController')
        ->only(['index','show','edit','update'])->names('admin.user_role');

    Route::resource('category_tour', 'CategoryTourController')
        ->names('admin.category_tour');

    Route::resource('tour', 'TourController')
        ->names('admin.tour');

    Route::resource('page', 'PageController')
        ->names('admin.page');

    Route::resource('category_post', 'CategoryPostController')
        ->names('admin.category_post');

    Route::resource('post', 'PostController')
        ->names('admin.post');

    Route::resource('landing', 'LandingController')->only(['index', 'update'])->names('admin.landing');

    Route::prefix('about-us')->group(function (){
        Route::get('show', 'AboutController@show')->name('admin.about.show');
        Route::get('edit', 'AboutController@edit')->name('admin.about.edit');
        Route::post('add-field', 'AboutController@add_field')->name('admin.about.add_field');
        Route::post('update', 'AboutController@update')->name('admin.about.update');
        Route::get('destroy/{id}', 'AboutController@destroy')->name('admin.about.destroy');
    });
});
