<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Models\Landing;
use Modules\Admin\Models\LandingBloks;

class LandingController extends Controller
{
    public function show()
    {
        $titles = Landing::where('post_type', 'title')->orderBy('sort')->get();
        $headers = Landing::where('post_type', 'header')->orderBy('sort')->get();
        $posts = Landing::where('post_type', 'post')->orderBy('sort')->get();
        $decoratives = Landing::where('post_type', 'decorative')->orderBy('sort')->get();
        $progresies = Landing::where('post_type', 'progress')->orderBy('sort')->get();
        $contents = Landing::where('post_type', 'content')->orderBy('sort')->get();

        return view('admin::pages.landing.show', [
            'titles' => $titles,
            'headers' => $headers,
            'posts' => $posts,
            'decoratives' => $decoratives,
            'progresies' => $progresies,
            'contents' => $contents,
        ]);
    }

    public function add_field(Request $request)
    {
        $request->validate([
            'post_type' => ['required', 'regex:/header|post|decorative|progress|content/']
        ]);

        Landing::create([
            'post_type' => $request->input('post_type')
        ]);

        session()->flash('message', 'Поле добавленно');
        return redirect()->back();
    }


    public function edit()
    {
        $headers = Landing::where('post_type', 'header')->orderBy('sort')->get();
        $posts = Landing::where('post_type', 'post')->orderBy('sort')->get();
        $decoratives = Landing::where('post_type', 'decorative')->orderBy('sort')->get();
        $progresies = Landing::where('post_type', 'progress')->orderBy('sort')->get();
        $contents = Landing::where('post_type', 'content')->orderBy('sort')->get();

        return view('admin::pages.landing.edit', [
            'headers' => $headers,
            'posts' => $posts,
            'decoratives' => $decoratives,
            'progresies' => $progresies,
            'contents' => $contents,
        ]);
    }


    public function update(Request $request)
    {
        $request_fields = $request->except('_token');

        $new_fields = [];
        foreach ($request_fields as $request_field => $v){
            if (stripos($request_field, '_') !== false){
                $sp = explode('_', $request_field);
                $field_name = str_replace('-', '_', $sp[0]);
                $row_id = (int)$sp[1];

                $new_fields[$row_id][$field_name] = $v;
            }
        }

        foreach ($new_fields as $id => $fields){
            Landing::where('id', $id)->update($fields);
        }

        session()->flash('message', 'Обновил');
        return redirect()->back();
    }


    public function destroy($id)
    {
        Landing::where('id', $id)->delete();

        session()->flash('message', 'Удалил');
        return redirect()->back();
    }
}
