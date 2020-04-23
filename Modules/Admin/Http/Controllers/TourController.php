<?php

namespace Modules\Admin\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Models\CategoryTour;
use Modules\Admin\Models\Tour;

class TourController extends Controller
{
    public $title = 'Туры';

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $tours = Tour::paginate();
        return view('admin::pages.tour.index', ['tours' => $tours, 'title_page' => 'Список туров', 'title' => $this->title]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $categories = CategoryTour::all(['id', 'title']);
        return view('admin::pages.tour.create', ['categories' => $categories, 'title' => $this->title, 'title_page' => 'Новый тур']);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $tour = Tour::create([
            "active" => ($request->has('active')) ? '1' : '0',
            "good" => ($request->has('good')) ? '1' : '0',
            "title" => $request->input('title'),
            "h1" => $request->input('h1'),
            "price" => $request->input('price'),
            "excerpt" => $request->input('excerpt'),
            "description" => $request->input('description'),
            "date_start" => $request->input('date_start'),
            "date_end" => $request->input('date_end'),
            "img" => $request->input('img'),
            'ceremony' => $request->input('ceremony'),
            'transfer' => $request->input('transfer'),
            'number_of_people' => $request->input('number_of_people'),
            'nutrition' => $request->input('nutrition'),
            'hostel' => $request->input('hostel'),
            'some_text' => $request->input('some_text'),
        ]);

        $category = CategoryTour::where('id', (int)$request->input('category'))->first();
        $category->tours()->attach($tour->id);

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
        $tour = Tour::with('categories')->where('id', $id)->first();
        return view('admin::pages.tour.show', ['title_page' => 'Просмотр тура', 'title' => $this->title, 'tour' => $tour]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $tour = Tour::with('categories')->where('id', $id)->first();
        $categories = CategoryTour::all();
        return view('admin::pages.tour.edit', [
            'tour' => $tour,
            'categories' => $categories,
            'title' => $this->title,
            'title_page' => 'Редактирование тура'
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
        Tour::where('id', $id)->update([
            "active" => ($request->has('active')) ? '1' : '0',
            "good" => ($request->has('good')) ? '1' : '0',
            "title" => $request->input('title'),
            "h1" => $request->input('h1'),
            "price" => $request->input('price'),
            "excerpt" => $request->input('excerpt'),
            "description" => $request->input('description'),
            "date_start" => Carbon::createFromFormat('d.m.Y', $request->input('date_start'))->format('Y-m-d'),
            "date_end" => Carbon::createFromFormat('d.m.Y', $request->input('date_end'))->format('Y-m-d'),
            "img" => $request->input('img'),
            'ceremony' => $request->input('ceremony'),
            'transfer' => $request->input('transfer'),
            'number_of_people' => $request->input('number_of_people'),
            'nutrition' => $request->input('nutrition'),
            'hostel' => $request->input('hostel'),
            'some_text' => $request->input('some_text'),
        ]);

        $tour = Tour::with('categories')->find($id);
        $tour->categories()->sync((int)$request->input('category'));

        session()->flash('message', 'Обновлено');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Tour::where('id', $id)->delete();

        return redirect()->back();
    }
}
