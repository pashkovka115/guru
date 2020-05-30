<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Models\Page;

class PageController extends Controller
{
    public $title = 'Страницы';


    public function index()
    {
        $pages = Page::paginate();
        return view('admin::pages.pages.index', ['pages' => $pages, 'title' => $this->title, 'title_page' => 'Список страниц']);
    }


    public function create()
    {
        return view('admin::pages.pages.create', ['title' => $this->title, 'title_page' => 'Новая страница']);
    }


    public function store(Request $request)
    {
        $page = Page::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        session()->flash('message', 'Создано');
        return redirect()->route('admin.page.edit', ['page' => $page->id]);
    }


    public function show($id)
    {
        $page = Page::where('id', $id)->firstOrFail();
        return view('admin::pages.pages.show', ['page' => $page, 'title' => $this->title, 'title_page' => 'Просмотр страницы']);
    }


    public function edit($id)
    {
        $page = Page::where('id', $id)->firstOrFail();
        return view('admin::pages.pages.edit', ['page' => $page, 'title' => $this->title, 'title_page' => 'Редактирование страницы']);
    }


    public function update(Request $request, $id)
    {
        Page::where('id', $id)->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'sort' => $request->input('sort'),
            'slug' => $request->input('slug')
        ]);
        session()->flash('message', 'Обновил');
        return redirect()->back();
    }


    public function destroy($id)
    {
        Page::where('id', $id)->delete();
        session()->flash('message', 'Удалил');
        return redirect()->back();
    }
}
