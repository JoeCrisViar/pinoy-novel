<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\role;
use App\Model\admin\Permission;
use App\Model\user\post;

class RoleController extends Controller
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
        $roles = role::all();

        //for sidebar count
        
        $posts = post::all();
        $publish = post::where('status', 1)->count();
        $forpublish = post::where('status', 0)->count();
        $forediting = post::where('status', null)->count();

        return view('admin.role.index',compact('roles', 'posts', 'publish', 'forpublish', 'forediting'));//->with('tags', $tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        //for sidebar count
        
        $posts = post::all();
        $publish = post::where('status', 1)->count();
        $forpublish = post::where('status', 0)->count();
        $forediting = post::where('status', null)->count();

        return view('admin.role.create', compact('permissions', 'posts', 'publish', 'forpublish', 'forediting'));
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
            'name' => 'required|max:50|unique:roles',
          ]);

          $role = new role;

          //To mass assign fill() u must Specify all $fillables and table in the model
          $role->fill($request->all())->save(); 
          
          //Save permissions and role relationship by ID in table permission_role
          $role->permissions()->sync($request->permission);
          

          return redirect(route('role.index'))->with('success', 'Role Created');
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
        $role = role::where('id', $id)->first();

        $permissions = Permission::all();

        //for sidebar count
        
        $posts = post::all();
        $publish = post::where('status', 1)->count();
        $forpublish = post::where('status', 0)->count();
        $forediting = post::where('status', null)->count();

        return view('admin.role.edit', compact('role', 'permissions', 'posts', 'publish', 'forpublish', 'forediting'));
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
            'name' => 'required|max:50',
          ]);
        
          $role = role::find($id);

          //To mass assign fill() u must Specify all $fillables and table in the model
          $role->fill($request->all())->save(); 

          //Save permissions and role relationship by ID in table permission_role
          $role->permissions()->sync($request->permission);

          return redirect(route('role.index'))->with('success', 'Role Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = role::find($id);
        // where('id', $id)->delete();
        $role->delete();

        //Detached/update rows in intermediate table (permission_roles) related to deleted post
        $role->permissions()->sync($role->delete());

        return redirect()->back()->with('success', 'Role Deleted');
    }
}
