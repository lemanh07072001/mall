<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slide extends Model
{
    use HasFactory ,SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'status',
        'description',
        'user_id',
        'category_id',
        'link',
    ];

    function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
