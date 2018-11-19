<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\user\post;
use App\Model\user\category;
use App\Model\user\tag;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {

        $posts = post::all();

        $publish = post::where('status', 1)->count();
        $forpublish = post::where('status', 0)->count();
        $forediting = post::where('status', null)->count();
        $categories = category::all();

        return view('admin.home', compact('posts', 'publish', 'forpublish', 'forediting', 'categories'));
    }

}
