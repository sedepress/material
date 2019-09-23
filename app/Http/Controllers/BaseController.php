<?php

namespace App\Http\Controllers;

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
}
