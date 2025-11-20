<?php

namespace App\Http\Controllers;


use App\Models\Banner;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class BannerController extends Controller
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
        return view('back.banner.index');
    }

    public function create()
    {
        return view('pages.banner.create');
    }

    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required|max:250',
            'banner' => 'required|max:250',
        ]);
        $banner = new Banner;
        $banner->user_id = Auth::user()->id;
        $banner->name = $request->name;
        $banner->banner = $request->banner;

        if($request->hasfile('banner')){
            $date_time = date('YmdHis');
            $file = $request->file('banner');
            $fileExt = $file->getClientOriginalExtension();
            $fileNewName = $date_time.".".$fileExt;
            $storeImageName =  '/img/banner/'.$fileNewName;
            $image_resize = Image::make($file->getRealPath());       
            $image_resize->resize(640, 58);
            $image_resize->save(public_path('/img/banner/' .$fileNewName));
            $banner->banner = $storeImageName;
        }
        $banner->save();
        Session::flash('success', 'Successfully Added');
        return Redirect::back();
    }

    public function edit($id)
    {
        $edit = Banner::find($id);
        return view('back.banner.edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:250',
        ]);
        $banner = Banner::find($id);
        $banner->user_id = Auth::user()->id;
        $banner->name = $request->name;
        if($request->hasfile('banner')){
            // Delete old image
            if ($banner->banner && file_exists(public_path($banner->banner))) {
                unlink(public_path($banner->banner));
            }
            // Process new image
            $date_time = date('YmdHis');
            $file = $request->file('banner');
            $fileExt = $file->getClientOriginalExtension();
            $fileNewName = $date_time.".".$fileExt;
            $storeImageName =  '/img/banner/'.$fileNewName;
            $image_resize = Image::make($file->getRealPath());       
            $image_resize->resize(640, 58);
            $image_resize->save(public_path('/img/banner/' .$fileNewName));
            $banner->banner = $storeImageName;
        }
        $banner->save();
        Session::flash('success', 'Successfully Updated');
        return Redirect::to(route('banner.index'));
    }

    public function destroy($id)
    {
        $banner = Banner::find($id);
        // Delete image
        if ($banner->banner && file_exists(public_path($banner->banner))) {
            unlink(public_path($banner->banner));
        }
        $banner->delete();
        Session::flash('success', 'Successfully Deleted');
        return Redirect::to(route('banner.index'));
    }
    
    public function banner_status_toggle(Request $request){
        $banner = Banner::find($request->id);
        $banner->status = $request->status;
        $banner->save();
        return response()->json(['success'=>'Banner status change successfully.']);
    }
    
}
