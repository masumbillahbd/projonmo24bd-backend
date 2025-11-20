<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
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
    {   $menus = Menu::orderBy('position','asc')->get();
        return view('back.menu.menu_create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'url_text' => 'required|max:250',
            'url_path' => 'required|max:250',
        ]);

        $menu = new Menu();
        $menu->user_id  = Auth::user()->id;
        $menu->url_text = $request->url_text;
        $menu->url_path = $request->url_path;

        if($request->position == null){
            $id = Menu::orderby('id','desc')->first();
            $menu->position = $id->position+1;
        }else{
            $menu->position = $request->position;
        }
        $menu->save();
        return Redirect()->back()->with('success',  'Menu inserted successfully');
    }

    public function edit($id)
    {   
        $menu = Menu::find($id);
        $menus = Menu::orderby('position','asc')->get();
        return view('back.menu.menu_edit', compact('menu','menus'));
    }

    public function update(Request $request,  $id)
    {
        $menu = Menu::find($id);
        $menu->user_id  = Auth::user()->id;
        $menu->url_text = $request->url_text;
        $menu->url_path = $request->url_path;

        if($request->position == null){
            $id = Menu::orderby('id','desc')->first();
            $menu->position = $id->position+1;
        }else{
            $menu->position = $request->position;
        }
        $menu->save();
        return Redirect()->route('menu.index')->with('success',  'Menu updated successfully');
    }

    public function destroy($id)
    {   
        $menu = Menu::find($id);
        $total = $menu->subMenu->count();
        if($total == 0) {
            $menu->delete();
            Session::flash('success', 'Successfully Deleted');
        }else{
            Session::flash('danger', 'don\'t Deleted. This record related another records');
        }
        return Redirect()->back();
    }
}
