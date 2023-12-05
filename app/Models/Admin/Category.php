<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use HasFactory ;
    use NodeTrait;

    protected $table = 'categorys';

    function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
