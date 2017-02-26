@extends('home.public.layout')

@section('content')
    <div>
        <img src="{{url('resources/views/home/images/weixin.jpg')}}" class="weixin-img" />
        <div class="weixin-con">wechat</div>
    </div>
@endsection

<style>
    .header {
        display: none !important;
    }
    body {
        background: #000 !important;
    }
    .weixin-img {
        border: 1px solid #fff;
    }
    .weixin-con {
        color: #fff;
    }

</style>