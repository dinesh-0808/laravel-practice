<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
     
    public function scopeLatest($query)
    {
        return $query->where('user_id',1)->orderBy('id','asc')->get();
    }

    public function getPathAttribute($value){
        return "/images/".$value;
    }
}
