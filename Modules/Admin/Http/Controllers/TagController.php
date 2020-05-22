<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Models\ToursTags;
use Modules\Admin\Models\ToursTagsTours;

class TagController extends Controller
{
    public $title_page = 'Теги';

    public function index()
    {
        $tags = ToursTags::paginate(50);

        return view('admin::pages.tags.index', ['tags' => $tags, 'title_page' => $this->title_page]);
    }


    public function create()
    {
        return view('admin::pages.tags.create', ['title_page' => 'Новый тег']);
    }


    public function store(Request $request)
    {
        $tag = new ToursTags(['tag' => $request->input('tag')]);
        $tag->save();
        session()->flash('message', 'Создано');
        return redirect()->route('admin.tour.tags.index');
    }


    public function show($id)
    {
        $tag = ToursTags::where('id', $id)->firstOrFail();
        return view('admin::pages.tags.show', ['tag' => $tag, 'title_page' => 'Тег']);
    }


    public function edit($id)
    {
        $tag = ToursTags::where('id', $id)->firstOrFail();
        return view('admin::pages.tags.edit', ['tag' => $tag, 'title_page' => 'Редактируем тег']);
    }


    public function update(Request $request, $id)
    {
        ToursTags::where('id', $id)->update([
            'tag' => $request->input('tag')
        ]);
        session()->flash('message', 'Обновил');
        return redirect()->back();
    }


    public function destroy($id)
    {
        $tag = ToursTags::with('tours')->where('id', $id)->firstOrFail();
        ToursTagsTours::where('tour_tag_id', $id)->delete();
        $tag->delete();
        return redirect()->back();
    }
}
