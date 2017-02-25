<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
	public function cate($cate_id) {
		echo $cate_id;
//		return view('home');
	}

	/**
	 * 详情页
	 */
	public function article() {
		return view('home.new');
	}	
	
}
