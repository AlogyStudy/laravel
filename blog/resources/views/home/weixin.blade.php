@extends('home.public.layout')

@section('content')
    <div>
        <img src="{{url('resources/views/home/images/weixin.jpg')}}" class="weixin-img" />
        <div class="wechat">Wechat</div>
        <div><a href="/" class="BackHome">返回首页</a></div>
    </div>
@endsection

<style>
    .header {
        display: none !important;
    }
    .weixin-img {
        border: 1px solid #fff;
    }
    body {
        background: #000 !important;
    }
    .wechat {
        color: #fafafa;
    }
    .BackHome {
        font-size: 30px;
    }
    .BackHome:hover {
        color: #333;
    }
</style>