<?php

namespace App\Models;
use App\Models\comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class video extends Model
{
    use HasFactory;

    public function comments(){
        return $this->morphMany(Comment::class,"commentable");
    }
}