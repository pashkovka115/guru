<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Models\About;

class AboutController extends Controller
{
    public function show()
    {
        $titles = About::where('post_type', 'title')->orderBy('sort')->get();
        $contents = About::where('post_type', 'content')->get();
        $team = About::where('post_type', 'people')->get();
        $progress = About::where('post_type', 'progress')->get();

        return view('admin::pages.about_us.show', [
            'titles' => $titles,
            'contents' => $contents,
            'team' => $team,
            'progress' => $progress
        ]);
    }


    public function edit()
    {
        $titles = About::where('post_type', 'title')->orderBy('sort')->get();
        $contents = About::where('post_type', 'content')->get();
        $team = About::where('post_type', 'people')->get();
        $progress = About::where('post_type', 'progress')->get();

        return view('admin::pages.about_us.edit', [
            'titles' => $titles,
            'contents' => $contents,
            'team' => $team,
            'progress' => $progress
        ]);
    }


    public function add_field(Request $request)
    {
        $request->validate([
            'post_type' => ['required', 'regex:/title|content|people|progress/']
        ]);

        About::create([
            'post_type' => $request->input('post_type')
        ]);

        session()->flash('message', 'Поле добавленно');
        return redirect()->back();
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
            About::where('id', $id)->update($fields);
        }

        session()->flash('message', 'Обновил');
        return redirect()->back();
    }


    public function destroy($id)
    {
        About::where('id', $id)->delete();

        session()->flash('message', 'Удалил');
        return redirect()->back();
    }
}
