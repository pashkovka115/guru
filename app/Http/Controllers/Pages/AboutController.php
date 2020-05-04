<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Models\About;

class AboutController extends Controller
{
    public function show()
    {
        $titles = About::where('post_type', 'title')->orderBy('sort')->get();
        $contents = About::where('post_type', 'content')->get();
        $team = About::where('post_type', 'people')->get();
        $progress = About::where('post_type', 'progress')->get();

        return view('pages.about_us.show', [
            'titles' => $titles,
            'contents' => $contents,
            'team' => $team,
            'progress' => $progress
        ]);
    }
}
