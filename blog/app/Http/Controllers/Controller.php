<?php

namespace App\Http\Controllers;

use App\Http\Model\Navs;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\View;

class Controller extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function __construct() {
        $data = Navs::orderBy('nav_order')->get();
		View::share('data', $data);
	}
}
