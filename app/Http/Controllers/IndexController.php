<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function index()
    {
        return view('index.index');
    }

    public function welcome()
    {
        return view('index.welcome');
    }

    public function login()
    {

    }
}
