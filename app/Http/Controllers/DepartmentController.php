<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Libs\StatusCode;
use App\Models\Department;

class DepartmentController extends BaseController
{
    public function index()
    {
        return view('dep.index');
    }

    public function store(DepartmentRequest $request, Department $department)
    {
        $department->fill($request->all());
        $department->save();

        $msg = '创建成功';
        return $this->responseJson(StatusCode::SUCCESS, $msg);
    }
}
