<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Models\CategoryTour;
use Modules\Admin\Models\Tour;

class CategoryTourController extends Controller
{
    public $title = 'Категории туров';


    public function index()
    {
        $title_page = 'Все категории';
        $categories = CategoryTour::where('id', '>', 0)->orderByDesc('id')->get();
        return view('admin::pages.category_tour.index', ['title_page' => $title_page, 'title' => $this->title, 'categories' => $categories]);
    }


    public function create()
    {
        $title_page = 'Новая категория';
        return view('admin::pages.category_tour.create', ['title_page' => $title_page, 'title' => $this->title]);
    }


    public function store(Request $request)
    {
        $cat = CategoryTour::create(['title' => $request->input('title'), 'img' => $request->input('img')]);

        session()->flash('message', 'Сохранено');
        return redirect()->route('admin.category_tour.edit', ['category_tour' => $cat->id]);
    }


    public function show($id)
    {
        $title_page = 'Просмотр категории';
        $category = CategoryTour::where('id', $id)->firstOrFail();
        return view('admin::pages.category_tour.show', [
            'title_page' => $title_page,
            'title' => $this->title,
            'category' => $category
        ]);
    }


    public function edit($id)
    {
        $title_page = 'Редактировать категорию';
        $category = CategoryTour::where('id', $id)->firstOrFail();
        return view('admin::pages.category_tour.edit', [
            'title_page' => $title_page,
            'title' => $this->title,
            'category' => $category
        ]);
    }


    public function update(Request $request, $id)
    {
        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ];
        if ($request->input('img') != '' and mb_strlen($request->input('img')) > 1) {
            $data['img'] = $request->input('img');
        }
        if ($request->input('icon') != '' and mb_strlen($request->input('icon')) > 1) {
            $data['icon'] = $request->input('icon');
        }
        CategoryTour::where('id', $id)->update($data);

        session()->flash('message', 'Сохранено');
        return redirect()->back();
    }


    public function destroy($id)
    {
        $category = CategoryTour::with('tours')->where('id', $id)->firstOrFail();
        if ($category) {
            if ($category->tours->count() == 0) {
                $category->delete();
                session()->flash('message', 'Удалено');

                return redirect()->back();
            } else {
                return redirect()->back()->withErrors('В этой категории есть туры');
            }
        } else {
            return redirect()->back()->withErrors('Категория не найдена');
        }
    }
}
