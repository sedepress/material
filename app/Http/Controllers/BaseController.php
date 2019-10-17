<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Material;
use App\User;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function responseJson($code, $msg)
    {
        return response()->json(['code' => $code, 'msg' => $msg]);
    }

    protected function departments()
    {
        $departments = Department::where('level', 0)->get();
        return $departments;
    }

    protected function users()
    {
        $users = User::where('status', true)->get();
        return $users;
    }

    protected function materials()
    {
        $materials = Material::where('status', true)->get();
        return $materials;
    }
}
