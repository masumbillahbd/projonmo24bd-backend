<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
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
        return view('back.category.category_index');
    }

    public function create()
    {
        return view('back.category.category_index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);

        $category = new Category();

        $category->user_id  = Auth::user()->id;
        $category->name = $request->name;
        
        if($request->slug == null){
            $category->slug = make_slug($request->name);
        }else{
            $category->slug = make_slug($request->slug);
        }
        
        if($request->position == null){
            $id = Category::orderby('id','desc')->first();
            if(!empty($id)){
             $category->position = $id->position+1;
            }else{
                $category->position = 1;
            }
        }else{
            $category->position = $request->position;
        }

        $category->save();
        return Redirect()->back()->with('success',  'Category inserted successfully');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit( $id)
    {
       $category = Category::find($id);
       return view('back.category.category_edit', compact('category'));
    }

    public function update(Request $request,  $id)
    {
        $category = Category::find($id);

        $request->validate([
            'name' => 'required|max:100',
        ]);

        $category->user_id = Auth::user()->id;
        $category->name = $request->name;
        
        if($request->slug == null){
            $category->slug = make_slug($request->name);
        }else{
            $category->slug = make_slug($request->slug);
        }
        
        if($request->position == null){
            $category->position = $category->id;
        }else{
            $category->position = $request->position;
        }
        $category->save();
        return Redirect()->route('category.index')->with('success',  'Category updated successfully');
    }

    public function destroy( $id)
    {   
        $total_post = Category::find($id)->Posts()->count();
        if($total_post == 0){
            Category::find($id)->delete();
            Session::flash('message', 'Successfully Deleted the Category');

        } else {
            Session::flash('danger', 'Sorry, You have some posts related with this Category');
        }
        return Redirect()->route('category.index');
    }

    public function changeHomePage(Request $request){
        $category = Category::find($request->id);
        $category->home_page = $request->home_page;
        $category->save();
        return response()->json(['success'=>'Home page status change successfully.']);
    }

    
}
