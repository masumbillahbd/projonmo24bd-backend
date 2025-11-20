<?php

namespace App\Http\Controllers;

use App\Models\Livestream;
use Illuminate\Http\Request;

class LivestreamController extends Controller
{
   
    public function index()
    {
        $item = Livestream::orderBy('id','desc')->first();
        return view('back.video.livestream',compact('item'));
    }

    public function store(Request $request)
    {
        $item = new Livestream();
        $item->content = $request->content;
        $item->save();
        return Redirect()->back()->with('success',  'Added successfully');
    }

    public function update(Request $request, $id)
    {
        $item = Livestream::find($id);
        $item->content = $request->content;
        $item->save();
        return Redirect()->back()->with('success',  'Updated successfully');
    }
    
    public function changeLivestreamStatus(Request $request){
        $item = Livestream::find($request->id);
        $item->status = $request->status;
        $item->save();
        return response()->json(['success'=>'Status Change successfully']);
    }
}
