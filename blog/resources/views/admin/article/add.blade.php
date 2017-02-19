

@extends('admin.public.layout')

@section('content')

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 文章管理
    </div>
    <!--面包屑导航 结束-->


    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>添加文章</h3>
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
                <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
                <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/category')}}" method="post">
            <table class="add_tab">
                {{csrf_field()}}
                <tbody>
                <tr>
                    <th width="120">分类：</th>
                    <td>
                        <select name="cate_id">
                            <option value="0">==顶级分类==</option>
                            @foreach($data as $v)
                                <option value="{{$v['cate_id']}}">{{str_repeat('&nbsp;&nbsp;', $v['lev'])}}{{$v['cate_name']}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>文章标题：</th>
                    <td>
                        <input type="text" class="lg" name="art_title">
                        <p>标题可以写30个字</p>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>缩略图：</th>
                    <td>
                        <input type="text" class="art_thumb lg" name="art_thumb">
                        <script src="{{asset('resources/org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
                        <link rel="stylesheet" type="text/css" href="{{asset('resources/org/uploadify/uploadify.css')}}">
                        <input id="file_upload" name="file_upload" type="file" multiple="true">
                        <script type="text/javascript">
                            <?php $timestamp = time();?>
                            $(function() {
                                $('#file_upload').uploadify({
                                    'buttonText': '图片上传',
                                    'formData': {
                                        'timestamp' : '<?php echo $timestamp;?>',
                                        '_token': '{{csrf_token()}}',
                                    },
                                    'swf'      : '{{asset("resources/org/uploadify/uploadify.swf")}}',
                                    'uploader' : '{{url('admin/upload')}}', // 上传路径
                                    'onUploadSuccess': function(file, data, response) {
                                		// 上传成功
                                    	if(response) {
                                    		// 路径显示
                                    		$('.art_thumb').val(data);
                                    		// 图片显示
                                    		$('#art_thumb_upload').attr('src', data);
                                    		$('.art_thumb_wrap').show();
                                    	}
                                    }
                                });
                            });
                        </script>
                        <style>
                            .uploadify{display: inline-block;}
                            .uploadify-button{border: none; border-radius:5px; margin-top:8px; background: #428bca;}
                            .uploadify:hover .uploadify-button {
                            	background: #0F4880;
                            }
                            table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
                        </style>
                    </td>
                </tr>
                <tr class="art_thumb_wrap" style="display: none;">
                    <th></th>
                    <td>
                        <img src="" alt="" id="art_thumb_upload" style="max-width: 400px; max-height: 100px;" />
                    </td>
                </tr>
                <tr>
                    <th>编辑：</th>
                    <td>
                        <input type="text" name="art_editor" />
                    </td>
                </tr>
                <tr>
                    <th>文章标签：</th>
                    <td>
                        <input type="text" name="art_tags">
                    </td>
                </tr>
                <tr>
                    <th>关键词：</th>
                    <td>
                        <input type="text" class="lg" name="art_keywords">
                    </td>
                </tr>
                <tr>
                    <th>描述：</th>
                    <td>
                        <input type="text" class="lg" name="art_description">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>文章内容：</th>
                    <td>
                        <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.config.js')}}"></script>
                        <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.all.min.js')}}"> </script>
                        <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/lang/zh-cn/zh-cn.js')}}"></script>

                        <script id="editor" type="text/plain" name="art_contenttext" style="width: 860px;height:500px;"></script>

                        <script type="text/javascript">
                            // 实例化编辑器
                            var ue = UE.getEditor('editor');
                        </script>

                        <style>
                            .edui-default{ line-height: 28px; }
                            div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                            { overflow: hidden; height:20px; }
                            div.edui-box{overflow: hidden; height:22px;}
                        </style>
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