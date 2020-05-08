<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'Home\MainController@index')->name('site.main');

Auth::routes();

Route::get('/author', 'Catalog\UserController@index')->name('site.author.list');
Route::get('/author/{id}', 'Catalog\UserController@show')->name('site.author.show');

Route::resource('tour', 'Catalog\TourController')->only('show')->names('site.catalog.tour');

Route::get('/category', 'Catalog\CategoryTourController@index')->name('site.catalog.category.list');
Route::get('/category/{id}', 'Catalog\CategoryTourController@show')->name('site.catalog.category.name');

Route::resource('/tag', 'Catalog\TagController')->only('show')->names('site.catalog.tag');

Route::resource('/journal', 'Journal\BlogController')->only(['index', 'show'])->names('site.journal.blog');

Route::resource('/page', 'Pages\PageController')->only('show')->names('site.pages.official');

Route::post('/search', 'Catalog\SearchController@index')->name('site.catalog.search');
Route::get('/help', 'HelpController@show')->name('site.help.show');

Route::get('add-advert', 'Landing\LandingPageController@index')->name('site.landing');
Route::get('about-us', 'Pages\AboutController@show')->name('site.about');

Route::prefix('cabinet')->middleware('auth')->group(function (){
    Route::get('', function (){ return redirect()->route('site.cabinet.user.index'); });
    Route::resource('/user', 'Cabinet\HomeController')->only(['index', 'edit', 'update'])->names('site.cabinet.user');
    Route::resource('/tour', 'Cabinet\TourController')->only(['index', 'create', 'store', 'edit', 'update'])->names('site.cabinet.tour');
    Route::resource('/leaders', 'Cabinet\LeaderController')->except('show')->names('site.cabinet.leaders');
    Route::resource('/messages', 'Cabinet\MessageController')->only(['index', 'destroy'])->names('site.cabinet.message');
    Route::resource('/reviews', 'Cabinet\ReviewController')->only(['index'])->names('site.cabinet.review');
    Route::resource('/purchases', 'Cabinet\PurchasesController')->only('index')->names('site.cabinet.purchases');
});

Route::get('/delete-variant-tour/{id}', 'Cabinet\AjaxController@remove_variant_tour')->middleware('auth');
Route::post('/delete-img-gallery-author', 'Cabinet\AjaxController@remove_img_gallery_author')->middleware('auth');

Route::post('/tour-rating-estimate', 'Catalog\TourRatingController@estimate')->name('site.tour.rating.estimate');
Route::post('/send-message', 'Cabinet\MessageController@store')->name('site.send-message-to-leader');




