<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends CommonController {
    /**
     * get admin/config 全部配置项列表  
     */
    public function index() {
        $data = Config::orderBy('conf_order', 'asc')->get();
        return view('admin.configs.index', compact('data'));
    }

    /**
     * get admin/configs/create 添加配置项
     */
    public function create() {
        return view('admin.configs.add');
    }

    /**
     * get admin/category/{category} 显示单个配置项
     */
    public function show() {

    }

    /**
     * delete admin/configs/{configs} 删除单个配置项
     */
    public function destroy($conf_id) {
        $res = Config::where('conf_id', $conf_id)->delete();
        if (!$res) {
            // 删除失败
            $data = [
                'status' => 0,
                'msg' => '配置项删除失败'
            ];
            return json_encode($data);
        } else {
            // 删除成功
            $data = [
                'status' => 1,
                'msg' => '配置项删除成功'
            ];
            return json_encode($data);
        }
    }


    /**
     * put admin/configs/{configs} 更新配置项
     */
    public function update($conf_id) {
        $input = Input::except('_token', '_method');
        $res = Config::where('conf_id', $conf_id)->update($input);
        if ($res) {
            // 更新成功
            return redirect('admin/configs');
        } else {
            // 更新失败
            return back()->with('errors', '更新配置项失败');
        }

    }

    /**
     * get admin/configs/{configs}/edit 编辑配置项
     */
    public function edit($conf_id) {
        $field = Config::find($conf_id);
        return view('admin.configs.edit', compact('field'));
    }


    /**
     * post admin/configs 添加配置项
     */
    public function store() {
        $input = Input::except('_token'); // 不需要使用某些方法

        // 验证规则
        $rules = [
            'conf_name' => 'required',
            'conf_title' => 'required',
            'conf_url' => 'required'
        ];

        // 提示信息
        $msg = [
            'conf_name.required' => '配置项名称不能为空',
            'conf_title.required' => '配置项标题不能为空',
            'conf_url.required' => '配置项Url不能为空'
        ];

        $validator = Validator::make($input, $rules, $msg);

        // 检验表单数据
        if ($validator->passes()) {
            $res = Config::create($input);
            // 判断添加是否成功
            if (!$res) {
                return back()->with('errors', '添加失败');
            } else {
                return redirect('admin/configs');
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
        $config = Config::find($input['conf_id']);
        $config->conf_order = $input['conf_order'];
        $res = $config->update();

        // 执行是否成功
        if ($res) {
            $data = [
                'status' => 1,
                'msg' => '配置项排序更新成功!'
            ];
        } else {
            $data = [
                'status' => 0,
                'msg' => '配置项排序更新失败，请稍候重试!'
            ];
        }

        return json_encode($data);
    }

}
