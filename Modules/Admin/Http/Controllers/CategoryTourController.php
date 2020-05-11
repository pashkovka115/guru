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

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $title_page = 'Все категории';
        $categories = CategoryTour::all();
        return view('admin::pages.category_tour.index', ['title_page' => $title_page, 'title' => $this->title, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $title_page = 'Новая категория';
        return view('admin::pages.category_tour.create', ['title_page' => $title_page, 'title' => $this->title]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        CategoryTour::create(['title' => $request->input('title'), 'img' => $request->input('img')]);

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
        $title_page = 'Просмотр категории';
        $category = CategoryTour::where('id', $id)->first();
        return view('admin::pages.category_tour.show', [
            'title_page' => $title_page,
            'title' => $this->title,
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $title_page = 'Редактировать категорию';
        $category = CategoryTour::where('id', $id)->first();
        return view('admin::pages.category_tour.edit', [
            'title_page' => $title_page,
            'title' => $this->title,
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = [
            'title' => $request->input('title'),
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

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $category = CategoryTour::with('tours')->where('id', $id)->first();
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
