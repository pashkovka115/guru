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
//        $ids = CategoryTour::all('id')->keyBy('id')->toArray();
//        if (count($ids) > 0) {
//            $rand_id = $ids[array_rand($ids)];
            $tours = Tour::with(['variants', 'category', 'leaders', 'comments'])->where('id', '>', 0)->paginate(10);

            if ($request->ajax()) {
                return view('pages.catalog.category.ajax_index', ['tours' => $tours]);
            } else {
                return view('pages.catalog.category.index', ['tours' => $tours]);
            }
//        }
        return 'Нет категорий для отображения';
    }

    /*
     * одна категория
     */
    public function show(Request $request, $id)
    {
        $tours = Tour::with(['variants', 'category', 'leaders', 'comments'])->where('category_tour_id', $id)->paginate(10);

        if ($request->ajax()){
            return view('pages.catalog.category.ajax_show', ['tours' => $tours]);
        }else{
            return view('pages.catalog.category.show', ['tours' => $tours]);
        }
    }
}
