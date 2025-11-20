<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    protected function profile_index(){
      return view('back.user.profile_index');
    }
    protected function profile_edit(){
      $user = User::find(Auth::user()->id);
      return view('back.user.profile_edit', compact('user'));
    }

    protected function profile_update(Request $request){
        $user = User::find(Auth::user()->id);
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|unique:users,email,'.$user->id.',id',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/profile/'), $fileName);
            $user->photo = $fileName;
        }
        $user->save();
        return Redirect()->route('user.profile.index')->with('success','Profile updated successfully');
    }

    protected function changePassword(){
        return view('back.user.changePassword');
    }

    protected function passwordUpdate(Request $request){
        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password|min:8',
        ]);
        User::where('id',Auth::user()->id)->update(['password' => Hash::make($request->password)]);
        Session::flash('success', 'Successfully Password Change');
        return Redirect()->back();
    }
}
