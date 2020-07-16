<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Response;
use Storage;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $url = $this->valid($request->file('file'));
        return Response::json(compact('url'));
    }

    protected function valid($file)
    {
        // 1.是否上传成功
        if (! $file->isValid()) {
            throw new Exception('上传失败', 400);
        }

        // 2.是否符合文件类型 getClientOriginalExtension 获得文件后缀名
        $fileExtension = $file->getClientOriginalExtension();
        if(! in_array($fileExtension, ['png', 'jpg'])) {
            throw new Exception('文件类型不符', 400);
        }

        // 3.判断大小是否符合 1M
        $tmpFile = $file->getRealPath();
        if (filesize($tmpFile) >= 1024000) {
            throw new Exception('文件过大', 400);
        }

        // 4.是否是通过http请求表单提交的文件
        if (! is_uploaded_file($tmpFile)) {
            throw new Exception('未知错误', 400);
        }

        // 5.每天一个文件夹,分开存储, 生成一个随机文件名
        $fileName = date('Y_m_d').'/'.md5(time()) .mt_rand(0,9999).'.'. $fileExtension;
        if (Storage::disk('public')->put($fileName, file_get_contents($tmpFile)) ){
            return Storage::url($fileName);
        }
    }
}
