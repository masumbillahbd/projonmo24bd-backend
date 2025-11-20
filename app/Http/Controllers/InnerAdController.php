<?php

namespace App\Http\Controllers;

use App\Models\InnerAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class InnerAdController extends Controller
{
    public $user_info;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = $this->user_info=Auth::user(); 
            if ($user->role== 'editor'|| $user->role== 'user'){
                return redirect(route('dashboard.admin.index'))->with("danger", "Forbidden You don't have permission to access");
            } else {
                 return $next($request);
            }
        });
    }
    
    public function index()
    {
        $ad = InnerAd::orderBy('id','desc')->first();
        return view('back.innerAd.create', compact('ad'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required',
        ]);

        $ad = new  InnerAd();
        $ad->status     = 1;
        $ad->url     = $request->url;
        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('/ads/'), $fileName);
            $ad->photo = $fileName;
        }
        $ad->save();
        return Redirect()->back()->with('success',  'Created successfully');
    }

    public function edit( $id)
    {
        $ad = InnerAd::find($id);
        return view('back.innerAd.edit', compact('ad'));
    }

    public function update(Request $request,  $id)
    {
        $ad = InnerAd::find($id);
        $ad->url     = $request->url;
        if($request->hasfile('photo')){
            $prev_image = public_path("/ads/").$ad->photo;
            if(File::exists($prev_image)) {
                File::delete($prev_image);
            }
            $file = $request->file('photo');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('/ads/'), $fileName);
            $ad->photo = $fileName;
        }

        $ad->save();
        return Redirect()->route('innerAd.index')->with('success',  'Updated successfully');
    }

    public function destroy( $id)
    {
        $ad = InnerAd::find($id);
        $file = public_path("/ads/").$ad->photo;
        if(File::exists($file)) {
            File::delete($file);
        }
        $ad->delete();
        return Redirect()->route('innerAd.index')->with('success','Successfully Deleted');
    }

    public function change_inner_ad_status(Request $request){
        $ad = InnerAd::find($request->id);
        $ad->status = $request->status;
        $ad->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
}
