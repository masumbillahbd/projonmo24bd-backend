<?php
namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
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
        $query = '';
        $search_tags =  collect();
        $feature_tags = Tag::where('feature',1)->select('id','name','feature')->get();
        $popular_tags = Tag::getPopularTags(20);
        $search_tags = Tag::orderBy('id','desc')->take(20)->get();
        return view('back.tag.index', compact('feature_tags','popular_tags','search_tags','query'));
    }

    public  function search(Request $request){
        $feature_tags = Tag::where('feature',1)->select('id','name','feature')->get();
        $popular_tags = Tag::getPopularTags(20);

        $query = $request->value;
        $search_tags = Tag::where('name', 'LIKE', '%' . $query . '%')
        ->orWhere('id', 'LIKE', '%' . $query . '%')
        ->select('id','name','feature')
        ->take(20)
        ->get();

        return view('back.tag.index', compact('feature_tags','popular_tags','search_tags','query'));
    }

    public function featureTagStatus(Request $request){
        $tag = Tag::find($request->id);
        $tag->feature = $request->feature;
        $tag->save();
        return response()->json(['success'=>'Feature tag change successfully.']);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Tag $tag)
    {
        //
    }

    public function update(Request $request, Tag $tag)
    {
        //
    }

    public function destroy(Tag $tag)
    {
        //
    }
}
