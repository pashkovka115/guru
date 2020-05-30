<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Models\Permissions;
use Modules\Admin\Models\Role;

class RoleController extends Controller
{
    public $title = 'Роли';

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $roles = Role::paginate();
        return view('admin::pages.role.index', ['roles' => $roles, 'title' => $this->title, 'title_page' => 'Список ролей']);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $permissions = Permissions::all();
        return view('admin::pages.role.create', ['title' => $this->title, 'title_page' => 'Новая роль', 'permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'regex:/[\d\w\_\-\.\sа-я]+/i',
        ]);

        $has_role = Role::where('name', '=', $request->input('name'))->firstOrFail();
        if ($has_role) {
            return redirect()->back()->withErrors('Роль с таким именем уже существует');
        }

        $role = Role::Create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'guard_name' => 'web'
        ]);
        if ($role) {
            $permissions = [];

            foreach ($request->all() as $key => $value) {
                if (mb_stripos($key, 'permission_') === 0) {
                    $permissions[] = $value;
                }
            }
            if (count($permissions) > 0) {
                $role->givePermissionTo($permissions);
            }
        }
        session()->flash('message', 'Сохранено');
        return redirect()->back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $role = Role::where('id', $id)->firstOrFail();
        return view('admin::pages.role.show', ['role' => $role, 'title' => $this->title, 'title_page' => 'Просмотр роли']);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $role = Role::with('permissions')->where('id', $id)->firstOrFail();
        $all_perms = Permissions::all();
        return view('admin::pages.role.edit', ['role' => $role, 'all_perms' => $all_perms, 'title' => $this->title, 'title_page' => 'Редактирование роли']);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::where('id', $id)->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        if ($role) {
            $permissions = [];

            foreach ($request->all() as $key => $value) {
                if (mb_stripos($key, 'permission_') === 0) {
                    $permissions[] = $value;
                }
            }
            if (count($permissions) > 0) {
                $role = Role::where('id', $id)->firstOrFail();
                $role->syncPermissions($permissions);
            }
        }

        session()->flash('message', 'Сохранено');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $role = Role::where('id', $id)->firstOrFail();
        if ($role->name == 'super_admin') {
            return redirect()->back()->withErrors('Эту роль удалить не возможно!');
        } else {
            $role->delete();
        }
        session()->flash('message', 'Удалено');

        return redirect()->back();
    }
}
