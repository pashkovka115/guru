<?php

namespace Modules\Admin\Http\Controllers\Tour;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Models\CategoryTour;
use Modules\Admin\Models\Tour;
use Modules\Admin\Models\TourLeader;

class GeneralController extends Controller
{
    public $title = 'Туры';


    public function create()
    {
        return view('admin::create');
    }


    public function store(Request $request)
    {

    }


    public function show($id)
    {
        $tour = Tour::with('category')->where('id', $id)->first();
        return view('admin::pages.tour.general.show', ['title_page' => 'Просмотр тура', 'title' => $this->title, 'tour' => $tour]);
    }


    public function edit($id)
    {
        $tour = Tour::with(['category', 'user'])->where('id', $id)->first();

        return view('admin::pages.tour.general.edit', [
            'tour' => $tour,
            'title' => $this->title,
            'title_page' => 'Редактирование тура',
        ]);
    }


    public function update(Request $request, $id)
    {
        if ($request->has('delete_event')){
            return $this->destroy($id, false);
        }

        $data = [];
        if ($request->has('active')){
            $data['active'] = '1';
        }else{
            $data['active'] = '0';
        }

        if ($request->has('good')){
            $data['good'] = '1';
        }else{
            $data['good'] = '0';
        }

        $tour = Tour::where('id', $id)->update($data);

        return redirect()->back();
    }


    public function destroy($id, $back = true)
    {
        Tour::where('id', $id)->delete();

        if ($back){
            return redirect()->back();
        }
        return redirect()->route('admin.tour.index');
    }
}
