<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use YuanChao\Editor\EndaEditor;

class UploadFileController extends CommonController {
    public function postImg() {
        $data = EndaEditor::uploadImgFile('uploads');
        return json_encode($data);
    }
}
