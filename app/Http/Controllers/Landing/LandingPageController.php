<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Modules\Admin\Models\Landing;


class LandingPageController extends Controller
{
    public function index()
    {
        $titles = Landing::where('post_type', 'title')->orderBy('sort')->get();
        $headers = Landing::where('post_type', 'header')->orderBy('sort')->get();
        $posts = Landing::where('post_type', 'post')->orderBy('sort')->get();
        $decoratives = Landing::where('post_type', 'decorative')->orderBy('sort')->get();
        $progresies = Landing::where('post_type', 'progress')->orderBy('sort')->get();
        $contents = Landing::where('post_type', 'content')->orderBy('sort')->get();

        return view('pages.landing.index', [
            'titles' => $titles,
            'headers' => $headers,
            'posts' => $posts,
            'decoratives' => $decoratives,
            'progresies' => $progresies,
            'contents' => $contents,
        ]);
    }
}
