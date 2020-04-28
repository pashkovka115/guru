<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Models\LandingBloks;

class LandingPageController extends Controller
{
    public function index()
    {
        $landing = LandingBloks::with('parts')->orderBy('sort')->get();

        return view('pages.landing.index', ['landing' => $landing]);
    }
}
