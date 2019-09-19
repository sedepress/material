<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Libs\StatusCode;

class AdminController extends BaseController
{
    public function index(Admin $admin)
    {
        $admins = Admin::paginate(10);

        return view('admin.index', compact('admins'));
    }

    public function create(Admin $admin)
    {
        return view('admin.create_and_edit', compact('admin'));
    }

    public function store(AdminRequest $request, Admin $admin)
    {
        $admin->fill($request->all());
        $admin->save();

        $msg = '创建成功';
        return $this->responseJson(StatusCode::SUCCESS, $msg);
    }

    public function edit(Admin $admin)
    {
        return view('admin.create_and_edit', compact('admin'));
    }

    public function update(AdminRequest $request, Admin $admin)
    {
        $admin->update($request->all());

        $msg = '修改成功';
        return $this->responseJson(StatusCode::SUCCESS, $msg);
    }
}
