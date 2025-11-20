<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
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
    

    protected function index(){
      return view('back.user.user_index');
    }

    protected function create(){
      return view('back.user.user_create');
    }

    
    protected function store(Request $request){
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password|min:8',
        ]);


        $user = new User();

        $user->name = $request->name;
        $user->short_name = $request->short_name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = 1;
        $user->password = Hash::make($request->password);
        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/profile/'), $fileName);
            $user->photo = $fileName;
        }
        $user->save();
        return Redirect()->back()->with('success',  'User inserted successfully');
      
    }

    protected function edit($id){
      $user = User::find($id);
      return view('back.user.user_edit', compact('user'));
    }


    protected function update(Request $request, $id){
      $user = User::find($id);

        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email,'.$user->id.',id',
            'role' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password|min:8',
        ]);

        $user->name = $request->name;
        $user->short_name = $request->short_name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = 1;
        $user->password = Hash::make($request->password);
        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/profile/'), $fileName);
            $user->photo = $fileName;
        }
        $user->save();
        return Redirect()->route('user.index')->with('success',  'User updated successfully');
    }

    protected function destroy($id){
        $user = User::find($id);
        return Redirect()->route('user.index')->with('success',  'User deleted successfully');
    }

    //admin
    protected function admin_index(){
        $admins = User::where([['email','!=','masumdhaka99@gmail.com'],['email','!=','it.anwarul@gmail.com']])->orderBy('position','asc')->get();
        return view('back.user.admin.admin_index', compact('admins'));
    }

    protected function admin_create(){
        return view('back.user.admin.admin_create');
    }

    protected function admin_store(Request $request){

        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password|min:8',
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->short_name = $request->short_name;
        $user->email = $request->email;
        $user->status = 1;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/profile/'), $fileName);
            $user->photo = $fileName;
        }

        $exitUser = User::orderBy('id','desc')->first();
        if($exitUser){
            $user->position = $exitUser->id +1;
        }else{
            $user->position = 1;
        }

        $user->save();
        return Redirect()->route('admin.index')->with('success',  'inserted successfully');
    }

    protected function admin_edit($id){
        $admin = User::find($id);
        return view('back.user.admin.admin_edit', compact('admin'));
    }

    protected function admin_update(Request $request, $id){
        $user = User::find($id);
        $request->validate([
            'name' => 'required|max:50',
            'position' => 'required|integer|min:1',
            'email' => 'required|email|unique:users,email,'.$user->id.',id',
            'role' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password|min:8',
        ]);
        // dd( $request);
        $user->name = $request->name;
        $user->short_name = $request->short_name;
        $user->email = $request->email;
        $user->status = 1;
        $user->role = $request->role;
        $user->position = $request->position;
        $user->password = Hash::make($request->password);

        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/profile/'), $fileName);
            $user->photo = $fileName;
        }
        $user->save();
        return Redirect()->route('admin.index')->with('success',  'updated successfully');
    }

    protected function admin_destroy($id){
        $user = User::find($id);
        $first_user = User::orderBy('position','asc')->first();

        $postsCount = $user->posts->count();
        if($first_user && $postsCount !== 0) {
            $posts = $user->posts()->select('id', 'user_id')->get();
            foreach($posts as $post){
                $post->user_id = $first_user->id;
                $post->save();
            }
        }

        $pollsCount = $user->polls->count();
        if($first_user && $pollsCount !== 0) {
            $polls = $user->polls()->select('id', 'user_id')->get();
            foreach($polls as $poll){
                $poll->user_id = $first_user->id;
                $poll->save();
            }
        }

       

        
        $adsCount = $user->ads->count();
        if($first_user && $adsCount !== 0) {
            $ads = $user->ads()->select('id', 'user_id')->get();
            foreach($ads as $ad){
                $ad->user_id = $first_user->id;
                $ad->save();
            }
        }

        $categoriesCount = $user->categories->count();
        if($first_user && $categoriesCount !== 0) {
            $categories = $user->categories()->select('id', 'user_id')->get();
            foreach($categories as $category){
                $category->user_id = $first_user->id;
                $category->save();
            }
        }

        
        $subCategoriesCount = $user->subCategories->count();
        if($first_user && $subCategoriesCount !== 0) {
            $subCategories = $user->subCategories()->select('id', 'user_id')->get();
            foreach($categories as $subCategory){
                $subCategory->user_id = $first_user->id;
                $subCategory->save();
            }
        }

        $subMenusCount = $user->subMenus->count();
        if($first_user && $subMenusCount !== 0) {
            $subMenus = $user->subMenus()->select('id', 'user_id')->get();
            foreach($subMenus as $subMenu){
                $subMenu->user_id = $first_user->id;
                $subMenu->save();
            }
        }
        $photosCount = $user->photos->count();
        if($first_user && $photosCount !== 0) {
            $photos = $user->photos()->select('id', 'user_id')->get();
            foreach($photos as $photo){
                $photo->user_id = $first_user->id;
                $photo->save();
            }
        }

        $pagesCount = $user->pages->count();
        if($first_user && $pagesCount !== 0) {
            $pages = $user->pages()->select('id', 'user_id')->get();
            foreach($pages as $page){
                $page->user_id = $first_user->id;
                $page->save();
            }
        }

        $menusCount = $user->menus->count();
        if($first_user && $menusCount !== 0) {
            $menus = $user->menus()->select('id', 'user_id')->get();
            foreach($menus as $menu){
                $menu->user_id = $first_user->id;
                $menu->save();
            }
        }

        $videoGalleriesCount = $user->videoGalleries->count();
        if($first_user && $videoGalleriesCount !== 0) {
            $videoGalleries = $user->videoGalleries()->select('id', 'user_id')->get();
            foreach($videoGalleries as $videoGallery){
                $videoGallery->user_id = $first_user->id;
                $videoGallery->save();
            }
        }

        $ramadansCount = $user->ramadans->count();
        if($first_user && $ramadansCount !== 0) {
            $ramadans = $user->ramadans()->select('id', 'user_id')->get();
            foreach($ramadans as $ramadan){
                $ramadan->user_id = $first_user->id;
                $ramadan->save();
            }
        }

        $slidersCount = $user->sliders->count();
        if($first_user && $slidersCount !== 0) {
            $sliders = $user->sliders()->select('id', 'author')->get();
            foreach($sliders as $slider){
                $slider->author = $first_user->id;
                $slider->save();
            }
        }


        $polls = $user->polls->count();
        $posts = $user->posts->count();
        $ads = $user->ads->count();
        $categories = $user->categories->count();
        $subCategories = $user->subCategories->count();
        $subMenus = $user->subMenus->count();
        $photos = $user->photos->count();
        $pages = $user->pages->count();
        $menus = $user->menus->count();
        $videoGalleries = $user->videoGalleries->count();
        $ramadans = $user->ramadans->count();
        $sliders = $user->sliders->count();

        $total_relation = $polls + $posts + $ads + $categories + $subCategories + $subMenus + $photos + $pages + $menus + $videoGalleries + $ramadans + $sliders;
        
        if($total_relation == 0) {
            $user->delete();
            Session::flash('success', 'Successfully Deleted');
        }else{
            Session::flash('danger', 'don\'t Deleted. This record related another records');
        }
        return Redirect()->route('admin.index');
    }

    //staff
    protected function staff_index(){
        $staffs = User::whereIn('role', ['accountant', 'manager'])->get();
        return view('back.user.staff.staff_index', compact('staffs'));
    }

    protected function staff_create(){
        return view('back.user.staff.staff_create');
    }

    protected function staff_store(Request $request){

        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password|min:8',
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);

        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/profile/'), $fileName);
            $user->photo = $fileName;
        }

        $user->save();
        return Redirect()->route('staff.index')->with('success',  'Staff inserted successfully');
    }

    protected function staff_edit($id){
        $staff = User::find($id);
        return view('back.user.staff.staff_edit', compact('staff'));
    }

    protected function staff_update(Request $request, $id){
        $user = User::find($id);
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email,'.$user->id.',id',
            'role' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password|min:8',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);

        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/profile/'), $fileName);
            $user->photo = $fileName;
        }
        $user->save();
        return Redirect()->route('staff.index')->with('success',  'Staff updated successfully');
    }

    protected function staff_destroy($id){
        $staff = User::find($id);
        return Redirect()->route('staff.index')->with('success',  'Staff deleted successfully');
    }

    // status toggle button 
    public function changeUserStatus(Request $request)
    {   
        $user = User::find($request->id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success'=>'Change admin status successfully.']);
    }
}
