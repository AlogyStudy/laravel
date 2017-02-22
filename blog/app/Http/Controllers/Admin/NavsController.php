<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends CommonController {
    /**
     * get admin/navs 全部自定义导航
     */
    public function index() {
        $data = Navs::orderBy('nav_order', 'asc')->get();
        return view('admin.navs.index', compact('data'));
    }

    /**
     * get admin/navs/create 添加自定义导航
     */
    public function create() {
        return view('admin.navs.add');
    }

    /**
     * get admin/category/{category} 显示单个分类信息
     */
    public function show() {

    }

    /**
     * delete admin/navs/{navs} 删除单个自定义导航
     */
    public function destroy($nav_id) {
        $res = Navs::where('nav_id', $nav_id)->delete();
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
     * put admin/navs/{navs} 更新自定义导航
     */
    public function update($nav_id) {
        $input = Input::except('_token', '_method');
        $res = Navs::where('nav_id', (int)$nav_id)->update($input);
		
        if ($res) {
            // 更新成功
            return redirect('admin/navs');
        } else {
            // 更新失败
            return back()->with('errors', '更新自定义导航失败');
        }

    }

    /**
     * get admin/navs/{navs}/edit 编辑自定义导航
     */
    public function edit($nav_id) {
        $field = Navs::find($nav_id);
        return view('admin.navs.edit', compact('field'));
    }


    /**
     * post admin/navs 添加自定义导航
     */
    public function store() {
        $input = Input::except('_token'); // 不需要使用某些方法
        
        // 验证规则
        $rules = [
            'nav_name' => 'required',
            'nav_alias' => 'required',
            'nav_url' => 'required'
        ];

        // 提示信息
        $msg = [
            'nav_name.required' => '自定义导航名称不能为空',
            'nav_alias.required' => '自定义导航标题不能为空',
            'nav_url.required' => '自定义导航Url不能为空'
        ];

        $validator = Validator::make($input, $rules, $msg);

        // 检验表单数据
        if ($validator->passes()) {
            $res = Navs::create($input);
            // 判断添加是否成功
            if (!$res) {
                return back()->with('errors', '添加失败');
            } else {
                return redirect('admin/navs');
            }
        } else {
            return back()->withErrors($validator);
        }
    }

    /**
     * 更改排序
     * changeorder
     */
    public function changeOrder() {
        $input = Input::all();
        $nav = Navs::find($input['nav_id']);
        $nav->nav_order = $input['nav_order'];
        $res = $nav->update();

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

}
