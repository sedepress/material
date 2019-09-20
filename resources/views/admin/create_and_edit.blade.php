@extends('layouts.app')
@section('content')
    <div class="layui-fluid">
        <div class="layui-row">
            @if($admin->id)
                <form class="layui-form" method="POST" action="{{ route('admin.update', $admin->id) }}" accept-charset="UTF-8">
                @method('PUT')
            @else
                <form class="layui-form" method="POST" action="{{ route('admin.store') }}">
            @endif
                @csrf
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>登录名
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="username" name="username" required="" lay-verify="required"
                               autocomplete="off" class="layui-input" value="{{ old('username', $admin->username) }}">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>将会成为您唯一的登入名
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="phone" class="layui-form-label">
                        <span class="x-red">*</span>昵称
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="nickname" name="nickname" required="" lay-verify="required"
                               autocomplete="off" class="layui-input" value="{{ old('nickname', $admin->nickname) }}">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>
                    </div>
                </div>
                @if(!$admin->id)
                <div class="layui-form-item">
                    <label for="L_pass" class="layui-form-label">
                        <span class="x-red">*</span>密码
                    </label>
                    <div class="layui-input-inline">
                        <input type="password" id="password" name="password" required="" lay-verify="pass" value="{{ old('password', $admin->password) }}"
                               autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        6到16个字符
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                        <span class="x-red">*</span>确认密码
                    </label>
                    <div class="layui-input-inline">
                        <input type="password" id="L_repass" name="repass" required="" lay-verify="repass" value="{{ old('password', $admin->password) }}"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
                @endif
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <button class="layui-btn" lay-filter="add" lay-submit="">
                        增加
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scriptsAfterJs')
    @include('layouts.error')
    <script>layui.use(['form', 'layer'],
            function () {
                $ = layui.jquery;
                var form = layui.form,
                    layer = layui.layer;

                //自定义验证规则
                form.verify({
                    password: [/(.+){6,12}$/, '密码必须6到12位'],
                    repass: function (value) {
                        if ($('#password').val() != $('#L_repass').val()) {
                            return '两次密码不一致';
                        }
                    }
                });

                //监听提交
                form.on('submit(add)',
                    function (data) {
                        // console.log(data)
                        //发异步，把数据提交给php
                        var action = data.form.action;

                        $.ajax({
                            @if($admin->id)
                            type: 'put',
                            @else
                            type: 'post',
                            @endif
                            url: action,
                            data: data.field,
                            success: function (res) {
                                if (res.code == 200) {
                                    layer.alert(res.msg, {
                                            icon: 6
                                        },
                                        function () {
                                            // 获得frame索引
                                            var index = parent.layer.getFrameIndex(window.name);
                                            //刷新数据表格
                                            parent.location.reload();
                                            //关闭当前frame
                                            parent.layer.close(index);
                                        });
                                } else {
                                    console.log(res)
                                    layer.alert(res.msg, {
                                            icon: 5
                                        },
                                        function () {
                                            var index = parent.layer.getFrameIndex(window.name);
                                            //关闭当前frame
                                            parent.layer.close(index);
                                        });
                                }
                            },
                            error: function (res) {
                                var parse = $.parseJSON(res.responseText)
                                var key = Object.keys(parse.errors)[0];
                                layer.msg(parse.errors[key][0], {shift: 6});
                            }
                        })

                        return false;
                    });
            });
    </script>
@endsection
