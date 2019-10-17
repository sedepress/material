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
            <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
    </div>
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body ">
                        <form class="layui-form layui-col-space5" method="GET" action="{{ route('material.index') }}">
                            <div class="layui-inline layui-show-xs-block">
                                <input type="text" name="name" placeholder="请输入名称" autocomplete="off"
                                       class="layui-input">
                            </div>
                            <div class="layui-inline layui-show-xs-block">
                                <button class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="layui-card-header">
                        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除
                        </button>
                        <button class="layui-btn" onclick="xadmin.open('添加物品','{{ route('material.create') }}',600,400)"><i
                                class="layui-icon"></i>添加
                        </button>
                    </div>
                    <div class="layui-card-body ">
                        <table class="layui-table layui-form">
                            <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="" lay-skin="primary">
                                </th>
                                <th>序号</th>
                                <th>名称</th>
                                <th>已领取总量</th>
                                <th>库存</th>
                                <th>最近存入时间</th>
                                <th>创建人</th>
                                <th>状态</th>
                                <th>操作</th>
                            </thead>
                            <tbody>
                            @foreach ($materials as $material)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="" lay-skin="primary">
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $material->name }}</td>
                                    <td>{{ $material->receive_count }}</td>
                                    <td>{{ $material->stock }}</td>
                                    <td>{{ $material->recent_deposit_time }}</td>
                                    <td>{{ $material->admin->nickname }}</td>
                                    @if ($material->status)
                                        <td class="td-status">
                                            <span class="layui-btn layui-btn-normal layui-btn-mini">启用</span></td>
                                    @else
                                        <td class="td-status">
                                            <span class="layui-btn layui-btn-danger layui-btn-mini">禁用</span></td>
                                    @endif

                                    <td class="td-manage">
                                        <a onclick="user_stop(this,'{{ route('material.exchange_status', $material->id) }}')" href="javascript:;" title="{{ $material->status ? '启用' : '禁用' }}">
                                            <i class="layui-icon">&#xe601;</i>
                                        </a>
                                        <a onclick="xadmin.open('修改库存','{{ route('material.adjust_form', $material->id) }}',600,400)" title="修改库存" href="javascript:;">
                                            <i class="layui-icon">&#xe631;</i>
                                        </a>
                                        <a title="编辑" onclick="xadmin.open('编辑', '{{ route('material.edit', $material->id) }}',600,400)" href="javascript:;">
                                            <i class="layui-icon">&#xe642;</i>
                                        </a>
                                        <a title="删除" onclick="member_del(this,'{{ route('material.destroy', $material->id) }}')" href="javascript:;">
                                            <i class="layui-icon">&#xe640;</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="layui-card-body ">
                        <div class="page">
                            {{ $materials->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptsAfterJs')
    <script>
        layui.use(['laydate', 'form'], function () {
            var laydate = layui.laydate;
            var form = layui.form;

            //执行一个laydate实例
            laydate.render({
                elem: '#start' //指定元素
            });

            //执行一个laydate实例
            laydate.render({
                elem: '#end' //指定元素
            });
        });

        /*用户-停用*/
        function user_stop(obj, url) {
            layer.confirm('确认要操作吗？', function (index) {
                var csrftoken = $('meta[name="csrf-token"]').attr('content');
                if ($(obj).attr('title') == '启用') {

                    //发异步把用户状态进行更改

                    $.ajax({
                        type: 'patch',
                        url: url,
                        headers: {"X-CSRF-TOKEN": csrftoken},
                        success: function (res) {
                            if (res.code == 200) {
                                $(obj).attr('title', '禁用')
                                $(obj).find('i').html('&#xe62f;');

                                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('禁用');
                                layer.msg('已完成!', {icon: 6, time: 1000});
                            } else {
                                layer.msg('系统异常!', {icon: 5, time: 1000});
                            }
                        },
                        error: function (res) {
                            layer.msg('系统异常!', {icon: 5, time: 1000});
                        }
                    })
                } else {
                    $.ajax({
                        type: 'patch',
                        url: url,
                        headers: {"X-CSRF-TOKEN": csrftoken},
                        success: function (res) {
                            if (res.code == 200) {
                                $(obj).attr('title', '启用')
                                $(obj).find('i').html('&#xe601;');

                                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('启用');
                                layer.msg('已完成!', {icon: 6, time: 1000});
                            } else {
                                layer.msg('系统异常!', {icon: 5, time: 1000});
                            }
                        },
                        error: function (res) {
                            layer.msg('系统异常!', {icon: 5, time: 1000});
                        }
                    })
                }
            });
        }

        /*用户-删除*/
        function member_del(obj, url) {
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
                            layer.msg('已删除!', {icon: 1, time: 1000});
                        } else {
                            layer.msg('系统异常!', {icon: 5, time: 1000});
                        }
                    },
                    error: function (res) {
                        layer.msg('系统异常!', {icon: 5, time: 1000});
                    }
                })
            });
        }


        function delAll(argument) {

            var data = tableCheck.getData();

            layer.confirm('确认要删除吗？' + data, function (index) {
                //捉到所有被选中的，发异步进行删除
                layer.msg('删除成功', {icon: 1});
                $(".layui-form-checked").not('.header').parents('tr').remove();
            });
        }
    </script>
@endsection
