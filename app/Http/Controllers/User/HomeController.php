<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\post;
use App\Model\user\category;
use App\Model\user\tag;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $posts = post::where('status', 1)->orderBy('created_at', 'desc')->paginate(5);
        
        if ($request->ajax()) 
        {
            return view('user.paginate', compact('posts'));
        }

        return view('user.blog', compact('posts'));
    }

    public function tag(tag $tag, Request $request)
    {
        $posts = $tag->posts();

        if ($request->ajax()) 
        {
            return view('user.paginate', compact('posts'));
        }

        return view('user.blog', compact('posts'));
    }

    public function category(category $category, Request $request)
    {
        
        $posts = $category->posts();

        if ($request->ajax()) 
        {
            return view('user.paginate', compact('posts'));
        }

        return view('user.blog', compact('posts'));
    }
}
