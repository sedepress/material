<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(AdminRequest $request)
    {
        dump($request->all());
    }
}
