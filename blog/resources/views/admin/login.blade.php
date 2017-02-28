<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{asset('resources/views/admin/style/css/ch-ui.admin.css')}}">
	<link rel="stylesheet" href="{{asset('resources/views/admin/style/font/css/font-awesome.min.css')}}">
</head>

<body style="background: #f9f9f9;">
<div class="login_box">
	<h1>BLOG</h1>
	<h2>欢迎使用博客管理平台</h2>
	<div class="form">
		@if (session('msg'))
			<p style="color: red; height: 30px;" id="error">{{session('msg')}}</p>
		@else
			<p style="color: red; height: 0;" id="error"></p>
		@endif
		<form action="" method="post">
			{{csrf_field()}}
			<ul>
				<li>
					<input type="text" name="user_name" class="text focus" id="username" />
					<span><i class="fa fa-user"></i></span>
				</li>
				<li>
					<input type="password" name="user_pass" class="text focus" id="password"/>
					<span><i class="fa fa-lock"></i></span>
				</li>
				<li>
					<input type="text" class="code focus" name="code" id="code"/>
					<span><i class="fa fa-check-square-o"></i></span>
					<img src="{{url('admins/code')}}" alt="" id="codes">
				</li>
				<li>
					<input type="submit" value="立即登陆" id="submit" />
				</li>
			</ul>
		</form>
		<p><a href="/">返回首页</a> &copy; 2017-2-12 Powered by <a href="http://www.linxingzhang.com" target="_blank">http://www.linxingzhang.com</a></p>
	</div>
</div>

<script type="text/javascript">
    // 点击再次请求验证码
    var ObjCodes = document.querySelector('#codes');
    ObjCodes.onclick = function() {
        this.src = '{{url("admins/code")}}' + '?random=' + Math.random();
    };

    // 验证表单
    var ObjSubmit = document.querySelector('#submit');
    var ObjUesr = document.querySelector('#username');
    var ObjPass = document.querySelector('#password');
    var ObjErr = document.querySelector('#error');
    var ObjCode = document.querySelector('#code');

    ObjSubmit.onclick = function() {
        // 验证用户名和密码 验证码
        var valUser = ObjUesr.value;
        var valPass = ObjPass.value;
        var valCode = ObjCode.value;

        if (!valUser) {
            errShowHide(ObjErr, '用户名不能为空', 30);
            return false;
        } else if (!valPass) {
            errShowHide(ObjErr, '密码不能为空', 30);
            return false;
        }  else if (!valCode) {
            errShowHide(ObjErr, '验证码不能为空', 30);
            return false;
        } else if (valUser.length < 3) {
            errShowHide(ObjErr, '用户名不能小于3个', 30);
            return false;
        } else if (!/^[a-zA-Z0-9_]{3,16}$/.test(valUser) ) {
            errShowHide(ObjErr, '用户名不能为特殊字符', 30);
            return false;
        }
    }

    // 处理 错误显示
    var ArrFocus = document.querySelectorAll('.focus');
    for ( var i = 0; i<ArrFocus.length; i++ ) {
        try{
            ArrFocus[i].onfocus = function() {
                var ObjErr = document.querySelector('#error');
                console.log(ObjErr);
                ObjErr.style.height = 0;
            }
        }catch(e){
            //TODO handle the exception
        }
    }

    // 设置错误区域显示隐藏
    function errShowHide(obj, txt, num) {
        obj.style.height = num + 'px';
        obj.innerHTML = txt;
    }

</script>

</body>
</html>