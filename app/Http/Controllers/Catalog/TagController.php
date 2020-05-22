<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Models\ToursTags;

class TagController extends Controller
{
    /*
     * Вывод мероприятий по тегам (как категории)
     */
    public function show($id)
    {
        $tag = ToursTags::with('tours')->where('id', $id)->firstOrFail();

        return view('pages.catalog.tag.show', ['tag' => $tag]);
    }
}
