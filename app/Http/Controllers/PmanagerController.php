<?php

namespace App\Http\Controllers;

use App\Models\Pmanager;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;

class PmanagerController extends Controller
{
    public function create()
    {
        return view('back.pmanager.create');
    }

    public function store(Request $request)
    {   
        date_default_timezone_set('Asia/Dhaka');
        $validatedData = $request->validate([
         'image' => 'required',
        ]);
        $pmanager = new Pmanager;
        $date_time = date('YmdHis');
     
        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();
        $fileExt = $file->getClientOriginalExtension();
        $fileOrgName = basename($fileName,".".$fileExt);
        $fileOrgName2 = make_slug($fileOrgName);
        $fileName = $fileOrgName2.'-'.$date_time.'.'.$fileExt;
        $f_image =  url('/').'/uploads/'.$fileName;
        $image_resize = Image::make($file->getRealPath());       
        $image_resize->resize(640, 360);
        $image_resize->save(public_path('/uploads/' .$fileName));
        $pmanager->photo = $f_image;
        $pmanager->date = date('Y-m-d');
        $pmanager->name = $fileOrgName2.'-'.$date_time.'.'.$fileExt;
        $pmanager->save();
        return response()->json($f_image);
    }

    public function realtimePmanager()
    {
        $results = Pmanager::orderBy('id', 'desc')->take(6)->get();
        return view('back.pmanager.realtime', compact('results'));
    }

    public function loadmorePmanager(Request $request)
    {
     if($request->ajax()){
      if($request->id > 0){
       $data = DB::table('pmanagers')
          ->where('id', '<', $request->id)
          ->orderBy('id', 'DESC')
          ->limit(12)
          ->get();
      }else{
       $data = DB::table('pmanagers')
          ->orderBy('id', 'DESC')
          ->skip(6)
          ->limit(30)
          ->get();
      }
      $output = '';
      $last_id = '';
      
      if(!$data->isEmpty()){
       foreach($data as $row) {
        $output .= '<div class="pmanager-box col-md-2 col-4 "><img class="pmanager-img pmanagerUse" data-id="'.$row->id.'" src="'.$row->photo.'" alt="'.$row->id.'"/><br><span>'.Str::limit($row->name, 10).'</span><div class="pmanagerShow" data-id="'.$row->id.'">view</div></div>';
        $last_id = $row->id;
        }
           $output .= '
           <div class="load_more col-md-12">
            <button type="button" name="load_more_button" class="btn__load__more btn btn-success my-2" data-id="'.$last_id.'" id="load_more_button">Load More</button>
           </div>
           ';
        }else{
           $output .= '
           <div class="load_more col-md-12">
            <div></div>
           </div>
           ';
        }
            echo $output;
        }

    }

    public function single($id){
        $pmanager = Pmanager::findOrFail($id);
        return Response::json($pmanager);
    }

    public function pmanagerLiveSearch(Request $request){
        $query = $request->get('searchQuery');
        if(!empty($query)){
            $results = Pmanager::where('name','LIKE','%'.$query.'%')->orWhere('date','LIKE','%'.$query.'%')->orderBy('id', 'desc')->take(30)->get();
            return json_encode($results);
        }
        else{
            $results = Pmanager::orderBy('id', 'desc')->take(30)->get();
            return json_encode($results);
        }
    }

    public function delete($id)
    {
        $pmanager = Pmanager::findOrFail($id);
        if(File::exists(public_path('/uploads/'.$pmanager->name))){
            File::delete(public_path('/uploads/'.$pmanager->name));
        }
        $pmanager->delete();
        return json_encode($pmanager);
    }

}
