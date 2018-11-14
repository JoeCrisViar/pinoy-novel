<?php

namespace App\Http\Controllers\Admin;

use App\Model\admin\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\post;

class PermissionController extends Controller
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
        $permissions = Permission::all();

        //for sidebar count
        
        $posts = post::all();
        $publish = post::where('status', 1)->count();        
        $forpublish = post::where('status', 0)->count();
        $forediting = post::where('status', null)->count();

        return view('admin.permission.index', compact('permissions', 'posts', 'publish', 'forpublish', 'forediting'));
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

        return view('admin.permission.create', compact('posts', 'publish', 'forpublish', 'forediting'));
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
            'name' => 'required|max:50|unique:permissions', //permissions = table name
            'for' => 'required'
          ]);

          $permission = new Permission;
          $permission->create($request->all()); //to mass assign create() u must Specify all $fillables and table
        

          return redirect(route('permission.index'))->with('success', 'Permission Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\admin\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\admin\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $permission = Permission::where('id', $permission->id)->first();

        //for sidebar count
        
        $posts = post::all();
        $publish = post::where('status', 1)->count();        
        $forpublish = post::where('status', 0)->count();
        $forediting = post::where('status', null)->count();

        return view('admin.permission.edit', compact('permission', 'posts', 'publish', 'forpublish', 'forediting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\admin\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|max:50', //permissions = table name
            'for' => 'required'
          ]);
        
          $permission = Permission::find($permission->id);
          $permission->fill($request->all())->save(); //to mass assign fill() u must Specify all $fillables and table

          return redirect(route('permission.index'))->with('success', 'Permission Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\admin\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        Permission::where('id', $permission->id)->delete();

        return redirect()->back()->with('success', 'Post Deleted');
    }
}
