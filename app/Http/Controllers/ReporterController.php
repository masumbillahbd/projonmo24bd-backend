<?php

namespace App\Http\Controllers;

use App\Models\Reporter;
use Illuminate\Http\Request;

class ReporterController extends Controller
{
    public function index()
    {
        $reporters = Reporter::orderBy('position','asc')->get();
        return view('back.reporter.index',compact('reporters'));
    }

    public function create()
    {
        return view('back.reporter.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'designation' => 'required|string|max:100',
            'position' => 'integer|max:1000',
        ]);
        $reporter = new Reporter();
        $reporter->name   = $request->name;
        $reporter->email   = $request->email;
        $reporter->designation   = $request->designation;
        $reporter->position   = $request->position;
        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/reporter/'), $fileName);
            $reporter->photo = $fileName;
        }
        $reporter->save();
        return Redirect()->back()->with('success',  'inserted successfully');
    }

    public function edit($id)
    {
        $reporter = Reporter::find($id);
        return view('back.reporter.edit',compact('reporter'));
    }

    public function update(Request $request, $id)
    {
        $reporter = Reporter::find($id);
        $request->validate([
            'name' => 'required|string|max:100',
            'designation' => 'required|string|max:100',
            'position' => 'integer|max:1000',
        ]);
    
        $reporter->name   = $request->name;
        $reporter->email   = $request->email;
        $reporter->designation   = $request->designation;
        $reporter->position   = $request->position;
        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/reporter/'), $fileName);
            $reporter->photo = $fileName;
        }
        $reporter->save();
        return Redirect()->route('reporter.index')->with('success',  'updated successfully');
    }

    public function destroy($id)
    {
        $reporter = Reporter::find($id);
        $post = $reporter->post()->count();
        $first_reporter = Reporter::orderBy('position','asc')->first();
        if(!empty($first_reporter)){
            $posts = $reporter->post()->select('posts.id','posts.reporter_id')->get();
            foreach($posts as $post){
                $post->reporter_id = $first_reporter->id;
                $post->save();
            }
        }
        
        $post = $reporter->post()->count();
        if($post == 0){
            $reporter->delete();
            return Redirect()->back()->with('success',  'Deleted successfully');
        }
        return Redirect()->back()->with('danger',  'Reporter related some other tables');
    }
}
