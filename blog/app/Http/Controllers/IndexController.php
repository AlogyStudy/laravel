<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;

class IndexController extends Controller{
	
    //
    public function index() {
    	echo 123;
    }
		
		public function test() {
			$pdo = DB::connection()->getPdo();
			dd($pdo);
		}
		
}
