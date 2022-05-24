<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=[
        "title", 
        "author", 
        "content", 
        "image_url"
    ];
}
