<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
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
            "name" => 'required|regex:/[\w\s\-]*/i',
            "country" => "required|regex:/[\w\s\-]*/i",
            "city" => "required|regex:/[\w\s\-]*/i",
            "excerpt" => "sometimes|nullable|regex:/[\w\s\-]*/i",
            "description" => 'sometimes|nullable|regex:/[\w\s\-]*/i',
        ]);

        $user = User::with('profile')->where('id', auth()->id())->first();
        $user->name = $request->input('name');
        $user->save();

        $user->profile->country = $request->input('country');
        $user->profile->city = $request->input('city');
        $user->profile->excerpt = $request->input('excerpt');
        $user->profile->description = $request->input('description');
        $user->profile->save();

        session()->flash('message', 'Обновил');
        return redirect()->back();
    }
}























