<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
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
        $roles = Role::orderby('id','asc')->get();
        return view('back.role.role_index', compact('roles'));
    }

    public function create()
    {
        
        return view('back.role.role_create');
    }

    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required|unique:roles',
        ]);

        if($request->has('permissions')){
            $role = new Role;
            $role->name = $request->name;
            $role->permissions = json_encode($request->permissions);
            $role->save();
            return redirect()->route('role.index')->with('success','Role has been inserted successfully');
        }
        return back()->with('danger','Something went wrong');
    }

    public function edit( $id)
    {
        $role = Role::find($id);
        return view('back.role.role_edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id.',id',
        ]);

        if($request->has('permissions')){
            $role->name = $request->name;
            $role->permissions = json_encode($request->permissions);
            $role->save();
            return redirect()->route('role.index')->with('success','Role has been updated successfully');
        }
        return back()->with('danger','Something went wrong');
    }

    public function destroy( $id)
    {
        $role = Role::find($id);
        $role->delete();
        return back()->with('success','Role deleted successfully');
    }
}
