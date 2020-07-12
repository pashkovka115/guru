<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Models\CategoryTour;
use Modules\Admin\Models\Tour;

class CategoryTourController extends Controller
{
    /*
     * Все категории
     * route: site.catalog.category.list
     */
    public function index(Request $request)
    {
        if ($request->method() == 'GET' and
            (
                $request->has('category') or
                $request->has('country') or
                $request->has('date-picker') or
                $request->has('range-day-min') or
                $request->has('range-day-max') or
                $request->has('range-price-min') or
                $request->has('range-price-max')
            )
        ) {
            $tours = $this->filter($request);
        } else {
            $tours = Tour::with(['variants', 'category', 'leaders', 'comments'])->where('id', '>', 0)->paginate(10);
        }

        if ($request->ajax()) {
            return view('pages.catalog.category.ajax_index', ['tours' => $tours]);
        }

        return view('pages.catalog.category.index', ['tours' => $tours]);
    }

    /*
     * одна категория
     * route: site.catalog.category.name
     */
    public function show(Request $request, $id)
    {
        $tours = Tour::with(['variants', 'category', 'leaders', 'comments'])->where('category_tour_id', $id)->paginate(10);

        if ($request->ajax()) {
            return view('pages.catalog.category.ajax_show', ['tours' => $tours]);
        } else {
            return view('pages.catalog.category.show', ['tours' => $tours]);
        }
    }


    protected function filter(Request $request)
    {
        dd($request->all());
        $category = $request->input('category', false);
        $country = $request->input('country', false);
        $date_picker = $request->input('date-picker', false); // todo: ждём переделки даты с 07.10.20 на 07.10.2020
        $range_day_min = $request->input('range-day-min', false);
        $range_day_max = $request->input('range-day-max', false);
        $range_price_min = $request->input('range-price-min', false);
        $range_price_max = $request->input('range-price-max', false);

        $tours = Tour::with(['variants', 'category', 'leaders', 'comments']);

        if ($category){
            $ids_cat = explode(',', $category);
            $tours->whereIn('category_tour_id', $ids_cat);
        }
        if ($country){
            $country = str_replace('+', ' ', $country);
            $sp_countries = explode(',', $country);
            $tours->whereIn('country', $sp_countries);
        }
        /*if ($date_picker){
//            todo: ждём переделки даты с 07.10.20 на 07.10.2020
        и  преобразовать date-picker=07.10.20+-+07.26.20 в два значения
            $tours->where('country', );
        }*/
        if ($range_price_min){
//            $tours->where('price_variant', '>=', (int)$range_price_min);
        }

//        if ($range_price_max){
//            $tours->variants()->where('price_variant', '<=', (int)$range_price_max);
//        }

        /*

        if ($range_day_min){
            $tours->where('', );
        }
        if ($range_day_max){
            $tours->where('', );
        }
        */




            return $tours->paginate(10);
    }
}
































