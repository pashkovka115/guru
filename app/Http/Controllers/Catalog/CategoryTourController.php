<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Models\CategoryTour;

class CategoryTourController extends Controller
{
    /*
     * одна категория
     */
    public function show($id)
    {
        $category = CategoryTour::with('tours_with_variants')->where('id', $id)->firstOrFail();

        return view('pages.catalog.category.show', ['category' => $category]);
    }
}
