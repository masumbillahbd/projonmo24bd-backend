<?php

namespace App\Http\Controllers;

use App\Models\LeadPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LeadPostController extends Controller
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
        $lead_posts = LeadPost::orderBy('position', 'asc')->skip(20)->take(PHP_INT_MAX)->get();
        if($lead_posts->count() > 0){
            foreach($lead_posts as $lead){
                $lead->delete();
            }
        }
        $lead_posts = LeadPost::orderBy('position', 'asc')->take(20)->get();
        return view('back.lead_post.index', compact('lead_posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'position' => 'required|max:2|unique:lead_posts',
            'post_id' => 'required|unique:lead_posts'
        ]);
        $lead_post = new LeadPost();
        $lead_post->position = $request->position;
        $lead_post->post_id = $request->post_id;
        $lead_post->save();
        Session::flash('success', 'Successfully Added');
        return Redirect::to(route('leadpost.index'));
    }

    public function edit($id)
    {
        $leadPostEdit = LeadPost::find($id);
        return view('back.lead_post.edit', compact('leadPostEdit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'position' => 'required|max:2|unique:lead_posts',
            'post_id' => 'required|unique:lead_posts'
        ]);
        $lead_post = LeadPost::find($id);
        $lead_post->position = $request->position;
        $lead_post->post_id = $request->post_id;
        $lead_post->save();
        Session::flash('success', 'Successfully Added');
        return Redirect::to(route('leadpost.index'));
    }

    public function destroy($id)
    {
        LeadPost::find($id)->delete();
        Session::flash('success', 'Successfully Deleted');
        return Redirect::to(route('leadpost.index'));
    }
    public function updatePosition(Request $request){
        foreach ($request->position as $key => $id){
            $lead_post = LeadPost::findOrFail($id);
            $lead_post->update(['position' => $key+1]);
        }
        return response()->json(array(
            'success' => true,
        ));
    }
}
