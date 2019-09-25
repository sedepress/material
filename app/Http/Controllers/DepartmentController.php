<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Libs\StatusCode;
use App\Models\Department;

class DepartmentController extends BaseController
{
    public function index()
    {
        $deps = Department::with('children.children')->where('parent_id', 0)->get();

        return view('dep.index', compact('deps'));
    }

    public function create(Department $department)
    {
        return view('dep.create', compact('department'));
    }

    public function store(DepartmentRequest $request, Department $department)
    {
        $department->fill($request->all());
        $department->save();

        $msg = '创建成功';
        return $this->responseJson(StatusCode::SUCCESS, $msg);
    }

    public function edit(Department $department)
    {
        return view('dep.edit', compact('department'));
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $department->update($request->all());

        $msg = '修改成功';
        return $this->responseJson(StatusCode::SUCCESS, $msg);
    }

    public function destroy(Department $department)
    {
        $children_count = count($department->children()->get());

        if ($children_count > 0) {
            $msg = '该部门存在子部门，清先删除子部门！';
            return $this->responseJson(StatusCode::BAD_REQUEST, $msg);
        }

        $department->delete();
        $msg = '删除成功';
        return $this->responseJson(StatusCode::SUCCESS, $msg);
    }
}
