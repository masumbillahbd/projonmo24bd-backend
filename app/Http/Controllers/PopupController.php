<?php

namespace App\Http\Controllers;

use App\Models\Popup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PopupController extends Controller
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
        return view("back.popup.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $popup =  new Popup();
        $popup->name    = $request->name;
        $popup->link    = $request->link;
        $popup->position    = $request->position;
        if($request->hasfile('image')){
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/img/popup/'), $fileName);
            $popup->image = $fileName;
        }
        $popup->save();
        return Redirect()->route('popup.index')->with('success','Inserted successfully');
    }
   
    public function edit( $popup)
    {
        $popup = Popup::find($popup);
        return view('back.popup.edit', compact('popup'));
    }

    public function update(Request $request,  $popup)
    {
        $popup = Popup::find($popup);
        $request->validate([
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $popup->name    = $request->name;
        $popup->link    = $request->link;
        $popup->position    = $request->position;
        if($request->hasfile('image')){
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/img/popup/'), $fileName);
            $popup->image = $fileName;
        }
        $popup->save();
        return Redirect()->route('popup.index')->with('success','Updated successfully');
    }
    public function destroy( $popup)
    {
        $popup = Popup::find($popup);
        $image_path         = public_path("/img/popup/").$popup->image;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $popup->delete();
        return Redirect()->route('popup.index')->with('success','Deleted successfully');
    }

    public function PopupStatusChange(Request $request){
        $post = Popup::find($request->id);
        $post->status = $request->status;
        $post->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
}
