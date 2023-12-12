<?php


use Carbon\Carbon;
use Illuminate\Support\Facades\Request;

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



function checkOrder($data){
    if ($data->getNextSibling()){
        echo '<span style="width: 50%" class="d-inline-block float-left pl-1 pr-1">
                <a href="'.route('category.move',['id' => $data->id,'type' => 'up']).'" class="btn btn-danger btn-sm btn-block"><i class="fas fa-arrow-down"></i></a>
            </span>';
    }
    if ($data->getPrevSibling()){
        echo '
            <span style="width: 50%" class="d-inline-block float-right pl-1 pr-1">
                <a href="'.route('category.move',['id' => $data->id,'type' => 'down']).'" class="btn btn-success btn-sm btn-block"><i class="fas fa-arrow-up"></i></a>
            </span>';
    }
    return false;
}

/* checkCategoryAndLink */
/* Cannot Be Changed */
function checkCategoryAndLink($data){
    if (!empty($data->category_id) or $data->category_id!=null){
        return '<div class="badge badge-info">Danh mục: '.$data->category->name.'</div>';
    }else{
        return '<div class="badge badge-warning">Đường dẫn: '.$data->link.'</div>';
    }
}