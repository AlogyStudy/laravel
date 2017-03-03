<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use EndaEditor;

class IndexController extends Controller {
    
	/**
	 * 首页
	 */
    public function index() {
    	return view('home.index');
    }
	
	/**
	 * 列表页
	 */
	public function cateAll() {
		$cate = Category::orderBy('cate_order')->get();
		$art = Article::orderBy('art_time', 'desc')->paginate(2);

		// markdown 解析成html
        foreach ($art as $v) {
            $v['art_content'] = EndaEditor::MarkDecode($v['attributes']['art_content']);
        }

		return view('home.list', compact('cate', 'art'));
	}
	
	/**
	 * 单项列表页
	 */
	public function cate($cate_id) {
		$cate = Category::orderBy('cate_order')->get();
		$art = Article::where('cate_id', $cate_id)->orderBy('art_time', 'desc')->paginate(2);

		return view('home.list', compact('cate', 'art'));
	}

	/**
	 * 详情页
	 */
	public function article($art_id) {
        $art = Article::where('art_id', $art_id)->get();
        $art = $art[0]['original'];

        // 更新浏览次数
        DB::update('update b_article set art_view = ? where art_id = ?',[$art['art_view']+=1, $art_id]);

        // markdown 解析成html
        $art['art_content'] = EndaEditor::MarkDecode($art['art_content']);

        return view('home.details', compact('art'));
	}
	
	/**
	 * 微信页面
	 */
	public function wechat() {
		return view('home.weixin');
	}
	
	/**
	 * 电影页面
	 */
	public function movie() {
        return view('home.movie');
	}

    /**
     * 关于我
     */
	public function about() {
        return view('home.about');
	}

}
