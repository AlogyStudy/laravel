<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

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
    public function destroy($cate_id) {
    	$res = Category::where('cate_id', $cate_id)->delete();
		
		// 处理顶级分类
		Category::where('cate_pid', $cate_id)->update(['cate_pid' => 0]);
		
		if (!$res) {
			// 删除失败
			$data = [
				'status' => 0,
				'msg' => '分类删除失败'
			];
			return json_encode($data);
		} else {
			// 删除成功
			$data = [
				'status' => 1,
				'msg' => '分类删除成功'
			];
			return json_encode($data);
		}
    }
	

    /**
     * put admin/category/{category} 更新分类
     */
    public function update($cate_id) {
    	$input = Input::except('_token', '_method');
		$res = Category::where('cate_id', $cate_id)->update($input);
		
		if (!$res) {
			// 更新数据失败
			return back()->with('errors', '添加失败');				
		} else {
			// 更新数据成功
			return redirect('admin/category');
		}
    }

    /**
     * get admin/category/{category}/edit 编辑分类
     */
    public function edit($cate_id) {
		$field = Category::find($cate_id);
		$data = Category::where('cate_pid', 0)->get();
    	return view('admin.category.edit', compact('field', 'data'));
    }


    // post admin/category 添加分类 post
    public function store() {
        $input = Input::except('_token'); // 不需要使用某些方法
        
        // 验证规则
        $rules = [
            'cate_name' => 'required',
            'cate_title' => 'required',
            'cate_order' => 'required'
        ];

        // 提示信息
        $msg = [
            'cate_name.required' => '分类名称不能为空',
            'cate_title.required' => '分类标题不能为空',
            'cate_order.required' => '排序不能为空'
        ];

        $validator = Validator::make($input, $rules, $msg);
		
		// 检验表单数据	
     	if ($validator->passes()) {
			$res = Category::create($input);
			// 判断添加是否成功
			if (!$res) {
				return back()->with('errors', '添加失败');				
			} else {
				return redirect('admin/category');
			}
		} else {
			return back()->withErrors($validator);
		}

    }

}
