<?php


use Carbon\Carbon;

function FormatStatus($data){
    if (isset($data)){
        if ($data == '0'){
            return '<div class="badge badge-success">Kích hoạt</div>';
        }else{
            return '<div class="badge badge-danger">Không kích hoạt</div>';
        }
    }

    return false;
}

function FormatTime($data){
    if (isset($data)){
        $da = Carbon::createFromFormat('Y-m-d H:i:s', $data)->format('m/d/Y');
        return $da;
    }
    return  false;
}

function checkParent($item){
    if (!empty($item->parent->name)){
        return '<span class="badge badge-success ml-2">Danh mục cha: '.$item->parent->name.'</span>';
    }

    return false;

}