@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="logo">
            <a href="./index.html">X-admin v2.2</a></div>
        <div class="left_open">
            <a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
        </div>
        <ul class="layui-nav right" lay-filter="">
            <li class="layui-nav-item">
                <a href="javascript:;">{{ Auth::user()->nickname }}</a>
                <dl class="layui-nav-child">
                    <!-- 二级菜单 -->
                    <dd>
                        <a onclick="xadmin.open('修改密码', '{{ route('change_pwd_form', Auth::user()->id) }}', 600, 400)">修改密码</a>
                    </dd>
                    <dd>
                        <form id="_form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <a onclick="document.getElementById('_form').submit();">退出</a>
                        </form>
                    </dd>
                </dl>
            </li>
            <li class="layui-nav-item to-index">
                <a href="/">前台首页</a></li>
        </ul>
    </div>
    <!-- 顶部结束 -->
    <!-- 中部开始 -->
    <!-- 左侧菜单开始 -->
    <div class="left-nav">
        <div id="side-nav">
            <ul id="nav">
                <li>
                    <a href="javascript:;">
                        <i class="iconfont left-nav-li" lay-tips="人员管理">&#xe6b8;</i>
                        <cite>人员管理</cite>
                        <i class="iconfont nav_right">&#xe697;</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a onclick="xadmin.add_tab('人员列表','{{ route('user.index') }}')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>人员列表</cite>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="iconfont left-nav-li" lay-tips="部门管理">&#xe723;</i>
                        <cite>部门管理</cite>
                        <i class="iconfont nav_right">&#xe697;</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a onclick="xadmin.add_tab('组织架构', '{{ route('dep.index') }}')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>组织架构</cite></a>
                        </li>
                    </ul>
                </li>
                @if(Auth::user()->can('manage_admins'))
                <li>
                    <a href="javascript:;">
                        <i class="iconfont left-nav-li" lay-tips="管理员管理">&#xe726;</i>
                        <cite>管理员管理</cite>
                        <i class="iconfont nav_right">&#xe697;</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a onclick="xadmin.add_tab('管理员列表','{{ route('admin.index') }}')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>管理员列表</cite></a>
                        </li>
                    </ul>
                </li>
                @endif
                <li>
                    <a href="javascript:;">
                        <i class="iconfont left-nav-li" lay-tips="物品管理">&#xe6f6;</i>
                        <cite>物品管理</cite>
                        <i class="iconfont nav_right">&#xe697;</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a onclick="xadmin.add_tab('物品列表','{{ route('material.index') }}')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>物品列表</cite>
                            </a>
                        </li>
                        <li>
                            <a onclick="xadmin.add_tab('物品领取记录','{{ route('materials_record.index') }}')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>物品领取记录</cite>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- <div class="x-slide_left"></div> -->
    <!-- 左侧菜单结束 -->
    <!-- 右侧主体开始 -->
    <div class="page-content">
        <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
            <ul class="layui-tab-title">
                <li class="home">
                    <i class="layui-icon">&#xe68e;</i>我的桌面
                </li>
            </ul>
            <div class="layui-unselect layui-form-select layui-form-selected" id="tab_right">
                <dl>
                    <dd data-type="this">关闭当前</dd>
                    <dd data-type="other">关闭其它</dd>
                    <dd data-type="all">关闭全部</dd>
                </dl>
            </div>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <iframe src="{{ route('index.welcome') }}" frameborder="0" scrolling="yes"
                            class="x-iframe"></iframe>
                </div>
            </div>
            <div id="tab_show"></div>
        </div>
    </div>
    <div class="page-content-bg"></div>
    <style id="theme_style"></style>
@endsection
