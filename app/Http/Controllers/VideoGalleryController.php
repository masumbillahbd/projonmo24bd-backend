<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\VideoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class VideoGalleryController extends Controller
{
    public $user_info;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = $this->user_info=Auth::user(); 
            if ($user->role== 'user'){
                return redirect(route('dashboard.admin.index'))->with("danger", "Forbidden You don't have permission to access");
            } else {
                 return $next($request);
            }
        });
    }
    
    public function video_unique_key() {
        do {
            $uniqid = uniqid();
            $exists = VideoGallery::where('uniqid', $uniqid)->exists();
        } while ($exists);
        return $uniqid;
    }

    public function index()
    {
        $videos = VideoGallery::orderBy('id','desc')->paginate(20);
        return view('back.video.video_index', compact('videos'));
    }

    public function create()
    {
        return view('back.video.video_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:250|unique:video_galleries',
            'video_url' => 'required|max:250',
            'video_id' => 'required|max:250',
            'featured_image' => 'required|max:250',
            'streaming_site' => 'required|max:250',
        ]);
        
        $video = new VideoGallery;
        $video->user_id = Auth::user()->id;
        $video->title = $request->title;
        $video->slug = make_slug($request->title);
        $video->video_url = $request->video_url;
        $video->video_id = $request->video_id;
        $video->thumbnail = $request->featured_image;
        $video->streaming_site = $request->streaming_site;
        $video->uniqid =$this->video_unique_key();
        $video->save();
        
        $video = new VideoGallery;
        $video->user_id = Auth::user()->id;
        $video->title = $request->title.rand(111, 999);
        $video->slug = make_slug($request->title);
        $video->video_url = $request->video_url;
        $video->video_id = $request->video_id;
        $video->thumbnail = $request->featured_image;
        $video->streaming_site = $request->streaming_site;
        $video->uniqid =$this->video_unique_key();
        $video->save();
        
        $video = new VideoGallery;
        $video->user_id = Auth::user()->id;
        $video->title = $request->title.rand(111, 999);
        $video->slug = make_slug($request->title);
        $video->video_url = $request->video_url;
        $video->video_id = $request->video_id;
        $video->thumbnail = $request->featured_image;
        $video->streaming_site = $request->streaming_site;
        $video->uniqid =$this->video_unique_key();
        $video->save();
        
        $video = new VideoGallery;
        $video->user_id = Auth::user()->id;
        $video->title = $request->title.rand(111, 999);
        $video->slug = make_slug($request->title);
        $video->video_url = $request->video_url;
        $video->video_id = $request->video_id;
        $video->thumbnail = $request->featured_image;
        $video->streaming_site = $request->streaming_site;
        $video->uniqid =$this->video_unique_key();
        $video->save();
        
        $video = new VideoGallery;
        $video->user_id = Auth::user()->id;
        $video->title = $request->title.rand(111, 999);
        $video->slug = make_slug($request->title);
        $video->video_url = $request->video_url;
        $video->video_id = $request->video_id;
        $video->thumbnail = $request->featured_image;
        $video->streaming_site = $request->streaming_site;
        $video->uniqid =$this->video_unique_key();
        $video->save();
        
        
        Session::flash('success', 'Successfully Added');
        return Redirect::to(route('video.create'));

    }

    public function edit( $id)
    {   
        $video = VideoGallery::find($id);
        return view('back.video.video_edit', compact('video'));
    }

    public function update(Request $request, $id)
    {   
        $video = VideoGallery::find($id);
        $request->validate([
            'title' => 'required|max:250|unique:video_galleries,title,'.$video->id.',id',
            'video_url' => 'required|max:250',
            'video_id' => 'required|max:250',
            'featured_image' => 'required|max:250',
            'streaming_site' => 'required|max:250',
        ]);
        $video = VideoGallery::find($id);
        $video->user_id = Auth::user()->id;
        $video->title = $request->title;
        $video->slug = make_slug($request->title);
        $video->video_url = $request->video_url;
        $video->video_id = $request->video_id;
        $video->thumbnail = $request->featured_image;
        $video->streaming_site = $request->streaming_site;
        $video->save();
        Session::flash('success', 'Successfully Updated');
        return Redirect::to(route('video.index'));
    }

    public function destroy( $id)
    {
        $video = VideoGallery::find($id);
        $video->delete();
        Session::flash('success', 'Successfully Deleted');
        return Redirect::to(route('video.index'));
    }


}
