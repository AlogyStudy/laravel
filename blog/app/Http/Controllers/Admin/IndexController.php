<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

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
            $rules = [
                'password' => 'required|between:5,20|confirmed',
            ];

            // 提示信息
            $msg = [
                'password.required' => '新密码不能为空',
                'password.between' => '新密码必须在5-20位之间',
                'password.confirmed' => '新密码和确认密码不一致'
            ];

            $validator = Validator::make($input, $rules, $msg);
            if ($validator->passes()) {

                // 对比原密码
				$user = User::first();
                $_password = Crypt::decrypt($user->user_pass);
				
				// 判断输入的 原始密码和 数据库存储的密码
				if ($input['password_o'] != $_password) {
					return back()->with('errors', '原密码输入错误');		
				}
				
				// 密码修改
				$user->user_pass = $_password = Crypt::encrypt($input['password']);
				$user->update();
				return back()->with('errors', '密码修改成功');
            } else {
//				dd($validator->errors()->all());
                return back()->withErrors($validator);
            }
        } else {
            return view('admin.pass');
        }
    }

}
