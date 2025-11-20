<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ReadMore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ReadMoreController extends Controller
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
    
    public function index()
    {
        $posts = Post::orderby('id','desc')->take(300)->get();
        $readmore = ReadMore::orderby('id','desc')->get();
        return view('back.readmore.create',compact('posts','readmore'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'leader' => 'required',
            'post_id' => 'required',
        ]);
        $leader_id = $request->input('leader');
        $post_ids = $request->input('post_id');
        foreach($post_ids as $post_id){
            $check_exist = ReadMore::where([['leader', $leader_id],['post_id', $post_id]])->exists();
            if(!$check_exist){
                ReadMore::create([
                    'leader' => $leader_id,
                    'post_id' => $post_id,
                ]);
            }
        }
        Session::flash('success', 'Successfully Added');
        return Redirect::route('readmore.index');
    }

    public function edit($leader)
    {   
        $edit = ReadMore::orderby('post_id','asc')->where('leader',$leader)->select('id','leader','post_id')->get();
        $posts = Post::orderby('id','desc')->take(300)->get();
        $readmore = ReadMore::orderby('id','desc')->take(300)->get();
        $selectedPostIds = $edit->pluck('post_id')->toArray(); // if post_id is a single value
        return view('back.readmore.edit',compact('edit','posts','readmore','selectedPostIds'));
    }

    public function update(Request $request,  $id)
    {   
        $request->validate([
            'leader' => 'required',
            'post_id' => 'required',
        ]);
        $leader_id = $request->input('leader');
        $post_ids = $request->input('post_id');
        $existPostIds = ReadMore::where('leader',$leader_id)->orderby('post_id','asc')->pluck('post_id')->toArray();
        
        if(!empty($existPostIds)){
            $toDeleteIds = array_diff($existPostIds,$post_ids);
            $toAddIds = array_diff($post_ids,$existPostIds);
            if(!empty($toDeleteIds)){
                foreach($toDeleteIds as $toDeleteId){
                    $readmore=ReadMore::where('post_id', $toDeleteId)->first();
                    $readmore->delete();
                }
            }
            if(!empty($toAddIds)){
                foreach($toAddIds as $toAddId){
                    ReadMore::create([
                        'leader' => $leader_id,
                        'post_id' => $toAddId,
                    ]);
                }
            }
        }else{
            foreach($post_ids as $post_id){
                ReadMore::create([
                    'leader' => $leader_id,
                    'post_id' => $post_id,
                ]);
            }
        }

        Session::flash('success', 'Successfully Updated');
        return Redirect::route('readmore.index');
    }

    public function destroy( $id)
    {
        $readmore = ReadMore::findOrFail($id);
        $readmore->delete();
        Session::flash('success', 'Successfully Deleted');
        return Redirect::route('readmore.index');
    }
}
