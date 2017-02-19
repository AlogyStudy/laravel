<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleController extends CommonController {

    /**
     * GET admin/article
     * 全部文章列表
     */
    public function index() {
        echo 1;
    }

    /**
     * POST admin/article
     */
    public function store(){

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
