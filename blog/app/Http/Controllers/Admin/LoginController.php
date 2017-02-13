<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

class LoginController extends CommonController {
	
	/**
	 * 登陆
	 */
	public function login() {
		return view('admin.login');		
	}
	
	/**
	 * 检验登陆
	 */
	public function checkLogin() {
		echo 123;
	}
	
}
