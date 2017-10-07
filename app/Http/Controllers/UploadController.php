<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request) {

        if (!$request->hasFile('fileList')) {
            return ['status'=>400, 'msg'=>'fileList未上传'];//
        }

        $file = $request->file('fileList');

        return ['status'=>200, 'msg'=>$file->store('images')];//移动
    }
}
