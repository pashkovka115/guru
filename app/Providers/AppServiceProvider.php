<?php

namespace App\Providers;

use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Models\CategoryTour;
use Modules\Admin\Models\Page;
use Modules\Admin\Models\Tour;
use Modules\Admin\Models\TourVariant;
use Route;

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

            \View::share('pages_menu', Page::where('id', '>', 0)->orderBy('sort')->get(['id', 'title', 'slug']) ?? null);

            \View::share('popular_country', \DB::table('tours')->orderByDesc('views')->limit(11)->get(
                ['id', 'title', 'category_tour_id', 'country', 'gallery']
                ) ?? null);

            \View::share('popular_tours', \DB::table('tours')
                    ->where('active', '1')
                    ->orderByDesc('views')
                    ->limit(6)
                    ->get(['id', 'title', 'category_tour_id', 'country', 'gallery', 'views'])
                ?? null);

            \View::share('popular_tours_for_menu', \DB::table('tours')
                    ->where('active', '1')
                    ->orderByDesc('views')
                    ->limit(15)
                    ->get(['id', 'title', 'views'])
                ?? null);

            $tours = \DB::table('tours')->orderByDesc('views')->limit(10)->get();
            \View::share('popular_tour', $tours);

            $cat_ids = array_keys($tours->keyBy('category_tour_id')->toArray());
            \View::share('popular_cats', \DB::table('category_tours')->whereIn('id', $cat_ids)->limit(10)->get(['id', 'title']) ?? null);

            \View::share('cnt_leaders', User::whereHas('profile', function ($query){
                $query->where('type_user', 'leader');
            })->count());

            \View::share('cnt_organizers', User::whereHas('profile', function ($query){
                $query->where('type_user', 'organizer');
            })->count());

            \View::composer(['parts.filter_panel', 'parts.footer'], function ($view){
                $view->with([
                    'all_categories' => CategoryTour::all(['id', 'title']),
                    'countries' => DB::table('tours')->select('country')->distinct()->get(),
                    'max_price' => TourVariant::max('price_variant'),
                    'min_price' => TourVariant::min('price_variant'),
                ]);
            });
        }
    }
}
