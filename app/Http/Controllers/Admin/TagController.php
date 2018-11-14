<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\tag;
use App\Model\user\post;

class TagController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        
        //Restrics admin user to jump access TAG menu thru URL if not permitted
        $this->middleware('can:posts.tag');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = tag::all();

        //for sidebar count

        $posts = post::all();
        $publish = post::where('status', 1)->count();
        $forpublish = post::where('status', 0)->count();
        $forediting = post::where('status', null)->count();

        return view('admin.tag.index',compact('tags', 'posts', 'publish', 'forpublish', 'forediting'));//->with('tags', $tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //for sidebar count

        $posts = post::all();
        $publish = post::where('status', 1)->count();
        $forpublish = post::where('status', 0)->count();
        $forediting = post::where('status', null)->count();

        return view('admin.tag.create',compact('posts', 'publish', 'forpublish', 'forediting'));
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
            'name' => 'required',
            'slug' => 'required'
          ]);

          $tag = new tag;
          $tag->create($request->all());

          return redirect(route('tag.create'))->with('success', 'Tag Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $tag = tag::where('id', $id)->first();

        //for sidebar count

        $posts = post::all();
        $publish = post::where('status', 1)->count();
        $forpublish = post::where('status', 0)->count();
        $forediting = post::where('status', null)->count();

        return view('admin.tag.edit', compact('tag', 'posts', 'publish', 'forpublish', 'forediting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required'
          ]);
        
          $tag = tag::find($id);
          $tag->fill($request->all())->save();

          return redirect(route('tag.index'))->with('success', 'Tag Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        tag::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Tag Deleted');
    }
}
