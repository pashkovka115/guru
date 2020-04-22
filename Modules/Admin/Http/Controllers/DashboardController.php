<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public $title = 'Панель администратора';


    public function index()
    {
        return view('admin::pages.dashboard.index', ['title' => $this->title, 'title_page' => 'Виджеты']);
    }
}
