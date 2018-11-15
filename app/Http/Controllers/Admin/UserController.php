<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\admin;
use App\Model\admin\role;
use App\Model\user\User;
use App\Model\user\post;
use App\Model\user\category;

class UserController extends Controller
{
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
        $users = admin::all();

        //for sidebar count
        $posts = post::all();
        $publish = post::where('status', 1)->count();
        $forpublish = post::where('status', 0)->count();
        $forediting = post::where('status', null)->count();
        $categories = category::all();

        return view('admin.user.index', compact('users', 'posts', 'publish', 'forpublish', 'forediting', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //NOTE: for drop selection form
        $roles = role::all();

        //for sidebar count
        $posts = post::all();
        $publish = post::where('status', 1)->count();
        $forpublish = post::where('status', 0)->count();
        $forediting = post::where('status', null)->count();
        $categories = category::all();

        return view('admin.user.create', compact('roles', 'posts', 'publish', 'forpublish', 'forediting', 'categories'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'phone' => 'required|numeric',
            'password' => 'required|string|min:6|confirmed',
          ]);

            $request['password'] = bcrypt($request->password);

            $user = admin::create($request->all());

            //Save permissions and role relationship by ID in table permission_role
            $user->roles()->sync($request->role);
        
          return redirect(route('user.index'))->with('success', 'User Created');
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
        $user = admin::find($id);

        $roles = role::all();

        //for sidebar count
        $posts = post::all();
        $publish = post::where('status', 1)->count();
        $forpublish = post::where('status', 0)->count();
        $forediting = post::where('status', null)->count();
        $categories = category::all();
        

        return view('admin.user.edit', compact('user', 'roles', 'posts', 'publish', 'forpublish', 'forediting', 'categories'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric',
            
          ]);
            //If status has value do nothing else status = 0
            $request->status? : $request['status']=0;
            
            $user = admin::find($id);
        
            //To mass assign fill() u must Specify all $fillables and table in the model
            $user->fill($request->all())->save(); 

            //Save permissions and role relationship by ID in table permission_role
            $user->roles()->sync($request->role);

          return redirect(route('user.index'))->with('success', 'User Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = admin::find($id);

        $admin->delete();

        return redirect()->back()->with('success', 'Admin User Deleted');
    }
}
