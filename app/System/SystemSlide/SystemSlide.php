<?php


namespace App\System\SystemSlide;


use App\Helper\MessageSage;
use App\Models\Admin\Category;
use App\Models\Admin\Slide;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class SystemSlide
{
    public function getAll($request){
        MessageSage::confirmDelete(true);
        $filter = [];

        if (!empty($request->status)){
            if ($request->status == 'active'){
                $status = 0;
            }else{
                $status = 1;
            }
            $filter[] = ['status','=',$status];
        }

        if (!empty($request->arrange)){
            $arrange = $request->arrange;
        }

        if (!empty($request->user_id)){
            $userId = $request->user_id;
            $filter[] = ['user_id','=',$userId];
        }
        $data = Slide::with(['user','category']);

        if (!empty($request->table_search)){
            $keyword = $request->table_search;
            $data = $data->where(function ($query) use($keyword){
                $query->orWhere('name','like','%'.$keyword.'%');
            });
        }

        if (!empty($filter)){
            $data = $data->where($filter);
        }

        if(!empty($request->arrange)){
            $data = $data->orderBy('created_at',$request->arrange);
        }else{
            $data = $data->orderBy('created_at','DESC');
        }

        $data = $data->paginate(3)->withQueryString();
        return $data;
    }

    public function store($request){
        $urlParts = parse_url($request->image);

        $urlPtah = isset($urlParts['path']) ? $urlParts['path'] : '';

        $status = ($request->status == 'on')?$status=0:$status=1;


        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $urlPtah,
            'status' => $status,
            'description' =>$request->description,
            'user_id' => Auth::id(),
            'created_at' => date("Y-m-d H:i:s")
        ];

        if ($request->link == null){
            $data['category_id'] = $request->parent_id;

        }else{
            $data['link'] = $request->link;
        }

        $dataStatus = Slide::create($data);
        if ($dataStatus){
            MessageSage::NotificationStatus('alert','success','add');
            return MessageSage::RedirectRoute($request,'slide.index');
        }else{
            MessageSage::NotificationStatus('alert','error','error');
            MessageSage::RedirectRoute();
        }
    }

    public function edit($id){
        return Slide::findOrFail($id);
    }

    public function update($request,$id){
        $urlParts = parse_url($request->image);

        $urlPtah = isset($urlParts['path']) ? $urlParts['path'] : '';

        $status = ($request->status == 'on')?$status=0:$status=1;


        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $urlPtah,
            'status' => $status,
            'description' =>$request->description,
            'user_id' => Auth::id(),
            'created_at' => date("Y-m-d H:i:s")
        ];
        if ($request->link == null){
            $data['category_id'] = $request->parent_id;
            $data['link'] = null;
        }else{
            $data['link'] = $request->link;
            $data['category_id'] = null;
        }
        $dataStatus = Slide::where('id',$id)->update($data);
        if ($dataStatus){
            MessageSage::NotificationStatus('alert','success','edit');
            return MessageSage::RedirectRoute($request,'slide.index');
        }else{
            MessageSage::NotificationStatus('alert','error','error');
            MessageSage::RedirectRoute();
        }
    }

    public function destroy($id){
        $dataStatus = Slide::where('id',$id)->delete();
        if ($dataStatus){
            MessageSage::NotificationStatus('toast','success','delete');
            return MessageSage::RedirectRoute();
        }else{
            MessageSage::NotificationStatus('toast','error','error');
            return MessageSage::RedirectRoute();
        }
    }
}