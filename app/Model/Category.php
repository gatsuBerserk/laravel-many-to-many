<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=[
        "name", 
        "color"
    ];

    public function posts(){
        return $this->belongsToMany("App\Model\Post");
    }
}
