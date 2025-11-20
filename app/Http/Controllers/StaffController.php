<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
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
        $staffs = Staff::orderby('id','desc')->get();
        return view('back.staff.staff_index', compact('staffs'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('back.staff.staff_create', compact('roles'));
    }

    public function store(Request $request)
    {
        if(User::where('email', $request->email)->first() == null){
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->role = "staff";
            $user->status = 1;
            $user->password = Hash::make($request->password);
            if($user->save()){
                $staff = new Staff;
                $staff->user_id = $user->id;
                $staff->role_id = $request->role_id;
                if($staff->save()){
                    return redirect()->route('staff.index')->with('success','Staff has been inserted successfully');
                }
            }
        }

        return back()->with('danger','Email already used');
    }

    public function edit( $id)
    {
         $staff = Staff::find($id);
         $roles = Role::all();
         return view('back.staff.staff_edit', compact('staff', 'roles'));
    }

    public function update(Request $request, $id)
    {   
        $staff = Staff::findOrFail($id);
        $user = $staff->user;
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email,'.$user->id.',id',
            'role_id' => 'required',
            'password' => 'required|min:8',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->status = 1;
        if(strlen($request->password) > 0){
            $user->password = Hash::make($request->password);
        }
        if($user->save()){
            $staff->role_id = $request->role_id;
            $staff->user_id = $user->id;
            if($staff->save()){
                 return redirect()->route('staff.index')->with('success','Staff has been updated successfully');
            }
        }
        return back()->with('danger','Something went wrong');
    }

    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        User::destroy(Staff::findOrFail($id)->user->id);
        if(Staff::destroy($id)){
            return redirect()->route('staff.index')->with('success','Staff has been deleted successfully');
        }
        return back()->with('danger','Something went wrong');
    }
}
