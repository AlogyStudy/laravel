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
     * delete admin/links/{links} 删除单个友情链接
     */
    public function destroy($link_id) {
        $res = Links::where('link_id', $link_id)->delete();
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
     * put admin/links/{links} 更新分类
     */
    public function update($link_id) {
	    $input = Input::except('_token', '_method');
	    $res = Links::where('link_id', $link_id)->update($input);
	    if ($res) {
	        // 更新成功
            return redirect('admin/links');
        } else {
            // 更新失败
            return back()->with('errors', '更新友情链接失败');
        }

    }

    /**
     * get admin/links/{links}/edit 编辑友情链接
     */
    public function edit($link_id) {
        $field = Links::find($link_id);
        return view('admin.links.edit', compact('field'));
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
