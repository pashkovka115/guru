<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Admin\Models\OrganizerLeader;

class LeaderController extends Controller
{
    /*
     * для любого поля
     * удалить ссылку на файл
     */
    public function ajax_gallery_remove(Request $request)
    {
        if ($request->has('field-src') and $request->has('field-name')) {
            $field = $request->input('field-name');
            $sp = explode('_', $field);
            $field_name = str_replace('-', '_', $sp[0]);
            $bd_gallery = Profile::where('id', (int)$sp[1])->firstOrFail(['id', $field_name]);
            $gall_ar = (array)json_decode($bd_gallery->$field_name);


            foreach ($gall_ar as $key => $value) {
                if ($value == json_decode(json_encode($request->input('field-src')))) {
                    unset($gall_ar[$key]);
                }
            }

            $bd_gallery->$field_name = json_encode($gall_ar);
            $bd_gallery->save();

            return [
                'answer' => 'ok',
            ];
        }
        return ['answer' => 'error'];
    }


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
        $request->validate([
            "name" => "required|regex:/[\w\s\-]*/i",
            "email" => "required|email|unique:users",
        ]);
        $new_dir = get_image_path_to_profile($request->all());
        if (!is_dir($new_dir)) {
            mkdir($new_dir, 0755, true);
        }

        \DB::transaction(function () use ($request) {
            $user = User::with('profile')->create([
                "name" => $request->input('name'),
                "email" => $request->input('email'),
            ]);

            $profile = new Profile([
                'user_id' => $user->id,
                'description' => $request->input('description'),
                'address' => $request->input('address'),
                'street' => $request->input('street'),
                'house' => $request->input('house'),
                'region' => $request->input('region'),
                'city' => $request->input('city'),
                'country' => $request->input('country'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'url' => $request->input('url'),
            ]);
            $profile->save();

            $profile = Profile::where('id', $profile->id)->firstOrFail();

            if ($request->has('avatar')){
                $profile->avatar = json_encode(get_url_to_uploaded_files($user, $request->file('avatar')));
            }

            if ($request->has('gallery')){
                $profile->gallery = json_encode(get_url_to_uploaded_files($user, $request->file('gallery')));
            }
            $profile->save();

            OrganizerLeader::create([
                'organizer_id' => auth()->id(),
                'leader_id' => $user->id
            ]);
            session(['created_author_id' => $user->id]);

//            dd('====================');
        });

        session()->flash('message', 'Сохранил');
        return redirect()->route('site.cabinet.leaders.edit', ['leader' => session()->get('created_author_id')]);
    }


    public function edit($id)
    {
        $organizer = User::with('leaders')->where('id', auth()->id())->firstOrFail('id');
        $ids_my_leaders = $organizer->leaders->keyBy('id')->toArray();
        if (isset($ids_my_leaders[$id])) {
            $user = User::with('profile')->where('id', $id)->firstOrFail();
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

                    if ($request->has('avatar')){
                        $user->profile->avatar =  '["'.get_url_to_uploaded_files(auth()->user(), $request->file('avatar'))[0] . '"]';
                    }

                    if ($request->has('gallery') and $request->file('gallery') !== null) {
                        $old_gallery = (array)json_decode($user->profile->gallery);
                        $new_img = (array)get_url_to_uploaded_files(auth()->user(), $request->file('gallery'));
                        $new_gall = array_merge($old_gallery, $new_img);
                        $user->profile->gallery = json_encode($new_gall,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
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
                        'avatar' => get_url_to_uploaded_files(auth()->user(), $request->file('avatar')),
                        "country" => $request->input('country'),
                        "city" => $request->input('city'),
                        "address" => $request->input('address'),
                        "street" => $request->input('street'),
                        "house" => $request->input('house'),
                        "region" => $request->input('region'),
                        "latitude" => $request->input('latitude'),
                        "longitude" => $request->input('longitude'),
                    ];
                    if ($request->has('gallery') and $request->file('gallery') !== null) {
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
