<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Models\Page;

class PageController extends Controller
{
    public $title = 'Страницы';

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $pages = Page::paginate();
        return view('admin::pages.pages.index', ['pages' => $pages, 'title' => $this->title, 'title_page' => 'Список страниц']);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin::pages.pages.create', ['title' => $this->title, 'title_page' => 'Новая страница']);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Page::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        session()->flash('message', 'Создано');
        return redirect()->back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $page = Page::where('id', $id)->first();
        return view('admin::pages.pages.show', ['page' => $page, 'title' => $this->title, 'title_page' => 'Просмотр страницы']);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $page = Page::where('id', $id)->first();
        return view('admin::pages.pages.edit', ['page' => $page, 'title' => $this->title, 'title_page' => 'Редактирование страницы']);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
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

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Page::where('id', $id)->delete();
        session()->flash('message', 'Удалил');
        return redirect()->back();
    }
}
