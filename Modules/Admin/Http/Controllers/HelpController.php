<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Models\Settings;

class HelpController extends Controller
{
    public function index()
    {
        return view('admin::index');
    }


    public function create()
    {
        return view('admin::create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show()
    {
        $settings = Settings::where('post_type', 'help')->get();

        return view('admin::pages.help.show', [
            'settings' => $settings,
            'title_page' => 'Помощь и поддержка'
        ]);
    }


    public function edit()
    {
        $settings = Settings::where('post_type', 'help')->get();

        return view('admin::pages.help.edit', [
            'settings' => $settings,
            'title_page' => 'Помощь и поддержка'
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
            Settings::where('id', $id)->update($fields);
        }

        session()->flash('message', 'Обновил');
        return redirect()->back();
    }

    public function add_field(Request $request)
    {
        $request->validate([
            'post_type' => ['required', 'regex:/help/']
        ]);

        Settings::create([
            'post_type' => $request->input('post_type')
        ]);

        session()->flash('message', 'Поле добавленно');
        return redirect()->back();
    }


    public function destroy($id)
    {
        //
    }
}
