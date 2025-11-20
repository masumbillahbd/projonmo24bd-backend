<?php

namespace App\Http\Controllers;

use App\Models\Headline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class HeadlineController extends Controller
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
        $headlines = Headline::orderby('id','desc')->paginate(20);
        return view('back.headline.index', compact('headlines'));
    }

    public function create()
    {
        return view('back.headline.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
        ]);

        $headline = new Headline;
        $headline->title = $request->title;
        $headline->type = $request->type;
        $headline->save();
        Session::flash('success', 'Successfully Added');

        return Redirect::to(route('headline.index'));
    }

    public function show(Headline $headline)
    {
        //
    }

    public function edit( $id)
    {   
        $headline = Headline::find($id);
        return view('back.headline.edit', compact('headline'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
        ]);

        $headline = Headline::find($id);
        // $video->user_id = Auth::user()->id;
        $headline->title = $request->title;
        $headline->type = $request->type;
        $headline->save();
        Session::flash('success', 'Successfully Updated');

        return Redirect::to(route('headline.index'));
    }

    public function destroy( $id)
    {
        $headline = Headline::find($id);
        $headline->delete();
        Session::flash('success', 'Successfully Deleted');
        return Redirect::to(route('headline.index'));
    }
}
