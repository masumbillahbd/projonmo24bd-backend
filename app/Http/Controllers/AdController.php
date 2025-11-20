<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    public $user_info;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = $this->user_info=Auth::user();
            if ( $user->role== 'editor'|| $user->role== 'user'){
                return redirect(route('dashboard.admin.index'))->with("danger", "Forbidden You don't have permission to access");
            } else {
                 return $next($request);
            }
        });
    }

    public function index()
    {
        return view('back.ad.ad_index');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:200',
            'photo' => 'required|max:300',
        ]);
        
        $ad =  new Ad();
        $ad->user_id     = Auth::user()->id;
        $ad->name     = $request->name;
        $ad->url     = $request->url;
        $ad->position     = $request->position;
        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/ads/'), $fileName);
            $ad->photo = URL('/').'/ads/'.$fileName;
        }
        $ad->save();
        return Redirect()->back()->with('success',  'Advertisement inserted successfully');

    }

    public function edit( $id)
    {
        $ad = Ad::find($id);
        return view('back.ad.ad_edit', compact('ad'));
    }

    public function update(Request $request,  $id)
    {
        $request->validate([
            'name' => 'required|max:300',
        ]);
        
        $ad =   Ad::find($id);
        $ad->user_id     = Auth::user()->id;
        $ad->name     = $request->name;
        $ad->url     = $request->url;
        $ad->position     = $request->position;
        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/ads/'), $fileName);
            $ad->photo = URL('/').'/ads/'.$fileName;
        }
        $ad->save();
        return Redirect()->route('ad.index')->with('success',  'Advertisement updated successfully');
    }

    public function destroy($id)
    {
        $ad =   Ad::find($id);
        $ad->delete();
        return Redirect()->route('ad.index')->with('success',  'Advertisement deleted successfully');
    }
    
    public function changeAdStatus(Request $request){
        $ad = Ad::find($request->id);
        $ad->status = $request->status;
        $ad->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
    
    
}
