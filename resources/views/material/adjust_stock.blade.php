@extends('layouts.app')
@section('content')
    <div class="layui-fluid">
        <div class="layui-row">
            <form class="layui-form" method="POST" action="{{ route('material.adjust', $material->id) }}"
                  accept-charset="UTF-8">
                @method('PATCH')
                @csrf
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        物品名称
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="name" required="" disabled=""
                               autocomplete="off" class="layui-input"
                               value="{{ old('name', $material->name) }}" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span class="x-red">*</span>增减</label>
                    <div class="layui-input-block">
                        <input type="radio" name="adjust_status" value="inc" title="增加" checked="">
                        <input type="radio" name="adjust_status" value="dec" title="减少">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>数量
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" name="amount" required="" lay-verify="required"
                               autocomplete="off" class="layui-input"
                               value="">
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
@endsection
@section('scriptsAfterJs')
    <script>
        layui.use(['form', 'layer'],
            function () {
                $ = layui.jquery;
                var form = layui.form,
                    layer = layui.layer;

                //监听提交
                form.on('submit(add)',
                    function (data) {
                        // console.log(data)
                        //发异步，把数据提交给php
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
