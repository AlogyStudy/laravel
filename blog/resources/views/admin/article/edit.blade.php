

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
            <h3>编辑文章</h3>
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
        <form action="{{url('admin/article/'.$field['art_id'])}}" method="post">
        	<input type="hidden" name="_method" value="put" />
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th width="120">分类：</th>
                    <td>
                        <select name="cate_id">
                            <option value="0">==顶级分类==</option>
                            @foreach($data as $v)
                                <option value="{{$v['cate_id']}}"
                                	@if($field['cate_id'] == $v['cate_id'])
                                	selected="selected"
                                	@endif
                                	>{{str_repeat('&nbsp;&nbsp;', $v['lev'])}}{{$v['cate_name']}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>文章标题：</th>
                    <td>
                        <input type="text" class="lg" name="art_title" value="{{$field['art_title']}}">
                        <p>标题可以写30个字</p>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>缩略图：</th>
                    <td>
                        <input type="text" class="art_thumb lg" name="art_thumb" value="{{$field['art_thumb']}}">
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
                <tr class="art_thumb_wrap" style="display: {{$field['art_thumb'] ? '' : 'none'}};">
                    <th></th>
                    <td>
                        <img src="{{$field['art_thumb']}}" alt="" id="art_thumb_upload" style="max-width: 400px; max-height: 100px;" />
                    </td>
                </tr>
                <tr>
                    <th>编辑：</th>
                    <td>
                        <input type="text" name="art_editor" value="{{$field['art_editor']}}" />
                    </td>
                </tr>
                <tr>
                    <th>文章标签：</th>
                    <td>
                        <input type="text" name="art_tags" value="{{$field['art_tags']}}">
                    </td>
                </tr>
                <tr>
                    <th>关键词：</th>
                    <td>
                        <input type="text" class="lg" name="art_keywords" value="{{$field['art_keywords']}}">
                    </td>
                </tr>
                <tr>
                    <th>描述：</th>
                    <td>
                        <input type="text" class="lg" name="art_description" value="{{$field['art_description']}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>文章内容：</th>
                    <td style="max-height: 500px;">
                        {{--<link rel="stylesheet" type="text/css" href="[style path]/font-awesome.css" />--}}
                        {{--<link rel="stylesheet" type="text/css" href="{{asset('resources/org/simditor/styles/simditor.css')}}" />--}}

                        {{--<script type="text/javascript" src="{{asset('resources/org/simditor/ueditor.config.js')}}/jquery.min.js"></script>--}}
                        {{--<script type="text/javascript" src="{{asset('resources/org/simditor/scripts/module.js')}}"></script>--}}
                        {{--<script type="text/javascript" src="{{asset('resources/org/simditor/scripts/hotkeys.js')}}"></script>--}}
                        {{--<script type="text/javascript" src="{{asset('resources/org/simditor/scripts/uploader.js')}}"></script>--}}
                        {{--<script type="text/javascript" src="{{asset('resources/org/simditor/scripts/simditor.js')}}"></script>--}}

                        {{--<textarea id="editor" placeholder="" autofocus name="art_content">{!!$field['art_content']!!}</textarea>--}}
                        {{--<script>--}}
                            {{--var editor = new Simditor({--}}
                                {{--textarea: $('#editor')--}}
                            {{--});--}}
                        {{--</script>--}}


                        {{----------------------------------------------}}
                        {{--<script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.config.js')}}"></script>
                        <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.all.min.js')}}"> </script>
                        <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/lang/zh-cn/zh-cn.js')}}"></script>

                        <script id="editor" type="text/plain" name="art_content" style="width: 860px; height:500px;">{!!$field['art_content']!!}</script>

                        <script type="text/javascript">
                            // 实例化编辑器
                            var ue = UE.getEditor('editor');
                        </script>

                        <style>
                            .edui-default{ line-height: 28px; }
                            div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                            { overflow: hidden; height:20px; }
                            div.edui-box{overflow: hidden; height:22px;}
                        </style>--}}


                            {{----------------------------------------}}

                        <link rel="stylesheet" type="text/css" href="{{asset('resources/org/editormd/css/editormd.min.css')}}" />
                        <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/editormd/editormd.min.js')}}"> </script>
                        <div id="editormd">
                            <textarea style="display:none;" name="art_content">{!! $field['art_content'] !!}</textarea>
                        </div>

                        <script>
                            var testEditor;
                            $(function(){
                                testEditor = editormd("editormd",{
                                    'height': '500px',
                                    syncScrolling : "single",
                                    path: "{{asset('resources/org/editormd/lib') . '/'}}",
                                    //启动本地图片上传功能
                                    imageUpload: true,
                                    imageFormats   : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
                                    imageUploadURL : "{{url('/upload') . '/'}}"
                                });
                            })
                        </script>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                var wordsView;
                                wordsView = editormd.markdownToHTML("wordsView", {
                                    htmlDecode      : "style,script,iframe",  // you can filter tags decode
                                    emoji           : true,
                                    taskList        : true,
                                    tex             : true,  // 默认不解析
                                    flowChart       : true,  // 默认不解析
                                    sequenceDiagram : true,  // 默认不解析
                                });
                            })
                        </script>
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