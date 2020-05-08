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
        $categories = CategoryTour::all();
        $recommended_tours = Tour::with(['comments', 'variants'])
            ->where('recommended', '1')
            ->limit(8)
            ->get();

        $posts = \DB::table('posts')->where('id', '>', 0)->orderByDesc('created_at')->limit(2)->get();
        $our_ideas = Home::where('post_type', 'content')->get();
        $our_progress = Home::where('post_type', 'progress')->get();

        return view('pages.home.index', [
            'categories' => $categories,
            'recommended_tours' => $recommended_tours,
            'posts' => $posts,
            'our_ideas' => $our_ideas,
            'our_progress' => $our_progress
        ]);
    }
}
