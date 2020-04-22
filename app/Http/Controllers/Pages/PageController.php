<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Models\Page;

class PageController extends Controller
{
    public function show($id)
    {
        $page = Page::where('id', $id)->firstOrFail();
        return view('pages.official.show', ['page' => $page]);
    }
}
