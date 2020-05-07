<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Models\CategoryTour;
use Modules\Admin\Models\Tour;

class CategoryTourController extends Controller
{
    /*
     * Случайная категория
     */
    public function index(Request $request)
    {
        $ids = CategoryTour::all('id')->keyBy('id')->toArray();
        $rand_id = $ids[array_rand($ids)];
        $tours = Tour::with(['variants', 'category', 'leaders', 'comments'])->where('category_tour_id', $rand_id)->paginate(2);

        if ($request->ajax()) {
            return view('pages.catalog.category.ajax_index', ['tours' => $tours]);
        } else {
            return view('pages.catalog.category.index', ['tours' => $tours]);
        }
    }

    /*
     * одна категория
     */
    public function show(Request $request, $id)
    {
        $tours = Tour::with(['variants', 'category', 'leaders', 'comments'])->where('category_tour_id', $id)->paginate(2);

        if ($request->ajax()){
            return view('pages.catalog.category.ajax_show', ['tours' => $tours]);
        }else{
            return view('pages.catalog.category.show', ['tours' => $tours]);
        }
    }
}
