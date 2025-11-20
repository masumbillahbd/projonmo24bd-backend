<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public $user_info;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = $this->user_info=Auth::user(); 
            if ($user->role== 'editor'||$user->role== 'user'){
                return redirect(route('dashboard.admin.index'))->with("danger", "Forbidden You don't have permission to access");
            } else {
                 return $next($request);
            }
        });
    }
    
    public function index()
    {
        $pages = Page::orderby('id','desc')->get();
        return view('back.pages.page_index', compact('pages'));
    }

    public function create()
    {
        return view('back.pages.page_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:150|unique:pages',
            'content' => 'required|max:30000',
        ]);

        $page = new Page();
        $page->user_id = Auth::user()->id;
        $page->title = $request->title;
        $page->slug = make_slug($request->title);
        $page->url = $request->url;
        $page->content = $request->content;
        $page->meta_title = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->keywords = $request->keywords;

        $page->save();
        return Redirect()->route('page.index')->with('success',  'Page inserted successfully');
    }

    public function edit( $id)
    {
        $page = Page::find($id);
        return view('back.pages.page_edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = Page::find($id);
        $request->validate([
            'title' => 'required|max:150|unique:pages,title,'.$page->id.',id',
            'content' => 'required|max:30000',
        ]);

        $page->user_id = Auth::user()->id;
        $page->title = $request->title;
        $page->slug = make_slug($request->title);
        $page->url = $request->url;
        $page->content = $request->content;
        $page->meta_title = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->keywords = $request->keywords;
        $page->save();
        return Redirect()->route('page.index')->with('success',  'Page updated successfully');
    }

    public function destroy( $id)
    {
        $page = Page::find($id);
        $page->delete();
        return Redirect()->route('page.index')->with('success',  'Page deleted successfully');
    }

    public function imageMarge(){
        return view('back.pages.image_marge');
    }

    public function imageMargeStore(Request $request){

        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image =  date('Ymd_His').'.'.$extension;
            $path  = public_path('img');
            $file->move($path, $image);
            $image =  public_path('img/'.$image);
            $bannger =  public_path('img/og_banner1.png');
  
            list($image_width, $image_height, $image_type, $image_attr) = getimagesize($image);
            list($bannger_width, $bannger_height, $bannger_type, $bannger_attr) = getimagesize($bannger);
            $height_distance = $image_height - $bannger_height;
            $height_distance =   $height_distance - 0;   
      
            $image = imagecreatefromstring(file_get_contents($image));
            $bannger = imagecreatefromstring(file_get_contents($bannger));
            imagecopymerge($image, $bannger, 0, $height_distance, 0, 0, $bannger_width, $bannger_height, 100);
            Header( "Content-type: image/jpg");
            $merge_name = time();
            imagejpeg($image, public_path('img/'.$merge_name.'.jpg'));
        }
    }
}
