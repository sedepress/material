@extends('layouts.app')
@section('content')
    <div class="layui-fluid">
        <div class="layui-row">
            <form class="layui-form" method="POST" action="{{ route('change_pwd', $admin->id) }}">
                @csrf
                @method('PATCH')
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                        <span class="x-red">*</span>旧密码</label>
                    <div class="layui-input-inline">
                        <input type="password" id="L_repass" name="oldpass" required="" lay-verify="required"
                               autocomplete="off" class="layui-input"></div>
                </div>
                <div class="layui-form-item">
                    <label for="L_pass" class="layui-form-label">
                        <span class="x-red">*</span>新密码</label>
                    <div class="layui-input-inline">
                        <input type="password" id="L_pass" name="newpass" required="" lay-verify="required"
                               autocomplete="off" class="layui-input"></div>
                    <div class="layui-form-mid layui-word-aux">6到20个字符</div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                        <span class="x-red">*</span>确认密码</label>
                    <div class="layui-input-inline">
                        <input type="password" id="L_repass" name="repass" required="" lay-verify="required"
                               autocomplete="off" class="layui-input"></div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label"></label>
                    <button class="layui-btn" lay-filter="save" lay-submit="">确定</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        layui.use(['form', 'layer'],
            function () {
                $ = layui.jquery;
                var form = layui.form,
                    layer = layui.layer;

                //监听提交
                form.on('submit(save)',
                    function (data) {
                        var action = data.form.action;

                        $.ajax({
                            type: 'patch',
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
                                    layer.msg(res.msg, {shift: 6});
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
