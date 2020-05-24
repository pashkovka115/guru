<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Models\CategoryPost;

class CategoryPostController extends Controller
{
    public $title = 'Категории записей';

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $categories = CategoryPost::paginate();
        return view('admin::pages.category_post.index', ['categories' => $categories, 'title' => $this->title, 'title_page' => 'Список категорий']);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin::pages.category_post.create', ['title' => $this->title, 'title_page' => 'Новая категория']);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        CategoryPost::create([
            'title' => $request->input('title')
        ]);
        session()->flash('message', 'Сохранено');
        return redirect()->back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $category = CategoryPost::where('id', $id)->firstOrFail();
        return view('admin::pages.category_post.show', ['category' => $category, 'title' => $this->title, 'title_page' => 'Просмотр категории']);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $category = CategoryPost::where('id', $id)->firstOrFail();
        return view('admin::pages.category_post.edit', ['category' => $category, 'title' => $this->title, 'title_page' => 'Редактирование категории']);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        CategoryPost::where('id', $id)->update([
            'title' => $request->input('title')
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
        $category = CategoryPost::with('posts')->where('id', $id)->firstOrFail();
        if ($category and $category->posts->count() == 0) {
            $category->delete();
            session()->flash('message', 'Удалено');
            return redirect()->back();
        }

        return redirect()->back()->withErrors('В этой категории есть записи');
    }
}
