<?php

namespace Modules\Admin\Http\Controllers\Settings;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Models\Settings;

class SocialNetworkController extends Controller
{
    public function index()
    {
        $settings = Settings::where('post_type', 'url')->paginate();

        return view('admin::pages.soc_network.index', [
            'title' => 'Социальные сети',
            'title_page' => 'Социальные сети',
            'settings' => $settings
        ]);
    }


    public function create()
    {
        return view('admin::pages.soc_network.create');
    }


    public function store(Request $request)
    {
        Settings::create([
            'post_type' => 'url',
            'url' => $request->input('url'),
            'icon' => $request->input('icon'),
        ]);

        session()->flash('message', 'Создано');
        return redirect()->route('admin.settings.soc_network.index');
    }


    /*public function show($id)
    {
        return view('admin::show');
    }*/


    public function edit($id)
    {
        $setting = Settings::where('id', $id)->firstOrFail();

        return view('admin::pages.soc_network.edit', [
            'title' => 'Социальные сети',
            'title_page' => 'Социальные сети',
            'setting' => $setting
        ]);
    }


    public function update(Request $request, $id)
    {
        $setting = Settings::where('id', $id)->firstOrFail();
        $setting->url = $request->input('url');
        $setting->icon = $request->input('icon');
        $setting->save();

        session()->flash('message', 'Обновил');
        return redirect()->back();
    }


    public function destroy($id)
    {
        Settings::where('id', $id)->delete();

        session()->flash('message', 'Удалил');
        return redirect()->back();
    }
}
