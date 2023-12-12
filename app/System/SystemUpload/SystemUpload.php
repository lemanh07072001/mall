<?php


namespace App\System\SystemUpload;


class SystemUpload
{
    public function store($request){

        if($request->hasFile('file')){

            $image = $request->file('file');
            $file = $image->getClientOriginalName(); // Tạo tên mới cho tệp
            $path = $image->storeAs('photos', $file, 'public');
            $link = '/storage/'.$path;
            return response()->json([
                'status' => 200,
                'url' => $link
            ]);
        }

        return response()->json([
            'status' => 404,
            'url' => 'Lỗi không thể upload ảnh'
        ]);
    }
}