<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller {

    /**
     * 图片上传
     */
    public function uploadImg() {
        $file = Input::file('Filedata');
        // 检验上传的文件是否有效
        if ($file->isValid()) {
            $extension = $file->getClientOriginalExtension(); // 后缀名
            // 自定义目录
            $newName = date('ymdhis').mt_rand(100, 999).'.'.$extension; // 201702191657000000aaa.png
            $path = $file->move(base_path().'/uploads', $newName); // app_path() 计算的路径是app文件夹所在的路径
            $filePath = '/uploads/'.$newName;
            echo $filePath;
        }
    }
}
