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
        $tour = Tour::with(['variants', 'leaders'])->where('id', $id)->firstOrFail();
        $tour->views++;
        $tour->save();
        $comments = TourRating::with('user')->where('tour_id', $tour->id)->get();
        $similar_tours = Tour::where('country', $tour->country)->limit(4)->get(['id', 'title', 'rating', 'gallery']);

        return view('pages.catalog.tours.show', ['tour' => $tour, 'comments' => $comments, 'similar_tours' => $similar_tours]);
    }
}
