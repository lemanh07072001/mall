<?php


namespace App\Helper;


use App\Models\Admin\Category;
use App\Models\Admin\User;

class FormatFunction
{
    public static function getUser()
    {
        $data = User::select('id' , 'name')->get();
        return $data;
    }

    public static function getCategory($data = null)
    {
        $data = Category::withDepth();
        if (!empty($dataItem)) {
            $data = $data->where('_lft' , '<' , $dataItem->_lft)->orWhere('_rgt' , '>' , $dataItem->_rgt)->get();

        } else {
            $data = $data->get()->toFlatTree();
        }

        return $data;
    }

}
