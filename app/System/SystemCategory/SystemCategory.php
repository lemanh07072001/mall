<?php


namespace App\System\SystemCategory;


use App\Models\Admin\Category;

class SystemCategory
{
    public function getAll($request){

        $filter = [];
        $keyword = '';

        if (!empty($request->status)){
            if ($request->status == 'active'){
                $status = 0;
            }else{
                $status = 1;
            }
           $filter[] = ['status','=',$status];
        }

        if (!empty($request->user_id)){
            $userId = $request->user_id;
            $filter[] = ['user_id','=',$userId];
        }
        $nodes = Category::withDepth()->with('user');

        if (!empty($request->table_search)){
            $keyword = $request->table_search;
            $nodes = $nodes->where(function ($query) use($keyword){
                $query->orWhere('name','like','%'.$keyword.'%');
            });
        }

        if (!empty($filter)){
            $nodes = $nodes->where($filter);
        }
        $nodes = $nodes->paginate(8)->withQueryString();;;
        return $nodes;
    }
}