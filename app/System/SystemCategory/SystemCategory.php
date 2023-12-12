<?php


namespace App\System\SystemCategory;


use App\Models\Admin\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Monolog\Handler\IFTTTHandler;
use RealRashid\SweetAlert\Facades\Alert;
use App\Helper\MessageSage;

class SystemCategory
{
    public function getAll($request){
        MessageSage::confirmDelete(false);
        $filter = [];

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
        $nodes = Category::withDepth()->with(['user','parent']);

        if (!empty($request->table_search)){
            $keyword = $request->table_search;
            $nodes = $nodes->where(function ($query) use($keyword){
                $query->orWhere('name','like','%'.$keyword.'%');
            });
        }

        if (!empty($filter)){
            $nodes = $nodes->where($filter);
        }
        $nodes = $nodes->defaultOrder()->get()->toFlatTree();

        return $nodes;
    }

    public function move($request){

        $id = $request->id;
        $type = $request->type;

        $node = Category::find($id);

        if ($type == 'up'){
            $node->down();
        }else{
            $node->up();

        }

        return redirect()->back();
    }

    public function store($request){

        if ($request->status == null){
            $status = 1;
        }else{
            $status = 0;
        }
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
            'status' => $status,
            'user_id' => Auth::id(),
            'created_at' => date("Y-m-d H:i:s")
        ];

        if (!empty($request->parent_id == 'NULL')){
            $category = Category::create($data);
            $dataSatus = $category->saveAsRoot();

        }else{
            $id = Category::findOrFail($request->parent_id);
            $dataSatus = Category::create($data, $id);
        }
        if ($dataSatus){
            Alert::success("Thành công!!",MessageSage::Message('add'));
            if ($request->preview == null){
                return redirect()->back();
            }else{
                return redirect()->route('category.index');
            }
        }
    }

    public function destroy($id){


        $getFind = Category::findOrFail($id);

        $dataStatus = $getFind->delete();
        if ($dataStatus){
            MessageSage::NotificationStatus('toast','success','delete');
            return MessageSage::RedirectRoute();
        }else{
            MessageSage::NotificationStatus('alert','error','error');
            MessageSage::RedirectRoute();
        }
    }

    public function edit($id){
        $getFind = Category::findOrFail($id);
        return $getFind;
    }

    public function update($request ,$id){
        if ($request->status == null){
            $status = 1;
        }else{
            $status = 0;
        }
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
            'status' => $status,
            'user_id' => Auth::id(),
            'updated_at' => date("Y-m-d H:i:s")
        ];


        $node = Category::findOrFail($id);
        $getStatus = $status;

        $dataChildren = $node->descendants;
        foreach ($dataChildren as $item){
            $item->update(['status' => $getStatus]);
        }

        $dataSatus =$node->update($data);
        if ($node->parent_id != $request->parent_id){
            if ($request->parent_id=='NULL'){

                $dataSatus = $node->saveAsRoot();
            }else{
                $paren = Category::findOrFail($request->parent_id);
                $dataSatus = $node->prependToNode($paren)->save();
            }

        }
        if ($dataSatus){
            Alert::success("Thành công!!",MessageSage::Message('edit'));
            if ($request->preview == null){
                return redirect()->back();
            }else{
                return redirect()->route('category.index');
            }
        }
    return false;
    }

    public function addAjax($request){
        $id = null;
        if (!empty($request->parent_id) && $request->parent_id!='NULL'){
            $id = Category::findOrFail($request->parent_id);
        }
        if (!empty($id->status) && $id->status !=''){
            $status= 0;
        }else{
            $status = 1;
        }

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
            'status' => $status,
            'user_id' => Auth::id(),
            'created_at' => date("Y-m-d H:i:s")
        ];

        if (!empty($request->parent_id == 'NULL')){
            $category = Category::create($data);
            $dataSatus = $category->saveAsRoot();

        }else{

            $dataSatus = Category::create($data, $id);

        }
        if ($dataSatus){
            return response()->json([
                'status' => 200,
                'message' => MessageSage::Message('add'),
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => MessageSage::Message('error'),
            ]);
        }
    }


}

