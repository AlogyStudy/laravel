<?php

namespace App\Http\Controllers\Admin;

use App\Http\Admin\User;
use Dotenv\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class IndexController extends CommonController {
	
	/**
	 * 欢迎页
	 */
	public function index() {
		return view('admin.index');
	}    
	
	/**
	 * 信息显示
	 */
	public function info() {
		return view('admin.info');
	}
	
	/**
	 * 修改密码
	 */
	public function pass() {
		if ($input = Input::all()) {
			
			// 验证规则
			$relus = [
				'password' => 'required',
			];
			
			$validator = Validator::make($input, $relus);
			
			// 验证是否通过
			if ($validator->passes()) {
				echo 'y';
			} else {
				echo 'n';
			}
    } else {
      return view('admin.pass');
    }
	} 
	
}
