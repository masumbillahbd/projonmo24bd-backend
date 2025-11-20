<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{

    public $user_info;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = $this->user_info=Auth::user(); 
            if ($user->role == 'manager admin' || $user->role== 'editor'|| $user->role== 'user'){
                return redirect(route('dashboard.admin.index'))->with("danger", "Forbidden You don't have permission to access");
            } else {
                 return $next($request);
            }
        });
    }
    
    public function index()
    {
        $permissions = Permission::orderby('id','asc')->get();
        return view('back.permission.permission_index', compact('permissions'));
    }

    public function create()
    {   
        $permissions = Permission::orderby('id','asc')->get();
        return view('back.permission.permission_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);
        $permission = new Permission();
        $permission->name = strtolower($request->name);
        $permission->product = $request->product;
        $permission->website_setup = $request->website_setup;
        $permission->save();
        return Redirect()->route('permission.index')->with('success',  'Permission setup successfully');
    }

    public function edit( $id)
    {
        $permission =  Permission::find($id);
        return view('back.permission.permission_edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $permission =  Permission::find($id);
        $request->validate([
            'name' => 'required|max:100',
        ]);
        $permission->name = strtolower($request->name);
        $permission->product = $request->product;
        $permission->website_setup = $request->website_setup;
        $permission->save();
        return Redirect()->route('permission.index')->with('success',  'Permission setup successfully');

    }

    public function destroy( $id)
    {
        $permission =  Permission::find($id);
        $permission->delete();
        return Redirect()->route('permission.index')->with('success',  'Permission deleted successfully');
    }
}
