<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $primaryKey = 'user_id';
    protected $table = 'user';
    public $timestamps = false;
}
