<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Libs\StatusCode;
use App\Models\Department;
use App\Models\User;
use App\Search\UserSearch\UserSearch;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function index(Request $request)
    {
        $users = UserSearch::apply($request)->paginate(10);
        $users->appends(['name' => $request->get('name'), 'department' => $request->get('department')]);
        $departments = Department::select('id', 'name')->get();

        return view('user.index', compact('users', 'departments'));
    }

    public function create(User $user)
    {
        $departments = Department::select('id', 'name')->get();

        return view('user.create_and_edit', compact('user', 'departments'));
    }

    public function store(UserRequest $request, User $user)
    {
        $user->fill($request->all());
        $user->save();

        $msg = '创建成功';
        return $this->responseJson(StatusCode::SUCCESS, $msg);
    }

    public function edit(User $user)
    {
        $departments = Department::select('id', 'name')->get();

        return view('user.create_and_edit', compact('user', 'departments'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());

        $msg = '更新成功';
        return $this->responseJson(StatusCode::SUCCESS, $msg);
    }

    public function destroy(User $user)
    {
        $user->delete();

        $msg = '删除成功';
        return $this->responseJson(StatusCode::SUCCESS, $msg);
    }

    public function exchangeStatus(User $user)
    {
        $user->status = !$user->status;
        $user->save();

        $msg = '操作成功';
        return $this->responseJson(StatusCode::SUCCESS, $msg);
    }
}
