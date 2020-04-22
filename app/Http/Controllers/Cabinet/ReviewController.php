<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Models\Tour;
use Modules\Admin\Models\TourRating;
use Modules\Admin\Models\UserComment;

class ReviewController extends Controller
{
    public function index()
    {
        // какой тур я комментировал
        $my_comments = TourRating::with('tour')->where('user_id', auth()->id())->get();

        // айдишники моих туров
        $ids = Tour::where('user_id', auth()->id())->get('id');
        // кто мой(организатора) тур комментировал
        if ($ids) {
            $me_comments = TourRating::with('tour')->whereIn('tour_id', $ids)->get();
        }

        return view('pages.cabinet.review.index', ['my_comments' => $my_comments, 'me_comments' => $me_comments ?? []]);
    }
}



















