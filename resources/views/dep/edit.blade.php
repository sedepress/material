@extends('layouts.app')
@section('content')
    <div class="layui-fluid">
        <div class="layui-row">
            <form class="layui-form" method="POST" action="{{ route('dep.update', $department->id) }}">
                @method('PUT')
                @csrf
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>部门名称
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="name" required="" lay-verify="required"
                               autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>不可重复
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <button class="layui-btn" lay-filter="add" lay-submit="">
                        确定
                    </button>
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
                form.on('submit(add)',
                    function (data) {
                        var action = data.form.action;

                        $.ajax({
                            type: 'put',
                            url: action,
                            data: data.field,
                            success: function (res) {
                                if (res.code == 200) {
                                    layer.alert(res.msg, {
                                            icon: 6
                                        },
                                        function () {
                                            //关闭当前frame
                                            xadmin.close();

                                            // 可以对父窗口进行刷新
                                            xadmin.father_reload();
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
