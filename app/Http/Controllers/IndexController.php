<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Material;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function index()
    {
        return view('index.index');
    }

    public function welcome()
    {
        $user_sum = User::where('status', true)->count();
        $department_sum = Department::where('status', true)->count();

        $materials = Material::where('status', true)->get()->toArray();
        $materials_detail = [
            'material_sum' => count($materials),
            'receiving_sum' => array_sum(array_column($materials, 'receive_count')),
            'stock_sum' => array_sum(array_column($materials, 'stock')),
        ];

        return view('index.welcome', compact('user_sum', 'department_sum', 'materials_detail'));
    }
}
