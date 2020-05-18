<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Admin\Models\Tour;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count_tour = Tour::where('user_id', auth()->id())->count();
        return view('pages.cabinet.home.index', ['count_tour' => $count_tour]);
    }

    public function edit($id)
    {
        $user = User::with('profile')->where('id', auth()->id())->firstOrFail();
        return view('pages.cabinet.home.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required|regex:/[\w\s\-]*/i",
            "excerpt" => "sometimes|nullable|regex:/[\w\s\-]*/i",
            'avatar' => 'dimensions:min_width=50,min_height=50|mimes:jpeg,jpg,png',
            "gallery" => "sometimes|nullable|array",
            "gallery.*" => "sometimes|nullable|mimes:jpeg,jpg,png",
            "description" => "sometimes|nullable|regex:/[\w\s\-]*/i",
            "url" => "sometimes|nullable|regex:/[\w\s\-]*/i",

            "address" => "sometimes|nullable|regex:/[\w\s\-]*/i",
            "street" => "sometimes|nullable|regex:/[\w\s\-]*/i",
            "house" => "sometimes|nullable|regex:/[\w\s\-]*/i",
            "region" => "sometimes|nullable|regex:/[\w\s\-]*/i",
            "city" => "sometimes|nullable|regex:/[\w\s\-]*/i",
            "country" => "sometimes|nullable|regex:/[\w\s\-]*/i",
            "latitude" => "sometimes|nullable|regex:/[\w\s\-]*/i",
            "longitude" => "sometimes|nullable|regex:/[\w\s\-]*/i",
        ]);

        \DB::transaction(function () use ($id, $request) {
            $user = User::with('profile')->where('id', auth()->id())->first();
            $user->name = $request->input('name');
            $user->save();

            if ($user->profile) {
                $user->profile->excerpt = $request->input('excerpt');
                $user->profile->description = $request->input('description');
                $user->profile->url = $request->input('url');
                $user->profile->avatar = get_url_to_uploaded_files(auth()->user(), $request->file('avatar'));
                $user->profile->country = $request->input('country');
                $user->profile->city = $request->input('city');
                $user->profile->address = $request->input('address');
                $user->profile->street = $request->input('street');
                $user->profile->house = $request->input('house');
                $user->profile->region = $request->input('region');
                $user->profile->latitude = $request->input('latitude');
                $user->profile->latitude = $request->input('latitude');
                $user->profile->longitude = $request->input('longitude');

                if ($request->has('gallery') and $request->file('gallery') !== null) {
                    $user->profile->gallery = json_encode(get_url_to_uploaded_files(auth()->user(), $request->file('gallery')));
                }
                $user->profile->save();
            }else{
                Profile::create(['user_id' => auth()->id()]);
            }
        });

        session()->flash('message', 'Обновил');
        return redirect()->back();
    }
}























