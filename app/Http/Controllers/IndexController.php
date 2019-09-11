<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends BaseController
{
    function index()
    {
        return view('index.index');
    }

    function welcome()
    {
        return view('index.welcome');
    }
}
