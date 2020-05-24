<?php

namespace Modules\Admin\Http\Controllers\Tour;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Models\Tour;

class IndexController extends Controller
{
    public $title = 'Туры';

    public function index()
    {
        $tours = Tour::with('category')->orderByDesc('id')->paginate();
        return view('admin::pages.tour.index', ['tours' => $tours, 'title_page' => 'Список туров', 'title' => $this->title]);
    }
}
