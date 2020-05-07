<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Models\CategoryTour;

class CategoryTourController extends Controller
{
    /*
     * Случайная категория
     */
    public function index()
    {
        $ids = CategoryTour::all('id')->keyBy('id')->toArray();
        $rand_id = $ids[array_rand($ids)];
        $category = CategoryTour::with('tours_with_variants')->where('id', $rand_id)->firstOrFail();

        return view('pages.catalog.category.index', ['category' => $category]);
    }
    /*
     * одна категория
     */
    public function show($id)
    {
        $category = CategoryTour::with('tours_with_variants')->where('id', $id)->firstOrFail();

        return view('pages.catalog.category.show', ['category' => $category]);
    }
}
