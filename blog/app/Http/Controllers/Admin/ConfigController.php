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
		
		foreach($data as $k => $v) {
			switch ($v['conf_field_type']) {
				case 'input':
					$data[$k]->_html = '<input type="text" class="lg" name="conf_content[]" value="'. $v['conf_content'] .'" />';
				break;
				case 'textarea':
					$data[$k]->_html = '<textarea name="conf_content[]" row="20">'. $v['conf_content'] .'</textarea>';
				break;
				case 'radio':
					$arr = explode(',', $v->conf_field_value);
					$data[$k]->_html = '';
					foreach($arr as $m => $n){
						$r = explode('|', $n);
						$c = $v['conf_content'] == $r[0] ? 'checked' : '';
						$close_id = $v['conf_content'] == $r[0] ? 'close' : 'start';
						$data[$k]->_html .=  '<input type="radio" id="'.$close_id.'" '. $c .' name="conf_content[]" value="'. $r[0] .'" />' . '<label for="'.$close_id.'">'. $r[1] .'</label>';
					}
				break;				
			}
		}
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
            // 更新配置项内容
            $this->putFile();
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
            // 更新配置项内容
            $this->putFile();
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
        ];

        // 提示信息
        $msg = [
            'conf_name.required' => '配置项名称不能为空',
            'conf_title.required' => '配置项标题不能为空',
        ];

        $validator = Validator::make($input, $rules, $msg);

        // 检验表单数据
        if ($validator->passes()) {
            $res = Config::create($input);
            // 判断添加是否成功
            if (!$res) {
                return back()->with('errors', '添加失败');
            } else {
                // 更新配置项内容
                $this->putFile();
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
	
	/**
	 * 更改网站配置内容
	 */
	public function changeContent() {
		$input = Input::all();
		$count = 0;
		foreach($input['conf_id'] as $k => $v){
			$count += Config::where('conf_id', $v)->update(['conf_content' => $input['conf_content'][$k]]);
		}



		// 是否更新成功
		if ($count > 0) {
		    // 更新配置项内容
            $this->putFile();
			return back()->with('errors', '配置项更新成功');
		} else {
			return back()->with('errors', '配置项更新失败');
		}
		
	}
	
	/**
	 * 生成配置项文件
	 */
	public function putFile() {
	    // echo \Illuminate\Support\Facades\Config::get('webConf.web_title'); // 拿取配置项信息
		// 拿取文件
		$config = Config::pluck('conf_content', 'conf_name')->all(); // 过滤要的字段及信息
        $path = base_path() . '\config\webConf.php';

        // 重组数据 ，写入配置文件
        $str = '<?php return ' . var_export($config, true) . ';';
        // 写入配置文件
        file_put_contents($path, $str);
		
	}

}

