<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Admin\Models\OrganizerLeader;

class LeaderController extends Controller
{
    public function index()
    {
        $user = User::with('leaders')->where('id', auth()->id())->firstOrFail();
        return view('pages.cabinet.leader.index', ['user' => $user]);
    }


    public function create()
    {
        return view('pages.cabinet.leader.create');
    }


    public function store(Request $request)
    {
        if ($request->input('email') != auth()->user()->email) {
            $request->validate([
                "name" => "required|regex:/[\w\s\-]*/i",
                "email" => "required|email|unique:users",
                "password" => "confirmed|min:8",
            ]);
        }else{
            $request->validate([
                "email" => "required|email",
            ]);
        }

        \DB::transaction(function () use ($request) {
            if ($request->input('email') != auth()->user()->email) {
                $user = User::create([
                    "name" => $request->input('name'),
                    "email" => $request->input('email'),
                    "password" => bcrypt($request->input('password'))
                ]);
                $leader_id = $user->id;
            }else{
                $leader_id = auth()->id();
            }

            OrganizerLeader::create([
                'organizer_id' => auth()->id(),
                'leader_id' => $leader_id
            ]);
        });

        session()->flash('message', 'Сохранил');
        return redirect()->back();
    }


    public function edit($id)
    {
        $organizer = User::with('leaders')->where('id', auth()->id())->first('id');
        $ids_my_leaders = $organizer->leaders->keyBy('id')->toArray();
        if (isset($ids_my_leaders[$id])) {
            $user = User::where('id', $id)->first();
            return view('pages.cabinet.leader.edit', ['user' => $user]);
        } else {
            return redirect()->back()->withErrors('Пользователь с таким идентификатором не найден');
        }
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required|regex:/[\w\s\-]*/i",
            "country" => "required|regex:/[\w\s\-]*/i",
            "city" => "required|regex:/[\w\s\-]*/i",
            "excerpt" => "sometimes|nullable|regex:/[\w\s\-]*/i",
            "description" => "sometimes|nullable|regex:/[\w\s\-]*/i"
        ]);

        $organizer = User::with('leaders')->where('id', auth()->id())->first('id');
        $ids_my_leaders = $organizer->leaders->keyBy('id')->toArray();

        if (isset($ids_my_leaders[$id])) {
            \DB::transaction(function () {
                $user = User::with('profile')->where('id', $id)->first();
                $user->name = $request->input('name');
                $user->save();

                if ($user->profile) {
                    $user->profile->country = $request->input('country');
                    $user->profile->city = $request->input('city');
                    $user->profile->excerpt = $request->input('excerpt');
                    $user->profile->description = $request->input('description');
                    $user->profile->save();
                } else {
                    Profile::create([
                        'user_id' => $user->id,
                        'raiting' => 0,
                        "country" => $request->input('country'),
                        "city" => $request->input('city'),
                        "excerpt" => $request->input('excerpt'),
                        "description" => $request->input('description')
                    ]);
                }
            });

            session()->flash('masage', 'Обновил');
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors('Пользователь с таким идентификатором не найден');
        }
    }

    /**
     * открепляем ведущего от организатора, но пользователь остаётся в базе
     */
    public function destroy($id)
    {
        \DB::table('organizer_leader')
            ->whereRaw('organizer_id = ? and leader_id = ?', [auth()->id(), $id])
            ->delete();

        session()->flash('message', 'Удалено');
        return redirect()->back();
    }
}
