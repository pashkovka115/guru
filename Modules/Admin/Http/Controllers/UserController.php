<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $title = 'Пользователи';


    public function index()
    {
        $users = User::with('profile')->orderByDesc('id')->paginate();
        return view('admin::pages.user.index', ['users' => $users, 'title' => $this->title, 'title_page' => 'Список пользователей']);
    }


    public function create()
    {
        return view('admin::pages.user.create', ['title' => $this->title, 'title_page' => 'Новый пользователь']);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        mkdir(get_image_path_to_profile($request->all()), 0755, true);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        session()->flash('message', 'Сохранил');
        return redirect()->route('admin.user.edit', ['user' => $user->id]);
    }


    public function show($id)
    {
        $user = User::where('id', $id)->firstOrFail();

        return view('admin::pages.user.show', ['title' => $this->title, 'title_page' => 'Просмотр пользователя', 'user' => $user]);
    }


    public function edit($id)
    {
        $user = User::with('profile')->where('id', $id)->firstOrFail();
        if (!$user)
            return redirect()->route('admin.user.index');

        return view('admin::pages.user.edit', ['title' => $this->title, 'title_page' => 'Редактирование пользователя', 'user' => $user]);
    }


    public function update(Request $request, $id)
    { // TODO сделать переименование директории юзера (storage/app/public/users/user)
        $request->validate([
            'name' => 'required',
//            'email' => 'required|email',
        ]);
        $data = [
            'name' => $request->input('name'),
//            'email' => $request->input('email'),
        ];

        $arr = $request->toArray();
        if (!empty($arr['password']) and $arr['password'] == $arr['password_confirmation']) {
            $data['password'] = Hash::make($arr['password']);
        }

        \DB::transaction(function () use ($id, $data, $request){
            User::where('id', $id)->update($data);

            $profile = Profile::where('user_id', $id)->firstOrFail();
            if ($request->has('auth')) {
                $profile->auth = '1';
                $profile->request = '0';

            }else{
                $profile->auth = '0';
                $profile->request = '0';
            }
            $profile->save();
        });


        session()->flash('message', 'Сохранил');
        return redirect()->back();
    }


    public function destroy($id)
    {
        $user = User::with('profile')->where('id', $id)->firstOrFail();
        if ($user->profile) {
            $user->profile->delete();
        }
        delDir(get_image_path_to_profile($user));
        $user->delete();

        session()->flash('message', 'Удалил');
        return redirect()->route('admin.user.index');
    }
}
