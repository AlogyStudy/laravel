<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CategoryController extends CommonController {

    /**
	 * get admin/category 全部分类列表
	 */
    public function index() {
    	$c = new Category();
        $data = $c->tree();
		return view('admin.category.index')->with('data', $data);
    }
	
	/**
	 * 更改排序
	 */
	public function changeOrder() {
		$input = Input::all();
		$cate = Category::find($input['cate_id']);
		$cate->cate_order = $input['cate_order'];
		$res = $cate->update();
		
		// 执行是否成功
		if ($res) {
			$data = [
				'status' => 1,
				'msg' => '分类排序更新成功!'
			];
		} else {
			$data = [
				'status' => 0,
				'msg' => '分类排序更新失败，请稍候重试!'
			];			
		}
		
		return json_encode($data);		
	}

    /**
	 * get admin/category/create 添加分类 get
	 */ 
    public function create() {
    	$c = new Category();
        $data = $c->tree();
    	return view('admin.category.add')->with('data', $data);
    }

    /**
	 * get admin/category/{category} 显示单个分类信息
	 */
    public function show() {
    }

    /**
	 * delete admin/category/{category} 删除单个分类
	 */		
    public function destory() {
    }

    /**
	 * put admin/category/{category} 更新分类
	 */
    public function update() {
    	
    }

    /**
	 * get admin/category/{category}/edit 编辑分类
	 */
    public function edit() {	
    }
		
		
    // post admin/category 添加分类 post
    public function store() {
		$input = Input::all();
    }
		
}
