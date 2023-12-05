<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\System\SystemCategory\SystemCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $table;
    public function __construct()
    {
        $this->table = new SystemCategory();
    }

    function index(Request $request){
        $getAll = $this->table->getAll($request);

        return view('Admin.Categorys.index',compact('getAll'));
    }
}
