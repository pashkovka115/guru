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

        return view('pages.catalog.category.index', ['tours' => $tours, 'request' => $request]); // todo: $request - временно (после дебага убрать)
    }

    /*
     * одна категория
     * route: site.catalog.category.name
     */
    public function show(Request $request, $id)
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
            return $this->index($request);
        }

        $tours = Tour::with(['variants', 'category', 'leaders', 'comments'])->where('category_tour_id', $id)->paginate(10);

        if ($request->ajax()) {
            return view('pages.catalog.category.ajax_show', ['tours' => $tours]);
        } else {
            return view('pages.catalog.category.show', ['tours' => $tours]);
        }
    }


    protected function filter(Request $request)
    {
//        dd($request->all());
        $category = $request->input('category', false);
        $country = $request->input('country', false);
        $date_picker = $request->input('date-picker', false);
        $range_day_min = $request->input('range-day-min', false);
        $range_day_max = $request->input('range-day-max', false);
        $range_price_min = $request->input('range-price-min', false);
        $range_price_max = $request->input('range-price-max', false);

        $tours = Tour::with(['variants', 'category', 'leaders', 'comments']);

        if ($category) {
            $tours->whereIn('category_tour_id', $category);
        }
        if ($country) {
            $tours->whereIn('country', $country);
        }
        if ($date_picker) {
            $sp_date = explode('|', $date_picker);

            if (isset($sp_date[0])) {
                $tours->whereHas('variants', function ($q) use ($sp_date) {
                    $q->where('date_start_variant', '>=', $sp_date[0]);
                });
            }
            if (isset($sp_date[1])) {
                $tours->whereHas('variants', function ($q) use ($sp_date) {
                    $q->where('date_end_variant', '<=', $sp_date[1]);
                });
            }
        }

        if ($range_price_min) {
            $tours->whereHas('variants', function ($q) use ($range_price_min) {
                $q->where('price_variant', '>=', $range_price_min);
            });
        }

        if ($range_price_max) {
            $tours->whereHas('variants', function ($q) use ($range_price_max) {
                $q->where('price_variant', '<=', $range_price_max);
            });
        }



        if ($range_day_min and $range_day_max){
            $collect = $tours->paginate(10);
            return $collect->filter(function ($value) use ($range_day_min, $range_day_max){
//                dd($value);

                foreach ($value->variants as $variant){
                    $start = \Carbon\Carbon::create($variant->date_start_variant);
                    $end = \Carbon\Carbon::create($variant->date_end_variant);
                    $diff = $start->diffInDays($end);
                    if (($range_day_max - $range_day_min) <= $diff){
                        return true;
                    }
                }
            })->forPage($request->get('page'), 10);
        }




        return $tours->paginate(10);
    }
}
































