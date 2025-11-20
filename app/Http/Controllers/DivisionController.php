<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class DivisionController extends Controller
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
    
    
    public function create()
    {
        $divisions = Division::all();
        return view('back.division.create', compact('divisions'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'slug' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            if (request()->ajax()) {
                return Response::json($validator);
            }

            return Redirect::back()->withErrors($validator);
        }

        if ($request->slug) {
            $slug = $request->slug;
            $slug = strtolower($slug);
        } else {
            $slug = str_replace(' ', '-', $request->name);
            $slug = strtolower($slug);
        }

        $division = new Division;
        $division->name = $request->name;
        $division->slug = $slug;
        $division->save();
        Session::flash('message', 'Successfully Added');

        return Redirect::to(route('division.create'));
    }

    public function edit($id)
    {
        $edit = Division::find($id);
        $divisions = Division::all();
        return view('back.division.edit', compact('edit', 'divisions'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'slug' => 'required|max:100'
        ]);

        if ($validator->fails()) {
            if (request()->ajax()) {
                return Response::json($validator);
            }

            return Redirect::back()->withErrors($validator);
        }

        if ($request->slug) {
            $slug = $request->slug;
            $slug = strtolower($slug);
        } else {
            $slug = str_replace(' ', '-', $request->name);
            $slug = strtolower($slug);
        }

        $division = Division::find($id);
        $division->name = $request->name;
        $division->slug = $slug;
        $division->save();
        Session::flash('message', 'Successfully Updated');

        return Redirect::to(route('division.create'));
    }

    public function destroy($id)
    {   
        $division = Division::find($id);
        
        $district = $division->district->count();
        $post = $division->posts()->count();
       
        $total =  $district + $post;
        if($total == 0) {
            $division->posts()->detach();
            $division->delete();
            Session::flash('success', 'Successfully Deleted');
        }else{
            Session::flash('danger', 'don\'t Deleted. This record related another records');
        }
        
        return Redirect::to(route('division.create'));

    }
}
