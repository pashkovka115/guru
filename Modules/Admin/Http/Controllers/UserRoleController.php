<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Models\Role;

class UserRoleController extends Controller
{
    public $title = 'Роли пользователей';

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $users = User::with('roles')->paginate();
        $roles = Role::all();
        return view('admin::pages.user_role.index', ['users' => $users, 'roles' => $roles, 'title' => $this->title, 'title_page' => 'Все роли пользователей']);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::with('roles')->where('id', $id)->firstOrFail();
        return view('admin::pages.user_role.show', ['user' => $user, 'title' => $this->title, 'title_page' => 'Просмотр ролей пользователя']);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::with('roles')->where('id', $id)->firstOrFail();
        $roles = Role::all();
        return view('admin::pages.user_role.edit', ['user' => $user, 'roles' => $roles, 'title' => $this->title, 'title_page' => 'Редактирование ролей пользователя']);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id User->id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->firstOrFail();

        if ($user) {
            $roles = [];

            foreach ($request->all() as $key => $value) {
                if (mb_stripos($key, 'role_') === 0) {
                    $roles[] = $value;
                }
            }
            $user->syncRoles($roles);
        }
        session()->flash('message', 'Сохранено');
        return redirect()->back();
    }
}
