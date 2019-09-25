@extends('layouts.app')
@section('content')
    <div class="x-nav">
            <span class="layui-breadcrumb">
                <a href="">首页</a>
                <a href="">演示</a>
                <a>
                    <cite>导航元素</cite></a>
            </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
           onclick="location.reload()" title="刷新">
            <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i>
        </a>
    </div>
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body ">
                        <form class="layui-form layui-col-space5" method="POST" action="{{ route('dep.store') }}">
                            @csrf
                            <div class="layui-input-inline layui-show-xs-block">
                                <input class="layui-input" placeholder="一级部门名称" name="name"></div>
                            <input type="hidden" name="parent_id" value="0">
                            <input type="hidden" name="level" value="0">
                            <div class="layui-input-inline layui-show-xs-block">
                                <button class="layui-btn" lay-submit="" lay-filter="add"><i class="layui-icon"></i>增加
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="layui-card-header">
                        <button class="layui-btn layui-btn-danger" onclick="delAll()">
                            <i class="layui-icon"></i>批量删除
                        </button>
                    </div>
                    <div class="layui-card-body ">
                        <table class="layui-table layui-form">
                            <thead>
                            <tr>
                                <th width="20">
                                    <input type="checkbox" name="" lay-skin="primary">
                                </th>
                                <th width="70">ID</th>
                                <th>组织架构名称</th>
                                <th width="80">状态</th>
                                <th width="250">操作</th>
                            </thead>
                            <tbody class="x-cate">
                            @foreach($deps as $dep)
                                <tr cate-id='{{ $dep->id }}' fid='0'>
                                    <td>
                                        <input type="checkbox" name="" lay-skin="primary">
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <i class="layui-icon x-show" status='true'>&#xe623;</i>
                                        {{ $dep->name }}
                                    </td>
                                    <td>
                                        <input type="checkbox" name="switch" lay-text="开启|停用" checked=""
                                               lay-skin="switch">
                                    </td>
                                    <td class="td-manage">
                                        <button class="layui-btn layui-btn layui-btn-xs"
                                                onclick="xadmin.open('编辑','{{ route('dep.edit', $dep->id) }}', 500, 200)"><i
                                                class="layui-icon">&#xe642;</i>编辑
                                        </button>
                                        <button class="layui-btn layui-btn-warm layui-btn-xs"
                                                onclick="xadmin.open('添加','{{ route('dep.create', $dep->id) }}', 500, 200)">
                                            <i
                                                class="layui-icon">&#xe642;</i>添加子栏目
                                        </button>
                                        <button class="layui-btn-danger layui-btn layui-btn-xs"
                                                onclick="dep_del(this,'{{ route('dep.destroy', $dep->id) }}')" href="javascript:;"><i
                                                class="layui-icon">&#xe640;</i>删除
                                        </button>
                                    </td>
                                </tr>
                                @if(count($dep['children']) > 0)
                                    @foreach($dep['children'] as $child)
                                        <tr cate-id='{{ $child->id }}' fid='{{ $child->parent_id }}'>
                                            <td>
                                                <input type="checkbox" name="" lay-skin="primary">
                                            </td>
                                            <td>2</td>
                                            <td>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <i class="layui-icon x-show" status='true'>&#xe623;</i>
                                                {{ $child->name }}
                                            </td>
                                            <td>
                                                <input type="checkbox" name="switch" lay-text="开启|停用" checked=""
                                                       lay-skin="switch">
                                            </td>
                                            <td class="td-manage">
                                                <button class="layui-btn layui-btn layui-btn-xs"
                                                        onclick="xadmin.open('编辑','{{ route('dep.edit', $child->id) }}', 500, 200)"><i
                                                        class="layui-icon">&#xe642;</i>编辑
                                                </button>
                                                <button class="layui-btn layui-btn-warm layui-btn-xs"
                                                        onclick="xadmin.open('添加','{{ route('dep.create', $child->id) }}', 500, 200)"><i
                                                        class="layui-icon">&#xe642;</i>添加子栏目
                                                </button>
                                                <button class="layui-btn-danger layui-btn layui-btn-xs"
                                                        onclick="dep_del(this,'{{ route('dep.destroy', $child->id) }}')" href="javascript:;"><i
                                                        class="layui-icon">&#xe640;</i>删除
                                                </button>
                                            </td>
                                        </tr>
                                        @if(count($child['children']) > 0)
                                            @foreach($child['children'] as $grandson)
                                                <tr cate-id='{{ $grandson->id }}' fid='{{ $grandson->parent_id }}'>
                                                    <td>
                                                        <input type="checkbox" name="" lay-skin="primary">
                                                    </td>
                                                    <td>3</td>
                                                    <td>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        ├{{ $grandson->name }}
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="switch" lay-text="开启|停用" checked=""
                                                               lay-skin="switch">
                                                    </td>
                                                    <td class="td-manage">
                                                        <button class="layui-btn layui-btn layui-btn-xs"
                                                                onclick="xadmin.open('编辑','{{ route('dep.edit', $grandson->id) }}', 500, 200)"><i
                                                                class="layui-icon">&#xe642;</i>编辑
                                                        </button>
                                                        <button class="layui-btn layui-btn-warm layui-btn-xs"
                                                                onclick="xadmin.open('添加','{{ route('dep.create', $grandson->id) }}', 500, 200)"><i
                                                                class="layui-icon">&#xe642;</i>添加子栏目
                                                        </button>
                                                        <button class="layui-btn-danger layui-btn layui-btn-xs"
                                                                onclick="dep_del(this,'{{ route('dep.destroy', $grandson->id) }}')" href="javascript:;">
                                                            <i
                                                                class="layui-icon">&#xe640;</i>删除
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
                        // console.log(data)
                        //发异步，把数据提交给php
                        var action = data.form.action;

                        $.ajax({
                            type: 'post',
                            url: action,
                            data: data.field,
                            success: function (res) {
                                layer.alert(res.msg, {
                                        icon: 6
                                    },
                                    function () {
                                        parent.location.reload();
                                    });
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

        /*部门删除-删除*/
        function dep_del(obj, url) {
            layer.confirm('确认要删除吗？', function (index) {
                //发异步删除数据
                var csrftoken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'delete',
                    url: url,
                    headers: {"X-CSRF-TOKEN": csrftoken},
                    success: function (res) {
                        if (res.code == 200) {
                            $(obj).parents("tr").remove();
                            layer.msg(res.msg, {icon: 1, time: 1000});
                        } else {
                            layer.msg(res.msg, {icon: 5, time: 1000});
                        }
                    },
                    error: function (res) {
                        layer.msg('系统异常!', {icon: 5, time: 1000});
                    }
                })
            });
        }

        // 分类展开收起的分类的逻辑
        //
        $(function () {
            $("tbody.x-cate tr[fid!='0']").hide();
            // 栏目多级显示效果
            $('.x-show').click(function () {
                if ($(this).attr('status') == 'true') {
                    $(this).html('&#xe625;');
                    $(this).attr('status', 'false');
                    cateId = $(this).parents('tr').attr('cate-id');
                    $("tbody tr[fid=" + cateId + "]").show();
                } else {
                    cateIds = [];
                    $(this).html('&#xe623;');
                    $(this).attr('status', 'true');
                    cateId = $(this).parents('tr').attr('cate-id');
                    getCateId(cateId);
                    for (var i in cateIds) {
                        $("tbody tr[cate-id=" + cateIds[i] + "]").hide().find('.x-show').html('&#xe623;').attr('status', 'true');
                    }
                }
            })
        })

        var cateIds = [];

        function getCateId(cateId) {
            $("tbody tr[fid=" + cateId + "]").each(function (index, el) {
                id = $(el).attr('cate-id');
                cateIds.push(id);
                getCateId(id);
            });
        }

    </script>
@endsection
