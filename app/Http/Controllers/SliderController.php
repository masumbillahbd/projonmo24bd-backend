<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
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
        $slider = Slider::orderby('id','desc')->get();
        return view('back.slider.slider_index', compact('slider'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slider =  new Slider();
        $slider->author  = Auth::user()->id;
        $slider->title    = $request->title;
        $slider->link    = $request->link;

        if($request->hasfile('image')){
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/img/slider/'), $fileName);
            $slider->image = $fileName;
        }
        $slider->save(); 
        return Redirect()->route('slider.index')->with('success','data save successfully');
    }

    public function edit( $id)
    {   
        $sliders = Slider::orderby('id','desc')->get();
        $slider = Slider::find($id);
        return view('back.slider.slider_edit', compact('sliders', 'slider'));
    }

    public function update(Request $request , $id)
    {
        $slider = Slider::find($id);

        $request->validate([
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slider->author  = Auth::user()->id;
        $slider->title    = $request->title;
        $slider->link    = $request->link;

        if($request->hasfile('image')){
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/img/slider/'), $fileName);
            $slider->image = $fileName;
        }
        
        $slider->save(); 
        return Redirect()->route('slider.index')->with('success','data update successfully');
    }

    public function destroy( $id)
    {
        $slider = Slider::find($id);
        $image_path         = public_path("\img\slider\\") .$slider->image;

        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        else{
            $slider->delete();
        }

        $slider->delete(); 
        return Redirect()->route('slider.index')->with('success','data destroy successfully');
    }
}
