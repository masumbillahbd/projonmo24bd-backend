<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
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
        $setting = Setting::find(1);
        return view('back.settings.general_setting', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::find(1);
        $request->validate([
            'admin_prefix' => 'required|min:5',
        ]);
        
        if ($request->lazy_image){
            $image = $request->lazy_image;
            $filename = 'lazy-image'.'-'.date('Y-m-d-H-i-s').'.'.$image->getClientOriginalExtension();
            $path = public_path('photos/' . $filename);
            Image::make($image->getRealPath())->resize(640, 360)->save($path);
            $lazy_image = 'photos/' . $filename;
        }else {
            $lazy_image = $setting->lazy_image;
        }
        
        if ($request->logo){
            $image = $request->logo;
            // $filename = date('Y-m-d-H') . '-' . 'logo' .'-'. $image->getClientOriginalName();
            $filename = 'logo'.'-'.date('Y-m-d-H-i-s').'.'.$image->getClientOriginalExtension();
            $path = public_path('photos/' . $filename);
            Image::make($image->getRealPath())->save($path);
            $logo = 'photos/' . $filename;
        } else {
            $logo = $setting->logo;
        }

        if ($request->favicon){
            $image = $request->favicon;
            // $filename = date('Y-m-d-H') . '-' . 'favicon' .'-'. $image->getClientOriginalName();
            $filename = 'favicon'.'-'.date('Y-m-d-H-i-s').'.'.$image->getClientOriginalExtension();
            $path = public_path('photos/' . $filename);
            Image::make($image->getRealPath())->resize(16, 16)->save($path);
            $favicon = 'photos/' . $filename;
        }else {
            $favicon = $setting->favicon;
        }
        
        if ($request->meta_image){
            $image = $request->meta_image;
            // $filename = date('Y-m-d-H') . '-' . 'meta_image' .'-'. $image->getClientOriginalName();
            $filename = 'meta-image'.'-'.date('Y-m-d-H-i-s').'.'.$image->getClientOriginalExtension();
            $path = public_path('photos/' . $filename);
            Image::make($image->getRealPath())->resize(640, 360)->save($path);
            $meta_image = 'photos/' . $filename;
        }else {
            $meta_image = $setting->meta_image;
        }
        
        if ($request->share_banner){
         
            $image = $request->share_banner;
            $filename = 'share-banner'.'-'.date('Y-m-d-H-i-s').'.'.$image->getClientOriginalExtension();
            $path = public_path('photos/' . $filename);
            Image::make($image->getRealPath())->resize(640, 58)->save($path);
            $share_banner = 'photos/' . $filename;
            
        } else {
            $share_banner = $setting->share_banner;
        }
        
        $old_admin_prefix = $setting->admin_prefix;
        $setting->admin_prefix = $request->admin_prefix;
        $setting->site_url = $request->site_url;
        $setting->site = $request->site;
        $setting->site_title = $request->site_title;
        $setting->site_email = $request->site_email;
        $setting->site_mobile = $request->site_mobile;
        $setting->editor = $request->editor;
        $setting->address = $request->address;
        $setting->meta_title = $request->meta_title;
        $setting->meta_description = $request->meta_description;
        $setting->meta_keywords = $request->meta_keywords;
        $setting->fb_app_id = $request->fb_app_id;
        $setting->logo = $logo;
        $setting->lazy_image = $lazy_image;
        $setting->favicon = $favicon;
        $setting->meta_image = $meta_image;
        $setting->share_banner = $share_banner;
        $setting->google_map = $request->google_map;
        $setting->google_adsense = $request->google_adsense;
        $setting->google_analytic = $request->google_analytic;
        $setting->facebook = $request->facebook;
        $setting->twitter = $request->twitter;
        $setting->youtube = $request->youtube;
        $setting->instagram = $request->instagram;
        $setting->linkedin = $request->linkedin;
        $setting->save();

        if ($request->admin_prefix == $old_admin_prefix){
            Session::flash('message', 'Successfully Updated');
            return Redirect::back();

        } else {
            Session::flush();
            return Redirect::to(url($request->admin_prefix));
        }
    }

   
    public function sm_banner_status(Request $request){
        $setting = Setting::find(1);
        $setting->share_banner_status = $request->sm_banner;
        $setting->save();
        return response()->json(['success'=>'Banner status change successfully.']);
    }
    
    public function scrollBarToggle(Request $request){
        $setting = Setting::find(1);
        $setting->scroll_bar = $request->scroll_bar;
        $setting->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
    
    public function menuBarToggle(Request $request){
        $setting = Setting::find(1);
        $setting->desktop_menu_bar = $request->desktop_menu_bar;
        $setting->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
    
    public function popularTagToggle(Request $request){
        $setting = Setting::find(1);
        $setting->popular_tag = $request->popular_tag;
        $setting->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
    

    public function featureTagShow()
    {
        $totalTag = Tag::count();
        $tags = Tag::select('id','name')->orderBy('id','desc')->skip(0)->take(500)->get();
        return view('back.tag.featureTagPost',compact('tags','totalTag'));
    }

    public function featureTagPostStore(Request $request)
    {
        $request->validate([
            'tag_id' => 'required',
        ]);

        $setting = setting();
        $setting->feature_tag_id = $request->tag_id;
        if($request->hasfile('image')){
            $imagePath = public_path($setting->feature_tag_banner);
            // if(File::exists($imagePath)){
            //     unlink($imagePath);
            // }
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/img/banner/'), $fileName);
            $setting->feature_tag_banner = '/img/banner/'.$fileName;
        }
        $setting->save();
        return Redirect()->back()->with('success',  'Successfully Updated');
    }

    public function featureTagStatusChange(Request $request){
        $setting = setting();
        $setting->feature_tag_status = $request->feature_tag_status;
        $setting->save();
        return response()->json(['success'=>'Status change successfully.']);
    }

    //FeatureTag
    public function featureTagIndex(){
        $featureTags = FeatureTag::orderby('position','asc')->get();
        $tags = Tag::select('id','name')->orderBy('id','desc')->skip(0)->take(2000)->get();
        return view('back.tag.create',compact('tags','featureTags'));
    }
    public function featureTagStore(Request $request)
    {
        $request->validate([
            'tag_id' => 'required|unique:feature_tags',
        ]);
        $featureTag = new FeatureTag;
        $featureTag->tag_id = $request->tag_id;
        $featureTag->position = $request->position;
        $featureTag->save();
        Session::flash('success', 'Successfully Added');
        return Redirect::back();
    }
    public function featureTagEdit($id){
        $featureTagEdit = FeatureTag::find($id);
        $featureTags = FeatureTag::orderby('position','asc')->get();
        $tags = Tag::select('id','name')->orderBy('id','desc')->skip(0)->take(2000)->get();
        return view('back.tag.edit',compact('tags','featureTags','featureTagEdit'));
    }
    public function featureTagUpdate(Request $request,$id){
        $featureTag = FeatureTag::find($id);
        $request->validate([
            'tag_id' => 'required|unique:feature_tags,tag_id,'.$featureTag->id.',id',
        ]);
        $featureTag->tag_id = $request->tag_id;
        $featureTag->position = $request->position;
        $featureTag->save();
        Session::flash('success', 'Successfully Updated');
        return Redirect::route('featureTag.index');
    }
    public function featureTagDelete($id){
        $featureTagEdit = FeatureTag::find($id);
        $featureTagEdit->delete();
        Session::flash('success', 'Successfully Deleted');
        return Redirect::route('featureTagShow');
    }
}
