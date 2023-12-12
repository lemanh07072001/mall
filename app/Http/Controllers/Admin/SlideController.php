<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Slide\SlidePostRequest;
use App\System\SystemSlide\SystemSlide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    protected $table;

    public function __construct()
    {

        $this->table = new SystemSlide();
    }

    /* Hiện view danh sách dữ liệu */
    function index(Request $request)
    {

        $getAll = $this->table->getAll($request);
        return view('Admin.Slides.index',compact('getAll'));
    }

    /* Hiện view thêm dữ liệu */
    function create()
    {
        return view('Admin.Slides.create');
    }

    /* Xử lý thêm dữ liệu */
    function store(SlidePostRequest $request)
    {
        return $this->table->store($request);
    }

    /* Lấy 1 dữ liêu  */
    function edit($id)
    {
       $getFind = $this->table->edit($id);
        return view('Admin.Slides.edit' ,compact('getFind'));
    }

    /* Update dữ liệu */
    function update(SlidePostRequest $request , $id)
    {
        return $this->table->update($request , $id);
    }

    /* Xóa dữ liệu */
    function destroy($id){
        return $this->table->destroy($id);
    }
}
