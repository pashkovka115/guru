<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Models\Home;

class HomeController extends Controller
{
    public function show()
    {
        $titles = Home::where('post_type', 'title')->get();
        $contents = Home::where('post_type', 'content')->get();
        $progresies = Home::where('post_type', 'progress')->get();

        return view('admin::pages.home.show', [
            'title' => 'Редактируем главную',
            'title_page' => 'Редактируем главную',
            'titles' => $titles,
            'contents' => $contents,
            'progresies' => $progresies
        ]);
    }


    public function edit()
    {
        $titles = Home::where('post_type', 'title')->get();
        $contents = Home::where('post_type', 'content')->get();
        $progresies = Home::where('post_type', 'progress')->get();

        return view('admin::pages.home.edit', [
            'title' => 'Редактируем главную',
            'title_page' => 'Редактируем главную',
            'titles' => $titles,
            'contents' => $contents,
            'progresies' => $progresies
        ]);
    }


    public function update(Request $request)
    {
        $request_fields = $request->except('_token');

        $new_fields = [];
        foreach ($request_fields as $request_field => $v){
            if (stripos($request_field, '_') !== false){
                $sp = explode('_', $request_field);
                $field_name = $sp[0];
                $row_id = (int)$sp[1];

                $new_fields[$row_id][$field_name] = $v;
            }
        }

        foreach ($new_fields as $id => $fields){
            Home::where('id', $id)->update($fields);
        }

        session()->flash('message', 'Обновил');
        return redirect()->back();
    }


    public function destroy($id)
    {
        Home::where('id', $id)->delete();

        session()->flash('message', 'Удалил');
        return redirect()->back();
    }

    public function add_field(Request $request)
    {
        $request->validate([
            'post_type' => ['required', 'regex:/title|content|people|progress/']
        ]);

        Home::create([
            'post_type' => $request->input('post_type')
        ]);

        session()->flash('message', 'Поле добавленно');
        return redirect()->back();
    }
}
