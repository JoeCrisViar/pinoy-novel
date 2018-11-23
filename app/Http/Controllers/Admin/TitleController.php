<?php

namespace App\Http\Controllers\Admin;

use App\Model\admin\Title;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\post;
use App\Model\user\tag;
use App\Model\user\category;
use Illuminate\Support\Facades\Auth;

class TitleController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titles = Title::all();
        $posts = post::all();

        //for sidebar count
        
        $publish = post::where('status', 1)->count();
        $forpublish = post::where('status', 0)->count();
        $forediting = post::where('status', null)->count();
        $categories = category::all();

        return view('admin.post.title.index', compact('titles', 'posts', 'publish', 'forpublish', 'forediting', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titles = Title::all();
        
        //NOTE: for multiple selection form
        $tags = tag::all();

        //NOTE: for multiple selection form
        $categories = category::all();

        //for sidebar count
        $posts = post::all();

        //for sidebar count
        $publish = post::where('status', 1)->count();
        $forpublish = post::where('status', 0)->count();
        $forediting = post::where('status', null)->count();

        return view('admin.post.title.create', compact('titles','tags', 'categories', 'posts', 'publish', 'forpublish', 'forediting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',        
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
          ]);

          if($request->hasFile('cover_image'))
            {
                $path =  $request->cover_image->store('public');
            }
        
        //NOTE: save form requests to db
        $title = new Title;
        $title->cover_image = $path;
        $title->fill($request->all())->save();
        
        return redirect(route('title.index'))->with('success', 'Title Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function show(Title $title)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function edit(Title $title)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Title $title)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function destroy(Title $title)
    {
        //
    }

    public function chapter($id)
    {
        $title = Title::where('id', $id)->get();
        $chapters = post::where('title_id', $id)->get();
        $posts = post::all();
         //for sidebar count
         $publish = post::where('status', 1)->count();
         $forpublish = post::where('status', 0)->count();
         $forediting = post::where('status', null)->count();
         $categories = category::all();

        return view('admin.post.title.chapters', compact('title', 'chapters', 'posts', 'publish', 'forpublish', 'forediting', 'categories'));
    }
}
