<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
        return view('home.weixin');
	}

    /**
     * 关于我
     */
	public function about() {
        return view('home.about');
	}

	/**
     * 解析文章字符串
     */
	public function parseStr() {
        //		foreach($art  as $v) {
//		    preg_match_all('/<.p>(.+?)<.p>/', $v['art_content'], $out, PREG_SET_ORDER);
//      }
//
//		$arrCotent = array();
//		foreach($out as $k => $v) {
//			$arrCotent[] = $v[1];
//			if ($k > 6) {
//				break;
//			}
//		}
////		dd($arrCotent);
//		$artC = array();
//		foreach($arrCotent as $v) {
//			if (preg_match_all('/[\x7f-\xff]+/', $v, $out)){
//	   			for ($i=1; $i<count($out[0]); $i++) {
//	   				if ($out[0][$i] == '宋体' || $out[0][$i] == '微软雅黑') {
//	   					continue;
//	   				}
//	   				$artC = $out[0][$i];
//	   			};
//	   		}
//		}
    }
}
