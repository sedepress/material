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
                        <hr>
                        <blockquote class="layui-elem-quote">每个tr 上有两个属性 cate-id='1' 当前分类id fid='0' 父级id ,顶级分类为
                            0，有子分类的前面加收缩图标<i class="layui-icon x-show" status='true'>&#xe623;</i></blockquote>
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
                                <th>栏目名</th>
                                <th width="50">排序</th>
                                <th width="80">状态</th>
                                <th width="250">操作</th>
                            </thead>
                            <tbody class="x-cate">
                            <tr cate-id='1' fid='0'>
                                <td>
                                    <input type="checkbox" name="" lay-skin="primary">
                                </td>
                                <td>1</td>
                                <td>
                                    <i class="layui-icon x-show" status='true'>&#xe623;</i>
                                    产品管理
                                </td>
                                <td><input type="text" class="layui-input x-sort" name="order" value="1"></td>
                                <td>
                                    <input type="checkbox" name="switch" lay-text="开启|停用" checked="" lay-skin="switch">
                                </td>
                                <td class="td-manage">
                                    <button class="layui-btn layui-btn layui-btn-xs"
                                            onclick="xadmin.open('编辑','admin-edit.html')"><i
                                            class="layui-icon">&#xe642;</i>编辑
                                    </button>
                                    <button class="layui-btn layui-btn-warm layui-btn-xs"
                                            onclick="xadmin.open('编辑','admin-edit.html')"><i
                                            class="layui-icon">&#xe642;</i>添加子栏目
                                    </button>
                                    <button class="layui-btn-danger layui-btn layui-btn-xs"
                                            onclick="member_del(this,'要删除的id')" href="javascript:;"><i
                                            class="layui-icon">&#xe640;</i>删除
                                    </button>
                                </td>
                            </tr>
                            <tr cate-id='2' fid='1'>
                                <td>
                                    <input type="checkbox" name="" lay-skin="primary">
                                </td>
                                <td>2</td>
                                <td>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <i class="layui-icon x-show" status='true'>&#xe623;</i>
                                    产品列表
                                </td>
                                <td><input type="text" class="layui-input x-sort" name="order" value="1"></td>
                                <td>
                                    <input type="checkbox" name="switch" lay-text="开启|停用" checked="" lay-skin="switch">
                                </td>
                                <td class="td-manage">
                                    <button class="layui-btn layui-btn layui-btn-xs"
                                            onclick="xadmin.open('编辑','admin-edit.html')"><i
                                            class="layui-icon">&#xe642;</i>编辑
                                    </button>
                                    <button class="layui-btn layui-btn-warm layui-btn-xs"
                                            onclick="xadmin.open('编辑','admin-edit.html')"><i
                                            class="layui-icon">&#xe642;</i>添加子栏目
                                    </button>
                                    <button class="layui-btn-danger layui-btn layui-btn-xs"
                                            onclick="member_del(this,'要删除的id')" href="javascript:;"><i
                                            class="layui-icon">&#xe640;</i>删除
                                    </button>
                                </td>
                            </tr>
                            <tr cate-id='3' fid='2'>
                                <td>
                                    <input type="checkbox" name="" lay-skin="primary">
                                </td>
                                <td>3</td>
                                <td>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    ├产品列表
                                </td>
                                <td><input type="text" class="layui-input x-sort" name="order" value="1"></td>
                                <td>
                                    <input type="checkbox" name="switch" lay-text="开启|停用" checked="" lay-skin="switch">
                                </td>
                                <td class="td-manage">
                                    <button class="layui-btn layui-btn layui-btn-xs"
                                            onclick="xadmin.open('编辑','admin-edit.html')"><i
                                            class="layui-icon">&#xe642;</i>编辑
                                    </button>
                                    <button class="layui-btn layui-btn-warm layui-btn-xs"
                                            onclick="xadmin.open('编辑','admin-edit.html')"><i
                                            class="layui-icon">&#xe642;</i>添加子栏目
                                    </button>
                                    <button class="layui-btn-danger layui-btn layui-btn-xs"
                                            onclick="member_del(this,'要删除的id')" href="javascript:;"><i
                                            class="layui-icon">&#xe640;</i>删除
                                    </button>
                                </td>
                            </tr>
                            <tr cate-id='4' fid='2'>
                                <td>
                                    <input type="checkbox" name="" lay-skin="primary">
                                </td>
                                <td>4</td>
                                <td>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    ├产品列表
                                </td>
                                <td><input type="text" class="layui-input x-sort" name="order" value="1"></td>
                                <td>
                                    <input type="checkbox" name="switch" lay-text="开启|停用" checked="" lay-skin="switch">
                                </td>
                                <td class="td-manage">
                                    <button class="layui-btn layui-btn layui-btn-xs"
                                            onclick="xadmin.open('编辑','admin-edit.html')"><i
                                            class="layui-icon">&#xe642;</i>编辑
                                    </button>
                                    <button class="layui-btn layui-btn-warm layui-btn-xs"
                                            onclick="xadmin.open('编辑','admin-edit.html')"><i
                                            class="layui-icon">&#xe642;</i>添加子栏目
                                    </button>
                                    <button class="layui-btn-danger layui-btn layui-btn-xs"
                                            onclick="member_del(this,'要删除的id')" href="javascript:;"><i
                                            class="layui-icon">&#xe640;</i>删除
                                    </button>
                                </td>
                            </tr>
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

        /*用户-删除*/
        function member_del(obj, id) {
            layer.confirm('确认要删除吗？', function (index) {
                //发异步删除数据
                $(obj).parents("tr").remove();
                layer.msg('已删除!', {icon: 1, time: 1000});
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
