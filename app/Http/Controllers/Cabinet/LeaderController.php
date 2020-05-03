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
        } else {
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
            } else {
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
            $user = User::with('profile')->where('id', $id)->first();
            return view('pages.cabinet.leader.edit', ['user' => $user]);
        } else {
            return redirect()->back()->withErrors('Пользователь с таким идентификатором не найден');
        }
    }


    public function update(Request $request, $id)
    {
//        dd($request->all());
        $request->validate([
            "name" => "required|regex:/[\w\s\-]*/i",
            "excerpt" => "sometimes|nullable|regex:/[\w\s\-]*/i",
//            'avatar' => 'dimensions:min_width=100,min_height=200',
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

        $organizer = User::with('leaders')->where('id', auth()->id())->first('id');
        $ids_my_leaders = $organizer->leaders->keyBy('id')->toArray();

        if (isset($ids_my_leaders[$id])) {
            \DB::transaction(function () use ($id, $request) {
                $user = User::with('profile')->where('id', $id)->first();
                $user->name = $request->input('name');
                $user->save();

                if ($user->profile) {
                    $user->profile->excerpt = $request->input('excerpt');
                    $user->profile->description = $request->input('description');
                    $user->profile->url = $request->input('url');

                    $user->profile->country = $request->input('country');
                    $user->profile->city = $request->input('city');
                    $user->profile->address = $request->input('address');
                    $user->profile->street = $request->input('street');
                    $user->profile->house = $request->input('house');
                    $user->profile->region = $request->input('region');
                    $user->profile->latitude = $request->input('latitude');
                    $user->profile->latitude = $request->input('latitude');
                    $user->profile->longitude = $request->input('longitude');

                    if ($request->has('gallery') and $request->file('gallery') !== null){
                        $user->profile->gallery = json_encode(get_url_to_uploaded_files(auth()->user(), $request->file('gallery')));
                    }

                    $user->profile->save();

                } else {
                    // при регистрации нового автора у него нет профиля
                    $data = [
                        'user_id' => $user->id,
                        'raiting' => 0,
                        "excerpt" => $request->input('excerpt'),
                        "description" => $request->input('description'),
                        "url" => $request->input('url'),

                        "country" => $request->input('country'),
                        "city" => $request->input('city'),
                        "address" => $request->input('address'),
                        "street" => $request->input('street'),
                        "house" => $request->input('house'),
                        "region" => $request->input('region'),
                        "latitude" => $request->input('latitude'),
                        "longitude" => $request->input('longitude'),
                    ];
                    if ($request->has('gallery') and $request->file('gallery') !== null){
                        $data['gallery'] = json_encode(get_url_to_uploaded_files(auth()->user(), $request->file('gallery')));
                    }
                    Profile::create($data);
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
