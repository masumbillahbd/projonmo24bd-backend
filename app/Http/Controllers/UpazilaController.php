<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UpazilaController extends Controller
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
        $districts = District::orderBy('slug','asc')->get();
        $upazila = Upazila::orderBy('district_id','asc')->Paginate(20);
        return view('back.upazila.create', compact('districts','upazila'));
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'district_id' => 'required',
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

        $district = new Upazila;
        $district->district_id = $request->district_id;
        $district->name = $request->name;
        $district->slug = $slug;
        $district->save();
        Session::flash('message', 'Successfully Added');

        return Redirect::to(route('upazila.create'));
    }

    public function edit($id)
    {
        $edit = Upazila::find($id);
        $districts = District::orderBy('slug','asc')->get();
        $upazila = Upazila::orderBy('district_id','asc')->Paginate(20);
        return view('back.upazila.edit', compact('edit','districts','upazila'));
    }

    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'district_id' => 'required',
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

        $district = Upazila::find($id);
        $district->district_id = $request->district_id;
        $district->name = $request->name;
        $district->slug = $slug;
        $district->save();
        Session::flash('message', 'Successfully Updated');

        return Redirect::to(route('upazila.create'));
    }

    public function destroy($id)
    {
        $upazila = Upazila::find($id);
        
        $post = $upazila->posts()->count();
        if($post == 0) {
            $upazila->posts()->detach();
            $upazila->delete();
            Session::flash('success', 'Successfully Deleted');
        }else{
            Session::flash('danger', 'don\'t Deleted. This record related another records');
        }
        
        return Redirect::to(route('upazila.create'));

    }
}
