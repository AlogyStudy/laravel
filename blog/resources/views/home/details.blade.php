@extends('home.public.layout')

@section('content')
	<link rel="stylesheet" href="{{url('resources/views/home/css/details.css')}}" />

	<div class="details-wrap fmt">

		<div class="d-article">
			<h2>{{$art['art_title']}}</h2>

			<div class="art-c">{!! $art['art_content'] !!}</div>

			<div class="info-d info-a">
				<i></i><span>{{date('Y-m-d', $art['art_time'])}} </span>
				<i></i><span>{{$art['art_view']}} </span>
			</div>

			<!-- JiaThis Button BEGIN -->
			<div class="jiathis_style_32x32">
				<a class="jiathis_button_tsina"></a>
				<a class="jiathis_button_weixin"></a>
				<a class="jiathis_button_douban"></a>
				<a class="jiathis_button_fb"></a>
			</div>
			<script type="text/javascript" >
                var jiathis_config={
                    summary:"",
                    shortUrl:false,
                    hideMore:false
                }
			</script>
			<script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js" charset="utf-8"></script>
			<!-- JiaThis Button END -->

		</div>


		<!-- 多说评论框 start -->
		<div class="ds-thread" data-thread-key="{{'/art/' . $art['art_id']}}" data-title="{{$art['art_title']}}" data-url="{{url('art/'). '/' . $art['art_id']}}"></div>
		<!-- 多说评论框 end -->
		<!-- 多说公共JS代码 start -->
		<script type="text/javascript">
            var duoshuoQuery = {short_name: "linxingzhang"};
            (function() {
                var ds = document.createElement('script');
                ds.type = 'text/javascript'; ds.async = true;
                ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
                ds.charset = 'UTF-8';
                (document.getElementsByTagName('head')[0]
                || document.getElementsByTagName('body')[0]).appendChild(ds);
            })();
		</script>
		<!-- 多说公共JS代码 end -->

	@include('home.public.footer')
@endsection