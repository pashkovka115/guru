<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Models\Landing;
use Modules\Admin\Models\LandingBloks;

class LandingController extends Controller
{
    public function index()
    {
        $landing = LandingBloks::with('parts')->orderBy('sort')->get();

//        return view('pages.landing.index', ['landing' => $landing]);
        return view('admin::pages.landing.index', ['landing' => $landing]);
    }


    public function create()
    {
        return view('admin::create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        return view('admin::show');
    }


    public function edit($id)
    {
        return view('admin::edit');
    }


    public function update(Request $request, $id)
    {
        $landing = [];
        $parts = [];

        foreach ($request->input('landing') as $key => $land){
            $l = [
                'id' => (int)explode('_', $key)[1],
                'title' => $land['title'] ?? '',
                'img' => $land['img'] ?? ''
            ];
            $landing[] = $l;
            if (is_array($land)){
                foreach ($land as $k2 => $v2){
                    if (stripos($k2, 'blockid') === 0 and is_array($v2)){
                        $part = [
                            'id' => (int)explode('_', $k2)[1],
                            'title' => $v2['title'] ?? '',
                            'img' => $v2['img'] ?? '',
                            'content' => $v2['content'] ?? ''
                        ];
                        $parts[] = $part;
                    }
                }
            }

        }

        \DB::transaction(function () use ($landing, $parts){
            foreach ($landing as $land){
                \DB::table('landing_blocks')->where('id', $land['id'])->update([
                    'title' => $land['title'],
                    'img' => $land['img']
                ]);
            }
            foreach ($parts as $part){
                \DB::table('landing')->where('id', $part['id'])->update([
                    'title' => $part['title'],
                    'img' => $part['img'],
                    'content' => $part['content']
                ]);
            }
        });
        session()->flash('message', 'Обновил');

        return redirect()->back();
    }


    public function destroy($id)
    {
        //
    }
}
