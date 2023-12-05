<?php


namespace App\Helper;


use App\Models\Admin\User;

class FormatFunction
{
    public static function getUser(){
          $data = User::select('id','name')->get();
          return $data;
    }
}