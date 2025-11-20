<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SubCategoryController extends Controller
{

    public $user_info;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = $this->user_info=Auth::user(); 
            if ($user->role == 'manager admin' || $user->role== 'editor'|| $user->role== 'user'){
                return redirect(route('dashboard.admin.index'))->with("danger", "Forbidden You don't have permission to access");
            } else {
                 return $next($request);
            }
        });
    }
    
    public function index()
    {
        $categories = Category::orderby('name','asc')->get();
        return view('back.sub_category.sub_category_index',compact('categories'));
    }

    public function create()
    {   
        $categories = Category::orderby('name','asc')->get();
        return view('back.sub_category.sub_category_create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
        ]);

        $sub_cat =  new SubCategory();

        $sub_cat->user_id = Auth::user()->id;
        $sub_cat->category_id = $request->category_id;
        $sub_cat->name = $request->name;
        
        if($request->slug == null){
            $sub_cat->slug = make_slug($request->name);
        }else{
            $sub_cat->slug = make_slug($request->slug);
        }

        if($request->position == null){
            $id = SubCategory::orderby('id','desc')->first();
            if(!empty($id)){
                $sub_cat->position = $id->position+1;
            }else{
                $sub_cat->position = 1;
            }
        }else{
            $sub_cat->position = $request->position;
        }
        $sub_cat->save();

        return Redirect()->back()->with('success',  'Subcategory inserted successfully');
    }
    
    public function edit( $id)
    {   
        $categories = Category::orderby('name','asc')->get();
        $sub_cat = SubCategory::find($id);
        return view('back.sub_category.sub_category_edit', compact('categories', 'sub_cat'));

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $sub_cat = SubCategory::find($id);
        $sub_cat->user_id = Auth::user()->id;
        $sub_cat->category_id = $request->category_id;
        $sub_cat->name = $request->name;
        
        if($request->slug == null){
            $sub_cat->slug = make_slug($request->name);
        }else{
            $sub_cat->slug = make_slug($request->slug);
        }
        
        if($request->position == null){
            $sub_cat->position = $sub_cat->id;
        }else{
            $sub_cat->position = $request->position;
        }
        $sub_cat->save();
        return Redirect()->route('sub_category.index')->with('success',  'Subcategory updated successfully');
    }

    public function destroy($id)
    {
        $sub_cat = SubCategory::find($id);
        $sub_cat->delete();
        Session::flash('success', 'Sub Category deleted successfully');
        return Redirect()->back();
    }
}
