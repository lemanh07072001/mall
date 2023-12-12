<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryPostRequest;
use App\System\SystemCategory\SystemCategory;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class CategoryController extends Controller
{
    protected $table;

    public function __construct()
    {
        $this->table = new SystemCategory();
    }

    /* Hiện view danh sách dữ liệu */
    function index(Request $request)
    {
        $getAll = $this->table->getAll($request);

        return view('Admin.Categorys.index' , compact('getAll'));
    }

    /* Xử lý di chuyển dữ liệu */
    function move(Request $request)
    {
        return $this->table->move($request);
    }

    /* Hiện view thêm dữ liệu */
    public function create()
    {
        return view('Admin.Categorys.create');
    }

    /* Xử lý thêm dữ liệu */
    function store(CategoryPostRequest $request)
    {
        return $this->table->store($request);
    }

    /* Xóa dữ liệu */
    function destroy($id)
    {
        return $this->table->destroy($id);
    }

    /* Lấy 1 dữ liêu  */
    function edit($id)
    {
        $getFind = $this->table->edit($id);
        return view('Admin.Categorys.edit' , compact('getFind'));
    }

    /* Update dữ liệu */
    function update(CategoryPostRequest $request , $id)
    {
        return $this->table->update($request , $id);
    }

    /* Add dữ liệu ajax */
    function addAjax(CategoryPostRequest $request)
    {
        return $this->table->addAjax($request);
    }

}
