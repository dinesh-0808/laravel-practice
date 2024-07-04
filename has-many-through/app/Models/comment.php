<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
    public function commentable(){
        return $this->morphTo();
    }

    protected $fillable = ['body'];
}