<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends CommonController {

    /**
	 * get admin/category 全部分类列表
	 */
    public function index() {
    	$c = new Category();
        $data = $c->tree();
		return view('admin.category.index')->with('data', $data);
    }

    // post admin/category
    public function store() {
    }

    /**
	 * get admin/category/create 添加分类
	 */ 
    public function create() {
    		
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

		
}
