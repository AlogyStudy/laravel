<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {
    protected $primaryKey = 'art_id';
    protected $table = 'article';
    public $timestamps = false;
	
	protected $guarded = []; // 开启黑名单
//	protected $fillable = ['cate_id']; // 开启白名单
}
