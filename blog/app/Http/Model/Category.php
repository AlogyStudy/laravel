<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
	protected $table = 'category';
    protected $primaryKey = 'cate_id';
    public $timestamps = false;

	/**
	 * @return 模型中处理的数据
	 */
	public function tree() {
        $categorys = $this->all();
		$data = $this->getCateTree($categorys);
		return $data;
	}

	/**
	 * 家谱树
	 * @param {Object} $data 传入所有数据
	 * @param {String} $field_name  字符串 
	 * @param {String} $field_id  cate_id 字段 
	 * @param {String} $field_pid  cate_pid 字段  
	 * @param {Int} $pid 顶级分类id
	 * @return {Array} 相联系的数据
	 */
	public function getTree($data, $field_name = '-- ', $field_id = 'cate_id', $field_pid = 'cate_pid', $pid = 0) {
		
		// 存放处理后数据
		$arr = array();
		
		/**
		 * 1. 遍历 pid为0 (顶级目录) ， 压入数组
		 * 
		 * 2. pid 不为0 的，对比pid，压入数组后续中. 
		 */
		
		foreach($data as $k => $v) {
			if ($v[$field_pid] == $pid) {
				$arr[] = $data[$k];
				foreach($data as $m => $n) {
					// 对比 $v[cate_id] 和 $data[cate_pid] 对比
					if ( $n[$field_pid] == $v[$field_id] ) {
						$data[$m]['_cate_name'] = $field_name; 
						$arr[] = $data[$m];						
					}
				}
			}
		}
		return $arr;
	}	

	/**
	 * 查询Cate子孙树 
	 * @param {Array} $arr 查询的所有数据 
	 * @param {Int} $id 
	 * @return {Array} $id栏目一下的子孙树
	 */
	public function getCateTree( $arr, $id = 0, $lev = 0 ) {
		$tree = array();
		foreach ( $arr as $v ) {
			if ( $v['cate_pid'] == $id ) {
				$v['lev'] = $lev;
				$tree[] = $v;
				$tree = array_merge($tree, $this->getCateTree($arr, $v['cate_id'], $lev+1 ) );	
			}
		}			
		return $tree;
	}

}

