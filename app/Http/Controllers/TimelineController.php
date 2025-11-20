<?php

namespace App\Http\Controllers;

use App\Models\Timeline;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function create(){
        $items = Timeline::orderBy('id','desc')->paginate(20);
        return view('back.timeline.create',compact('items'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:150|unique:timelines,name',
        ]);
        

        $timeline = new Timeline();
        $timeline->name = $request->name;
        $timeline->slug = make_slug($request->name);
        $timeline->save();
        return Redirect()->back()->with('success',  'Timeline inserted successfully');
    }

    public function edit($id){
        $timeline = Timeline::find($id);
        $items = Timeline::orderBy('id','desc')->paginate(20);
        return view('back.timeline.edit',compact('timeline','items'));
    }

    public function update(Request $request, $id){
        $timeline = Timeline::find($id);
        $request->validate([
            'name' => 'required|max:150|unique:timelines,name,' . $timeline->id,
        ]);        

        $timeline->name = $request->name;
        $timeline->slug = make_slug($request->name);
        $timeline->save();
        return Redirect()->route('timeline.create')->with('success',  'Timeline updated successfully');
    }

    public function timelineStatusChange(Request $request){
        $timeline = Timeline::find($request->id);
        $timeline->status = $request->status;
        $timeline->save();
        return response()->json(['success'=>'Timeline status change successfully.']);
    }
}
