<?php

Route::prefix('admin')->middleware('admin_auth')->group(function() {
//    После добавления маршрута необходимо создать разрешения для этого маршрута в
//    \App\Http\Middleware\CheckPermissions::class и в базе данных(или в сиде RolesAndPermissionsSeeder.php)

    Route::get('/', 'DashboardController@index')->name('admin.dashboard.index');
    Route::get('users-requests', 'DashboardController@requests')->name('admin.dashboard.requests');

    Route::prefix('dashboard')->group(function (){
        Route::get('store/{id}', 'DashboardController@store')->name('admin.dashboard.auth.user');
//        Route::get('edit', 'DashboardController@edit')->name('admin.dashboard.edit');
//        Route::post('add-field', 'DashboardController@add_field')->name('admin.landing.add_field');
//        Route::post('update', 'DashboardController@update')->name('admin.dashboard.update');
//        Route::get('destroy/{id}', 'DashboardController@destroy')->name('admin.dashboard.destroy');
    });

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

    Route::prefix('tour')->group(function (){
        Route::get('', 'Tour\IndexController@index')->name('admin.tour.index');
        //Route::get('destroy/{id}', 'Tour\IndexController@destroy')->name('admin.tour.destroy');
        Route::resource('general', 'Tour\GeneralController')->except('index')
            ->names('admin.tour.general');
    });

    Route::resource('page', 'PageController')
        ->names('admin.page');

    Route::resource('category_post', 'CategoryPostController')
        ->names('admin.category_post');

    Route::resource('post', 'PostController')
        ->names('admin.post');


    Route::prefix('landing')->group(function (){
        Route::get('show', 'LandingController@show')->name('admin.landing.show');
        Route::get('edit', 'LandingController@edit')->name('admin.landing.edit');
        Route::post('add-field', 'LandingController@add_field')->name('admin.landing.add_field');
        Route::post('update', 'LandingController@update')->name('admin.landing.update');
        Route::get('destroy/{id}', 'LandingController@destroy')->name('admin.landing.destroy');
    });

    Route::prefix('about-us')->group(function (){
        Route::get('show', 'AboutController@show')->name('admin.about.show');
        Route::get('edit', 'AboutController@edit')->name('admin.about.edit');
        Route::post('add-field', 'AboutController@add_field')->name('admin.about.add_field');
        Route::post('update', 'AboutController@update')->name('admin.about.update');
        Route::get('destroy/{id}', 'AboutController@destroy')->name('admin.about.destroy');
    });

    Route::prefix('home')->group(function (){
        Route::get('show', 'HomeController@show')->name('admin.home.show');
        Route::get('edit', 'HomeController@edit')->name('admin.home.edit');
        Route::post('add-field', 'HomeController@add_field')->name('admin.home.add_field');
        Route::post('update', 'HomeController@update')->name('admin.home.update');
        Route::get('destroy/{id}', 'HomeController@destroy')->name('admin.home.destroy');
    });

    Route::prefix('settings')->group(function (){
        Route::resource('soc_network', 'Settings\SocialNetworkController')->except('show')->names('admin.settings.soc_network');

        Route::prefix('help')->group(function (){
            Route::get('show', 'HelpController@show')->name('admin.help.show');
            Route::get('edit', 'HelpController@edit')->name('admin.help.edit');
            Route::post('add-field', 'HelpController@add_field')->name('admin.help.add_field');
            Route::post('update', 'HelpController@update')->name('admin.help.update');
//            Route::get('destroy/{id}', 'HomeController@destroy')->name('admin.home.destroy');
        });
    });
});
