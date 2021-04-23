<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Models\Tour;
use Modules\Admin\Models\TourRating;

class TourController extends Controller
{
    public function index()
    {
        //
    }

    public function show($id)
    {
        $tour = Tour::with(['variants', 'leaders'])
            ->where('id', $id)
            ->where('active', '1')
            ->firstOrFail();

        $tour->views++;
        if (is_admin()){
            $tour->new = '0';
        }
        $tour->save();
        $comments = TourRating::with('user')->where('tour_id', $tour->id)->get();
        $similar_tours = Tour::where('country', $tour->country)->limit(4)->get(['id', 'title', 'rating', 'gallery']);

        $all_raiting = 0;
        foreach ($comments as $comment) {
            $all_raiting += $comment->rating;
        }
        if ($comments->count() > 0) {
            $full_raiting = $all_raiting / $comments->count();
        } else {
            $full_raiting = 0;
        }

        return view('pages.catalog.tours.show', ['tour' => $tour, 'comments' => $comments, 'similar_tours' => $similar_tours, 'full_raiting' => $full_raiting]);
    }
}
