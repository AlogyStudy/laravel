
@extends('admin.public.layout')

@section('content')

<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; 修改密码
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>修改密码</h3>
		@if(count($errors) > 0)
			<div class="mark">
				@if(!is_object($errors))
					<p>{{$errors}}</p>
				@else 
					@foreach($errors->all() as $v)
						<p>{{$v}}</p>
					@endforeach
				@endif 
			</div>
		@endif
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<script type="text/javascript">
window.onload = function() {
	var ArrFocus = document.querySelectorAll('.focus');
	var mark = document.querySelector('.mark');
	for ( var i = 0; i<ArrFocus.length; i++ ) {
		try{
			ArrFocus[i].onfocus = function() {
				mark && (mark.style.display = 'none'); 
			}
		}catch(e){
			//TODO handle the exception
		}
	}
}
</script>

<div class="result_wrap">
    <form method="post" action="">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>原密码：</th>
                <td>
                    <input type="password" name="password_o" class="focus"> </i>请输入原始密码</span>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>新密码：</th>
                <td>
                    <input type="password" name="password" class="focus"> </i>新密码5-20位</span>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>确认密码：</th>
                <td>
                    <input type="password" name="password_confirmation" class="focus"> </i>再次输入密码</span>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>

@endsection