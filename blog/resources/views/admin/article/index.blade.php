
@extends('admin.public.layout')

@section('content')

	<!--面包屑导航 开始-->
	<div class="crumb_warp">
		<!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
		<i class="fa fa-home"></i>
		<a href="{{url('admin/info')}}">首页</a> &raquo; 文章管理
	</div>
	<!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
	<div class="search_wrap">
		<form action="" method="post">
			<table class="search_tab">
				<tr>
					<th width="120">选择分类:</th>
					<td>
						<select onchange="javascript:location.href=this.value;">
							<option value="">全部</option>
							@foreach($data as $v)
								<option value="">{{str_repeat('&nbsp;&nbsp;', $v['lev'])}}{{$v['cate_name']}}</option>
							@endforeach
						</select>
					</td>
					<th width="70">关键字:</th>
					<td><input type="text" name="keywords" placeholder="关键字"></td>
					<td><input type="submit" name="sub" value="查询"></td>
				</tr>
			</table>
		</form>
	</div>
	<!--结果页快捷搜索框 结束-->

	<!--搜索结果页面 列表 开始-->
	<form action="#" method="post">
		<div class="result_wrap">
			<div class="result_title">
				<h3>文章列表</h3>
			</div>
			<!--快捷导航 开始-->
			<div class="result_content">
				<div class="short_wrap">
					<a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
					<a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
				</div>
			</div>
			<!--快捷导航 结束-->
		</div>

		<div class="result_wrap">
			<div class="result_content">
				<table class="list_tab" id="list_tab">
					<tr>
						<th class="tc" width="5%"><input type="checkbox" name=""></th>
						<th class="tc">ID</th>
						<th>文章标题</th>
						<th>查看次数</th>
						<th>编辑</th>
						<th>更新时间</th>
						<th>操作</th>
					</tr>

					@foreach ($data as $v)
						<tr>
							<td class="tc"><input type="checkbox" name="id[]" value="{{$v['art_id']}}"></td>
							<td class="tc">{{$v['art_id']}}</td>
							<td><a href="#">{{$v['art_title']}}</a></td>
							<td>{{$v['art_view']}}</td>
							<td>{{$v['art_editor']}}</td>
							<td>{{date('Y-m-d', $v['art_time'])}}</td>
							<td>
								<a href="{{url('admin/article/'. $v['art_id'] .'/edit')}}">修改</a>
								<a href="javascript:;" onclick="del(this, {{$v['art_id']}})">删除</a>
							</td>
						</tr>
					@endforeach
				</table>
			</div>
		</div>
	</form>
	<!--搜索结果页面 列表 结束-->

	
	<div class="page_list">
		{{$data->links()}}
	</div>
	
	<style>
		.page_list ul li span {
			font-size: 15px;
			padding: 6px 12px;
		}
	</style>

	<script src="{{asset('resources/org/layer/layer.js')}}"></script>
	<script type="text/javascript">

        // 排序功能
        $(function() {
            $('.changeOrder').change(function() {
                var cate_id = $(this).attr('_id');
                var cate_order = $(this).val();

                $.ajax({
                    url: '{{url("admin/cate/changeorder")}}',
                    type: 'POST',
                    data: {
                        _token: '{{csrf_token()}}', // csrf 认证
                        cate_id: cate_id,
                        cate_order: cate_order
                    },
                    success: function(data) {
                        var data = JSON.parse(data);

                        if (data.status === 1) {
                            layer.alert(data.msg, {icon: 1});

                            // 刷新页面.
                            window.location.href = window.location.href;

                        } else if (data.status === 0) {
                            layer.alert(data.msg, {icon: 2});
                        }

                    }
                });
            });

        });


        // 删除提示
        function del(_this, $art_id) {
            layer.confirm('确认删除当前文章么？', {
                btn: ['确认', '返回']
            }, function() {

                // 异步删除数据
                $.ajax({
                    url: '{{url("admin/article")}}' + '/' +$art_id,
                    type: 'post',
                    data: {
                        _token: '{{csrf_token()}}',
                        _method: 'delete'
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.status === 1) {
                            // 删除成功
                            layer.alert(data.msg, {icon: 1});

                            // 刷新页面.
                            window.location.href = window.location.href;

                        } else {
                            // 删除失败
                            layer.alert(data.msg, {icon: 2});
                        }
                    }
                });

            });
        }
	</script>

@endsection















<script>


</script>