<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Models\Permissions;

class PermissionController extends Controller
{
    public $title = 'Разрешения';

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $permissions = Permissions::paginate();
        return view('admin::pages.permission.index', ['permissions' => $permissions, 'title' => $this->title, 'title_page' => 'Список разрешений']);
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $permission = Permissions::where('id', $id)->firstOrFail();
        return view('admin::pages.permission.show', ['permission' => $permission, 'title' => $this->title, 'title_page' => 'Просмотр разрешения']);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $permission = Permissions::where('id', $id)->firstOrFail();
        return view('admin::pages.permission.edit', ['permission' => $permission, 'title' => $this->title, 'title_page' => 'Редактирование разрешения']);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $desc = $request->input('description');
        Permissions::where('id', $id)->update(['description' => $desc]);
        return redirect()->back();
    }

}
