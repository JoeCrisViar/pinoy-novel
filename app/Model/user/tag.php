<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    protected $fillable =['name', 'slug'];

    public function posts()
    {
        return $this->belongsToMany('App\Model\user\post', 'post_tags')->orderBy('created_at','desc')->paginate(5);
    }

    //for user to get post (LARAVEL BUILT IN FUNCTION)
    public function getRouteKeyName()
    {
        return 'slug'; //'slug' = column name in posts table
    }
}
