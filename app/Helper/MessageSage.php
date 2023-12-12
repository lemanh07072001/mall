<?php


namespace App\Helper;


class MessageSage
{
    public static function Message($name=''){

        $data = [
            'add' => 'Bạn đã thêm dữ liệu thành công!',
            'edit' => 'Bạn cập nhật thành công!',
            'delete' => 'Xóa thành công!',
            'undo' => 'Khôi phục thành công!',
            'error' => 'Lỗi hệ thống vui lòng thử lại sau'
        ];

        foreach ($data as $key => $item){
            if ($key == $name) {
                return $item;
            }
        }
        return 'Không tìm thấy key';
    }

    public static function RedirectRoute($request=null,$route=null){

        if (!empty($route) && !empty($request)){

            if ($request->has('preview') && $request->input('preview') === 'on'){

                return redirect()->route($route);
            }else{
                return redirect()->back();
            }
        }
        return redirect()->back();
    }

    public static function NotificationStatus($type='alert',$status='success',$name){
        if (!empty($type) && $type== 'alert'){
            if (!empty($name)){
                if ($status == 'success'){
                    return alert('Thành công!',self::Message($name), $status);
                }else if ($status == 'error'){
                    return alert('Thất bại!',self::Message($name), $status);
                }else if ($status == 'warning'){
                    return alert('Cảnh báo!',self::Message($name), $status);
                }
            }
        }else if (!empty($type) && $type== 'toast'){
            return toast(self::Message($name),$status);
        }
    }

    public static function confirmDelete($softDelete=true){
        $title = "Bạn xác nhận muốn xóa!";
        if ($softDelete==true){
            $text = "Bạn muốn khôi phục => ( Khôi phục )";
        }else{
            $text = "Xóa không thể khôi phục lại được";
        }
        confirmDelete($title, $text);
    }
}