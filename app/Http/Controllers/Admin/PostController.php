<?php
// ep32 16:30
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\post;
use App\Model\user\tag;
use App\Model\user\category;
use App\Model\admin\Title;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
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
        $posts = post::all();

        //for sidebar count
        
        $publish = post::where('status', 1)->count();
        $forpublish = post::where('status', 0)->count();
        $forediting = post::where('status', null)->count();
        $categories = category::all();
        
        return view('admin.post.index', compact('posts', 'publish', 'forpublish', 'forediting', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Restricts Admin users to access create module if not permitted to
        if (Auth::user()->can('posts.create')) {

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

            return view('admin.post.create', compact('titles','tags', 'categories', 'posts', 'publish', 'forpublish', 'forediting'));
        }

        return redirect(route('admin.home'));
        
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
            'title_id' => 'required',
            'subtitle' => 'required',
            'slug' => 'required',
            'body' => 'required',
          ]);

        //NOTE: save form requests to db
          $post = new post;
          $post->fill($request->all())->save();
            
            //NOTE:$request->tags = ('tags' name of input form) 
            //NOTE: tags() = model's relationship function name 
          $post->tags()->sync($request->tags);
          $post->categories()->sync($request->categories);

          return redirect(route('post.index'))->with('success', 'Post Created');
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
    public function edit($id, category $category)
    {
        //Restricts Admin users to access EDIT/UPDATE module if not permitted to
        if (Auth::user()->can('posts.update')) {

            //NOTE: for multiple selection form
            $titles = Title::all();
            //NOTE: for multiple selection form
            $tags = tag::all();
            //NOTE: for multiple selection form
            $categories = category::all();

            //NOTE: with('tags', 'categories') are model function names
            $post = post::with('tags', 'categories', 'title')->where('id', $id)->first();

            //for sidebar count
            $posts = post::all();
            $publish = post::where('status', 1)->count();
            $forpublish = post::where('status', 0)->count();
            $forediting = post::where('status', null)->count();
            $categories = category::all();
            

            return view('admin.post.edit', compact('titles','tags','categories','post', 'posts', 'publish', 'forpublish', 'forediting', 'genres', 'categories'));
        }
        
        return redirect(route('admin.home'));
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
            'title' => 'required',
            'subtitle' => 'required',
            'slug' => 'required',
            'body' => 'required',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
          ]);
        
          if($request->hasFile('cover_image'))
          {
              $path =  $request->cover_image->store('public');
          }

        //Updating post in posts table 
        $post = post::find($id);
        $post->cover_image = $path;
        $post->status = 0;
        $post->fill($request->all())->save();

            //NOTE:$request->tags = ('tags' name of input form) 
            //NOTE: tags() = model's relationship function name
            //NOTE: sync() = connects to models and update them 
        $post->tags()->sync($request->tags);
        $post->categories()->sync($request->categories);

          return redirect(route('post.index'))->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        //Find specific post id in the posts table
        $post = post::find($id);
   
        //Delete Specific post
        $post->delete();
       
        //Detached/update rows in intermediate table (post_tags) related to deleted post
         $post->tags()->sync($post->delete());

         //Detached/update rows in intermediate table (category_posts) related to deleted post
         $post->categories()->sync($post->delete());

          return redirect()->back()->with('success', 'Post Deleted');    
    }

    
    public function published()
    {
        //for sidebar count
        $posts = post::all();
        $publish = post::where('status', 1)->count();
        $forpublish = post::where('status', 0)->count();
        $forediting = post::where('status', null)->count();
        $categories = category::all();
        
        return view('admin.post.published', compact('posts', 'publish', 'forpublish', 'forediting', 'categories'));
    }
    
    public function publishing()
    {
        //for sidebar count
        $posts = post::all();
        $publish = post::where('status', 1)->count();
        $forpublish = post::where('status', 0)->count();
        $forediting = post::where('status', null)->count();
        $categories = category::all();

        return view('admin.post.publishing', compact('posts', 'publish', 'forpublish', 'forediting', 'categories'));
    }

    public function editing()
    {

        //for sidebar count
        $posts = post::all();
        $publish = post::where('status', 1)->count();
        $forpublish = post::where('status', 0)->count();
        $forediting = post::where('status', null)->count();
        $categories = category::all();

        return view('admin.post.editing', compact('posts', 'publish', 'forpublish', 'forediting', 'categories'));
    }

    

}
