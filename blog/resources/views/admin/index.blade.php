
@include('admin.public.header');

@include('admin.public.left');
<link rel="stylesheet" href="{{asset('resources/views/admin/style/font/css/font-awesome.min.css')}}">

<!--主体部分 开始-->
<div class="main_box">
	<iframe src="info" frameborder="0" width="100%" height="100%" name="main"></iframe>
</div>
<!--主体部分 结束-->

@include('admin.public.footer');
