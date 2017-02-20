<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController {

    /**
     * GET admin/article
     * 全部文章列表
     */
    public function index() {
    	// 分页
		$data = Article::orderBy('art_id', 'desc')->paginate(2);
		return view('admin.article.index')->with('data', $data);
    }

    /**
     * POST admin/article  
	 * 添加文章
     */
    public function store(){
		$input = Input::except('_token');
		
		$input['art_time'] = time(); // 时间戳
		
		$input['cate_id'] = (int)$input['cate_id']; 
		
        // 验证规则
        $rules = [
            'art_title' => 'required',
            'art_editor' => 'required',
            'art_tags' => 'required',
            'art_content' => 'required'
        ];

        // 提示信息
        $msg = [
            'art_title.required' => '文章标题不能为空',
            'art_editor.required' => '编辑作者不能为空',
            'art_tags.required' => '标签不能为空',
            'art_content.required' => '内容不能为空'
        ];

        // 验证数据
        $validator = Validator::make($input, $rules, $msg);
		
		if ($validator->passes()) {
            // 入库
			$res = Article::create($input);
            if (!$res) {
                return back()->with('errors', '添加失败');
            } else {
                return redirect('admin/article');
            }
		} else {
		    // 验证数据失败
            return back()->withErrors($validator);
		}
    }

    /**
     * GET admin/article/create
	 * 添加文章
     */
    public function create() {
    	$cate = new Category();
		$data = $cate->tree();
//		$data = Article::where('art_id', 0)->get();
		return view('admin.article.add', compact('data'));
    }

    /**
     * GET admin/article/{article}
     */
    public function show() {

    }

    /**
     * DELETE admin/article/{article}
     */
    public function destroy() {

    }

    /**
     * PUT  admin/article/{article}
     */
    public function update() {

    }

    /**
     * GET admin/article/{article}/edit
     */
    public function edit() {

    }

}
