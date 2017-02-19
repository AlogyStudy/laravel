<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('resources/views/admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('resources/views/admin/style/font/css/font-awesome.min.css')}}">
</head>
<body>

@include('admin.public.crumbs')

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>快捷操作</h3>
    </div>
    <div class="result_content">
        <div class="short_wrap">
            <a href="#"><i class="fa fa-plus"></i>新增文章</a>
            <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
            <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
        </div>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<!--结果集列表组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>系统基本信息</h3>
    </div>
    <div class="result_content">
        <ul>
            <li>
                <label>操作系统</label><span>{{PHP_OS}}</span>
            </li>
            <li>
                <label>运行环境</label><span>{{$_SERVER['SERVER_SOFTWARE']}}</span>
            </li>
            <li>
                <label>浏览器信息</label><span>{{$_SERVER['HTTP_USER_AGENT']}}</span>
            </li>
            <li>
                <label>上传附件限制</label><span>{{get_cfg_var('upload_max_filesize') ? get_cfg_var('upload_max_filesize') : '不允许上传附件'}}</span>
            </li>
            <li>
                <label>北京时间</label><span>{{date('Y-m-d G:i:s')}}</span>
            </li>
            <li>
                <label>服务器域名/IP</label><span>{{$_SERVER['SERVER_NAME']}} [{{$_SERVER['SERVER_ADDR']}}]</span>
            </li>
            <li>
                <label>REDIS_HOST</label><span>{{$_SERVER['REDIS_HOST']}}</span>
            </li>
            <li>
                <label>数据库HOST</label><span>{{$_SERVER['DB_HOST']}}</span>
            </li>
            <li>
                <label>HOST</label><span>{{$_SERVER['SERVER_ADDR']}}</span>
            </li>
        </ul>
    </div>
</div>

<div class="result_wrap">
    <div class="result_title">
        <h3>使用帮助</h3>
    </div>
    <div class="result_content">
        <ul>
            <li>
                <label>GitHub地址：</label><span><a href="https://github.com/alogy" target="_blank">https://github.com/alogy</a></span>
            </li>
        </ul>
    </div>
</div>
<!--结果集列表组件 结束-->

</body>
</html>