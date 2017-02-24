@extends('admin.public.layout')

@section('content')

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 网站配置管理
    </div>
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>编辑网站配置</h3>
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
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/configs/create')}}"><i class="fa fa-plus"></i>添加网站配置</a>
                <a href="{{url('admin/configs')}}"><i class="fa fa-recycle"></i>全部网站配置</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    <div class="result_wrap">
        <form action="{{url('admin/configs/'.$field['conf_id'])}}" method="post">
            {{--<input type="hidden" name="_method" value="put" />--}}
            {{method_field('PUT')}}
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>网站配置名称：</th>
                    <td>
                        <input type="text" name="conf_name" value="{{$field['conf_name']}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>网站配置名称必须填写</span>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>网站配置标题：</th>
                    <td>
                        <input type="text" name="conf_title" value="{{$field['conf_title']}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>网站配置标题必须填写</span>
                    </td>
                </tr>
                <tr>
                    <th>网站配置类型：</th>
                    <td class="field_type">
                    	<input type="radio" name="conf_field_type" value="input" @if($field['conf_field_type'] == 'input') checked @endif id="radio1" style="margin-left: 10px;" checked="checked" /><label for="radio1">input</label>
                    	<input type="radio" name="conf_field_type" value="textarea" @if($field['conf_field_type'] == 'textarea') checked @endif id="radio2" style="margin-left: 20px;" /><label for="radio2">textarea</label>
                    	<input type="radio" name="conf_field_type" value="radio" @if($field['conf_field_type'] == 'radio') checked @endif id="radio3" style="margin-left: 20px;" /><label for="radio3">radio</label>
                        <span><i class="fa fa-exclamation-circle yellow"></i>类型：input, textarea, radio</span>
                    </td>
                </tr>
                <tr id="conf_field_value" style="display: @if($field['conf_field_type'] != 'textarea') none @else table-row @endif">
                    <th>网站配置类型值：</th>
                    <td>
                        <input type="text" name="conf_field_value">
                        <span><i class="fa fa-exclamation-circle yellow"></i>类型值只有在radio需要配置，格式：`1|开启,0|关闭`</span>
                    </td>
                </tr>
                <script type="text/javascript">
                	$('.field_type input').click(function() {
                		if($(this).val() === 'radio') {
	                		$('#conf_field_value').show();
                		} else {
	                		$('#conf_field_value').hide();
                		}
                	});
                </script>
                <tr>
                    <th>排序：</th>
                    <td>
                        <input type="text" class="sm" name="conf_order" value="{{$field['conf_order']}}">
                    </td>
                </tr>
                <tr>
                    <th>说明：</th>
                    <td>
                    	<textarea name="conf_tips" value="" rows="" cols="">{{$field['conf_tips']}}</textarea>
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