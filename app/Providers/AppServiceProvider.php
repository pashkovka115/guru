<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Models\Page;
use Modules\Admin\Models\Tour;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        setlocale(LC_TIME, 'ru_RU.UTF-8');
        Carbon::setLocale(config('app.locale'));
        if (Schema::hasTable('pages')) {
            \View::share('pages_menu', Page::all(['id', 'title']) ?? null);
            \View::share('popular_country', \DB::table('tours')->orderByDesc('views')->limit(10)->get(
                ['id', 'category_tour_id', 'country', 'gallery']
                ) ?? null);

            $tours = \DB::table('tours')->orderByDesc('views')->limit(10)->get();
            \View::share('popular_tour', $tours);

            $cat_ids = array_keys($tours->keyBy('category_tour_id')->toArray());
            \View::share('popular_cats', \DB::table('category_tours')->whereIn('id', $cat_ids)->limit(10)->get(['id', 'title']) ?? null);
        }
    }
}
