<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {
    protected $primaryKey = 'art_id';
    protected $table = 'article';
    public $timestamps = false;
}
