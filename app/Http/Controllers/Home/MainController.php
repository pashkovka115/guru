<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Models\CategoryTour;
use Modules\Admin\Models\Home;
use Modules\Admin\Models\Post;
use Modules\Admin\Models\Tour;

class MainController extends Controller
{
    public function index()
    {
        $limit = 8;

        $categories = CategoryTour::all();
        $recommended_tours = Tour::with(['comments', 'variants'])
            ->where('recommended', '1')
            ->where('active', '1')
            ->limit($limit)
            ->get();
        if ($recommended_tours->count() < $limit){
            $max_views_tours = Tour::with(['comments', 'variants'])
                ->where('active', '1')
                ->orderByDesc('views')
                ->limit($limit)
                ->get();
            // Вначале вытаскиваем если админ назначил, потом добиваем с максимальным просмотром
            $recommended_tours = $recommended_tours->merge($max_views_tours);
        }

        $posts = \DB::table('posts')->where('id', '>', 0)->orderByDesc('created_at')->limit(2)->get();
        $titles = Home::where('post_type', 'title')->get();
        $our_ideas = Home::where('post_type', 'content')->get();
        $our_progress = Home::where('post_type', 'progress')->get();

        \View::share('categories', $categories);
        \View::share('home_header_titles', $titles);

        return view('pages.home.index', [
            'categories' => $categories,
            'recommended_tours' => $recommended_tours,
            'posts' => $posts,
            'our_ideas' => $our_ideas,
            'our_progress' => $our_progress
        ]);
    }
}
