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
                        <form class="layui-form layui-col-space5" method="GET" action="{{ route('user.index') }}">
                            <div class="layui-inline layui-show-xs-block">
                                <input type="text" name="name" placeholder="请输入姓名" autocomplete="off"
                                       class="layui-input">
                            </div>
                            <div class="layui-inline">
                                <div class="layui-input-inline">
                                    <select name="department" lay-search="">
                                        <option value="">直接选择或搜索选择</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
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
                        <button class="layui-btn" onclick="xadmin.open('添加用户','{{ route('user.create') }}',600,600)"><i
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
                                <th>姓名</th>
                                <th>所属部门</th>
                                <th>最近领取时间</th>
                                <th>状态</th>
                                <th>操作</th>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="" lay-skin="primary">
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->department->name }}</td>
                                    <td>{{ $user->last_login ?? '暂无' }}</td>
                                    @if ($user->status)
                                        <td class="td-status">
                                            <span class="layui-btn layui-btn-normal layui-btn-mini">在职</span></td>
                                    @else
                                        <td class="td-status">
                                            <span class="layui-btn layui-btn-danger layui-btn-mini">离职</span></td>
                                    @endif

                                    <td class="td-manage">
                                        <a onclick="user_stop(this,'{{ route('user.exchange_status', $user->id) }}')" href="javascript:;" title="{{ $user->status ? '在职' : '离职' }}">
                                            <i class="layui-icon">&#xe601;</i>
                                        </a>
                                        <a title="编辑" onclick="xadmin.open('编辑', '{{ route('user.edit', $user->id) }}',600,400)" href="javascript:;">
                                            <i class="layui-icon">&#xe642;</i>
                                        </a>
                                        <a title="删除" onclick="member_del(this,'{{ route('user.destroy', $user->id) }}')" href="javascript:;">
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
                            {{ $users->links() }}
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
                if ($(obj).attr('title') == '在职') {

                    //发异步把用户状态进行更改

                    $.ajax({
                        type: 'patch',
                        url: url,
                        headers: {"X-CSRF-TOKEN": csrftoken},
                        success: function (res) {
                            if (res.code == 200) {
                                $(obj).attr('title', '离职')
                                $(obj).find('i').html('&#xe62f;');

                                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('离职');
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
                                $(obj).attr('title', '在职')
                                $(obj).find('i').html('&#xe601;');

                                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('在职');
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
