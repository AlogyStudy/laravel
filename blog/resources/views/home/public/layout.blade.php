<!DOCTYPE html>
<html>
<head>
    <title>{{Config::get('webConf.web_title')}}</title>
    <meta name="keywords" content="{{Config::get('webConf.keywords')}}" />
    <meta name="description" content="{{Config::get('webConf.description')}}" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" href="{{url('resources/views/home/css/reset.css')}}" />
    <link rel="stylesheet" href="{{url('resources/views/home/css/index.css')}}" />
</head>
<body>

<script type="text/javascript">
    try{
        function setFontsize() {
            document.querySelector('html').style.fontSize = (document.body.clientWidth / 375 * 16 + 'px');
        }
        setFontsize();
    }catch(e){
        console.log(e);
    }
</script>

<div class="container">

    <!--header-->
    <div class="header">
        <div class="logo"><a href="/">ALoGY</a></div>
        <div class="nav">
            <ul>
                @foreach($data as $k => $v)
                    <li @if($k>4) class="hide" @endif><a href="{{$v['nav_url']}}">{{$v['nav_name']}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <!--end header-->

    @yield('content')

    <footer style="font-family: 'Microsoft YaHei'; line-height: 1rem;">
        <div class="coypright">{{Config::get('webConf.copyright')}}</div>
    </footer>
</div>
</body>
</html>