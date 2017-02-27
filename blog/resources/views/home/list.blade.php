@extends('home.public.layout')

@section('content')
	<link rel="stylesheet" href="{{url('resources/views/home/css/list.css')}}" />

	<div class="list-wrap">

		<nav class="navs">
			<ul>
				@foreach($cate as $v)
					<li>
						<a href="@if($v['cate_id'] == 23) {{url('/cate')}} @else {{url('/cate/'.$v['cate_id'])}} @endif">{{$v['cate_name']}}</a>
					</li>
				@endforeach
			</ul>
		</nav>
		<!--end nav-->

		<div class="contents">
			@if($art->count())
				@foreach($art as $k => $a)
					<div class="article">
						<link rel="stylesheet" type="text/css" href="{{asset('resources/org/simditor/styles/simditor.css')}}" />
						<h1 class="title"><a href="{{url('art/'). '/' . $a['art_id']}}" target="_blank">{{$a['art_title']}}</a></h1>
						<div class="post_body">
							{!!$a['art_content']!!}
							{{--<img src="{{$a['art_thumb']}}" alt="" />--}}
						</div>
						<script type="text/javascript">
							var postBody = document.querySelector('.post_body');
							var postBodyCon = postBody.querySelectorAll('*');
							var html = '';
							for (var i=0; i<7; i++) {
							    if(postBodyCon[i].innerText) {
							        if (i==7) {
							            var str = postBodyCon[7].innerText;
							            html += '<p>'+ str.substring(str.legnth-6) + '......' +'</p>';
							            break;
									}
                                    html += '<p>' + postBodyCon[i].innerText +'</p>';

								}
							}
							console.log(html);
//                            postBody.innerHTML = html;
						</script>
						<div class="info">
							<span>时间: {{date('Y-m-d', $a['art_time'])}}</span>
							<span>阅读次数: {{$a['art_view']}}</span>
						</div>
					</div>
				@endforeach
			@else
				<div class="article" style="text-align: center;">暂无文章</div>
		@endif

		<!--分页 start-->
			<link rel="stylesheet" href="{{url('resources/views/home/css/paging.css')}}" />
			<div class="page_list">
				{{$art->links()}}
			</div>
			<!--分页 end-->
		</div>
		<!--end content-->


		<!-- 多说评论框 start -->
		<div class="ds-thread" data-thread-key="/cate/23" data-title="{{Config::get('webConf.web_title')}}" data-url="{{url('/cate/23')}}"></div>
		<!-- 多说评论框 end -->
		<!-- 多说公共JS代码 start -->
		<script type="text/javascript">
            var duoshuoQuery = {short_name:"linxingzhang"};
            (function() {
                var ds = document.createElement('script');
                ds.type = 'text/javascript';ds.async = true;
                ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
                ds.charset = 'UTF-8';
                (document.getElementsByTagName('head')[0]
                || document.getElementsByTagName('body')[0]).appendChild(ds);
            })();
		</script>
		<!-- 多说公共JS代码 end -->


	</div>
@endsection

