<?php

namespace App\Http\Controllers;

use App\Models\Breakingnews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class BreakingnewsController extends Controller
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
        $breakingnews = Breakingnews::orderBy('id','desc')->paginate(20);
        return view('back.breakingnews.index', compact('breakingnews'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {   
        $request->validate([
            'news_text' => 'required'
        ]);
        $breaking_news = new Breakingnews();
        $breaking_news->news_text = $request->news_text;
        $breaking_news->news_link = $request->news_link;
        $breaking_news->save();
        Session::flash('success', 'Successfully Added');
        return Redirect::to(route('breakingnews.index'));
    }

    public function edit( $id)
    {   
        $edit = Breakingnews::find($id);
         $breakingnews = Breakingnews::orderBy('id','desc')->paginate(20);
        return view('back.breakingnews.edit', compact('edit', 'breakingnews'));
    }

    public function update(Request $request,  $id)
    {
        $request->validate([
            'news_text' => 'required'
        ]);
        $breaking_news = Breakingnews::find($id);
        $breaking_news->news_text = $request->news_text;
        $breaking_news->news_link = $request->news_link;
        $breaking_news->save();
        Session::flash('success', 'Successfully Updated');
        return Redirect::to(route('breakingnews.index'));
    }

    public function destroy( $id)
    {
        $breaking_news = Breakingnews::find($id);
        $breaking_news->delete();
        Session::flash('success', 'Successfully Deleted');
        return Redirect::to(route('breakingnews.index'));
    }
}
