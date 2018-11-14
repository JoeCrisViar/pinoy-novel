<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    public $table = 'posts';
    
    protected $fillable =['title', 'subtitle', 'slug', 'body','status'];

    public function tags()
    {
        return $this->belongsToMany('App\Model\user\tag', 'post_tags')->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany('App\Model\user\category', 'category_posts')->withTimestamps();
    }

    //for user to get post (LARAVEL BUILT IN FUNCTION)
    public function getRouteKeyName()
    {
        return 'slug'; //'slug' = column name in posts table
    }
}
