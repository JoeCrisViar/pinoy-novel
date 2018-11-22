<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $fillable = ['title', 'cover_image'];


    public function posts()
    {
        return $this->hasMany('App\Model\user\post');
    }
}
