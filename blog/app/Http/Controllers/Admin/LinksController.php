<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends CommonController {
    /**
     * get admin/links 全部列表
     */
    public function index() {
        $data = Links::orderBy('link_order', 'asc')->get();
        return view('admin.links.index', compact('data'));
    }

    /**
     * get admin/links/create 添加友情链接
     */
    public function create() {
        return view('admin.links.add');
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

    }


    /**
     * put admin/category/{category} 更新分类
     */
    public function update($cate_id) {

    }

    /**
     * get admin/category/{category}/edit 编辑友情链接
     */
    public function edit($cate_id) {
        return view('admin.links.edit');
    }


    /**
     * post admin/links 添加友情链接
     */
    public function store() {
        $input = Input::except('_token'); // 不需要使用某些方法

        // 验证规则
        $rules = [
            'link_name' => 'required',
            'link_title' => 'required',
            'link_url' => 'required'
        ];

        // 提示信息
        $msg = [
            'link_name.required' => '友情链接名称不能为空',
            'link_title.required' => '友情链接标题不能为空',
            'link_url.required' => '友情链接Url不能为空'
        ];

        $validator = Validator::make($input, $rules, $msg);

        // 检验表单数据
        if ($validator->passes()) {
            $res = Links::create($input);
            // 判断添加是否成功
            if (!$res) {
                return back()->with('errors', '添加失败');
            } else {
                return redirect('admin/links');
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
        $link = Links::find($input['link_id']);
        $link->link_order = $input['link_order'];
        $res = $link->update();

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
