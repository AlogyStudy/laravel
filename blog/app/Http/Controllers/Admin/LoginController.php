<?php

namespace App\Http\Controllers\Admin;

use App\Http\Admin\User;
use Illuminate\Http\Request;
require_once '/resources/org/code/Code.class.php';

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class LoginController extends CommonController {
	
	/**
	 * 登陆状态
	 */
	public function login() {
	    if ($input = Input::all()) {
	        // 判断验证码
            if (strtoupper($input['code']) != strtoupper($this->getCode())) {
                return back()->with('msg', '验证码错误');
            }
            // 用户名和密码
            if (!$input['user_name'] && !$input['user_pass']) {
                return back()->with('msg', '用户名或密码不能为空');
            } else {
                // 存在用户名和密码
                // DB::table('user')->where('user_id', $input['user_name'])
                $user = User::first();
                if (!$user->user_name == $input['user_name'] && !Crypt::decrypt($user->user_pass) == $input['user_pass']) {
                    return back()->with('msg', '用户名或密码不正确');
                } else {

                }
            }

        } else {
            return view('admin.login');
        }

	}

    /**
     * 后台登陆验证码
     */
    public function code() {
        $code = new \Code();
        echo $code->make();
    }

    /**
     * 得到验证码
     * @return 返回取到的验证码
     */
    public function getCode() {
        $code = new \Code();
        return $code->get();
    }

	
}
