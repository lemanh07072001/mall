<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\System\SystemUpload\SystemUpload;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    protected $table;

    public function __construct()
    {
        $this->table = new SystemUpload();
    }

    function store(Request $request){
        return $this->table->store($request);
    }
}
