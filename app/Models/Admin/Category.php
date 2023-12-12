<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\DB;
use Kalnoy\Nestedset\NodeTrait;


class Category extends Model
{
    use HasFactory ;
    use NodeTrait;

    protected $table = 'categorys';

    protected $fillable = [
        'name',
        'status',
        'user_id',
        'slug'
    ];

    function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function slide()
    {
        return $this->hasOne(Slide::class);
    }
}
