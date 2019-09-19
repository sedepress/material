<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected function responseJson($code, $msg)
    {
        return response()->json(['code' => $code, 'msg' => $msg]);
    }
}
