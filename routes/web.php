<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/user', 'Catalog\UserController@index')->name('site.user.list');
Route::get('/user/{id}', 'Catalog\UserController@show')->name('site.user.show');

Route::resource('tour', 'Catalog\TourController')->only('show')->names('site.catalog.tour');

Route::get('/category', function (){ return redirect()->to('/'); });
Route::get('/category/{id}', 'Catalog\CategoryTourController@show')->name('site.catalog.category.name');

Route::resource('/journal', 'Journal\BlogController')->only(['index', 'show'])->names('site.journal.blog');

Route::resource('/page', 'Pages\PageController')->only('show')->names('site.pages.official');

Route::get('add-advert', 'Landing\LandingPageController@index')->name('site.landing');

Route::prefix('cabinet')->middleware('auth')->group(function (){
    Route::get('', function (){ return redirect()->route('site.cabinet.user.index'); });
    Route::resource('/user', 'Cabinet\HomeController')->only(['index', 'edit', 'update'])->names('site.cabinet.user');
    Route::resource('/tour', 'Cabinet\TourController')->only(['index', 'create', 'store', 'edit', 'update'])->names('site.cabinet.tour');
    Route::resource('/leaders', 'Cabinet\LeaderController')->except('show')->names('site.cabinet.leaders');
    Route::resource('/messages', 'Cabinet\MessageController')->only(['index', 'destroy'])->names('site.cabinet.message');
    Route::resource('/reviews', 'Cabinet\ReviewController')->only(['index'])->names('site.cabinet.review');
    Route::resource('/purchases', 'Cabinet\PurchasesController')->only('index')->names('site.cabinet.purchases');
});

Route::post('/tour-rating-estimate', 'Catalog\TourRatingController@estimate')->name('site.tour.rating.estimate');

Route::post('/send-message', 'Cabinet\MessageController@store')->name('site.send-message-to-leader');




