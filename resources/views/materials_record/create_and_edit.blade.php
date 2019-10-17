@extends('layouts.app')
@section('content')
    <div class="layui-fluid">
        <div class="layui-row">
            @if($materialsReceivingRecord->id)
                <form class="layui-form" method="POST"
                      action="{{ route('materials_record.update', $materialsReceivingRecord->id) }}"
                      accept-charset="UTF-8">
                    @method('PUT')
                    @else
                        <form class="layui-form" method="POST" action="{{ route('materials_record.store') }}">
                            @endif
                            @csrf
                            <div class="layui-inline">
                                <label class="layui-form-label"><span class="x-red">*</span>领取人员</label>
                                <div class="layui-input-inline">
                                    <select name="user_id" lay-verify="required" lay-search="">
                                        <option value="">直接选择或搜索选择</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}"
                                                    @if($materialsReceivingRecord->user_id == $user->id) selected="selected" @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label"><span class="x-red">*</span>领取物品</label>
                                <div class="layui-input-inline">
                                    <select name="material_id" lay-verify="required" lay-search="">
                                        <option value="">直接选择或搜索选择</option>
                                        @foreach($materials as $material)
                                            <option value="{{ $material->id }}"
                                                    @if($materialsReceivingRecord->material_id == $material->id) selected="selected" @endif>{{ $material->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label for="name" class="layui-form-label">
                                    <span class="x-red">*</span>领取数量
                                </label>
                                <div class="layui-input-inline">
                                    <input type="text" name="amount" required="" lay-verify="required"
                                           autocomplete="off" class="layui-input"
                                           value="{{ old('amount', $materialsReceivingRecord->amount) }}">
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
                            @if($materialsReceivingRecord->id)
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
                                console.log(res)
                                var parse = $.parseJSON(res.responseText)
                                layer.msg(parse.msg, {shift: 6});
                            }
                        })

                        return false;
                    });
            });
    </script>
@endsection
