<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Division;
use App\Models\LeadPost;
use App\Models\ReadMore;
use App\Models\Timeline;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Services\PostEditService;
use Illuminate\Support\Facades\DB;
use App\Services\PostCreateService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class PostController extends Controller{
    protected $postCreateService;
    protected $postEditService;
    public function __construct(PostCreateService $postCreateService, PostEditService $postEditService)
    {
        $this->postCreateService = $postCreateService;
        $this->postEditService = $postEditService;
    }
    public function create(){
        $divisions = Division::all();
        $categories = Category::orderBy('position','asc')->get();
        // $banners = Banner::where('status',1)->orderBy('id','asc')->get();
        $timelines = Timeline::where('status',1)->pluck('id','name');
        return view('back.post.post_create', compact('divisions','categories','timelines'));
    }
    public function store(Request $request)
    {
        // date_default_timezone_set("Asia/Dhaka");
        $request->validate([
            'headline' => 'required|string|max:255|unique:posts,headline',
            'sub_headline' => 'nullable|string|max:255',
            'excerpt' => 'required|string|max:1500',
            'sticky_position' => 'nullable|integer|max:2147483647',
            'sticky' => 'nullable|integer|max:1',
            'post_content' => 'required|string|max:65535',
            'featured_image' => 'nullable|string|max:255',
            'featured_image_caption' => 'nullable|string|max:250',
            'reporter_photo' => 'nullable|string|max:250',
            'video_url' => 'nullable|string|max:350',
            'reporter_id' => 'nullable|integer|max:32767',
            'reporter_id' => 'nullable|integer|max:32767',
            'category_id' => 'required|integer|max:2147483647',
            'sub_category_id' => 'nullable|integer|max:2147483647',
            'division_id' => 'nullable|integer|max:2147483647',
            'district_id' => 'nullable|integer|max:2147483647',
            'upazila_id' => 'nullable|integer|max:2147483647',
            'tag_list' => 'nullable|string|max:150',
        ]);

        if($request->draft == 'draft'){
            $this->postCreateService->DraftStore($request->all());
        }else if($request->post_status == 0){
            $this->postCreateService->ScheduleDataStore($request->all());
        }else if($request->post_status == 1){
            $this->postCreateService->PostStore($request->all());
        }
        if(Auth::user()->role == 'user'){
            return Redirect::route('post.user');
        }
        return Redirect::route('post.create');
    }
    // index function
    public function edit($id){
        $divisions = Division::all();
        $post = Post::find($id);
        $categories = Category::orderBy('position','asc')->get();
        $timelines = Timeline::where('status',1)->pluck('id','name');
        return view('back.post.post_edit', compact('divisions','post', 'categories','timelines'));
    }
    public function update(Request $request, $id)
    {
        $request->merge([
            'category_id' => (int) $request->input('category_id'),
            'sub_category_id' => (int) $request->input('sub_category_id'),
            'division_id' => (int) $request->input('division_id'),
            'district_id' => (int) $request->input('district_id'),
            'upazila_id' => (int) $request->input('upazila_id'),
        ]);
        $request->validate([
            'headline' => 'required|string|unique:posts,headline,'.$id.',id',
            'sub_headline' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string|max:1500',
            'sticky_position' => 'nullable|integer|max:2147483647',
            'sticky' => 'nullable|integer|max:1',
            'post_content' => 'required|string|max:65535',
            'featured_image' => 'nullable|string|max:255',
            'featured_image_caption' => 'nullable|string|max:250',
            'reporter_photo' => 'nullable|string|max:250',
            'video_url' => 'nullable|string|max:350',
            'reporter_id' => 'nullable|integer|max:32767',
            'reporter_id' => 'nullable|integer|max:32767',
            'category_id' => 'required|integer|max:2147483647',
            'sub_category_id' => 'nullable|integer|max:2147483647',
            'division_id' => 'nullable|integer|max:2147483647',
            'district_id' => 'nullable|integer|max:2147483647',
            'upazila_id' => 'nullable|integer|max:2147483647',
            'tag_list' => 'nullable|string|max:150',
        ]);
        $this->postEditService->updatePost($request->all(), $id);
        if(Auth::user()->role == 'user'){
            return Redirect::route('post.user');
        }
        return Redirect::route('post.index');
    }
    public function destroy($id){
        $post = Post::find($id);
        
        $read_mode_leader = ReadMore::where('leader',$id)->get();
        $read_mode_post = ReadMore::where('post_id',$id)->get();
        if(!empty($read_mode_leader)){
            foreach($read_mode_leader as $leader){
                ReadMore::find($leader->id)->delete();
            }
        }
        if(!empty($read_mode_post)){
            foreach($read_mode_post as $readmore){
                ReadMore::find($readmore->id)->delete();
            }
        }

        DB::table('trashposts')->insert(
            ['post_id' => $post->id,'user_id' => $post->user_id,'deleted_by' => Auth::user()->id,'publisher_name' => $post->publisher_name,'headline' => $post->headline,'single_page_headline' => $post->single_page_headline,'sub_headline' => $post->sub_headline,'slug' => $post->slug,'excerpt' => $post->excerpt,'facebook_description' => $post->facebook_description,'post_content' => $post->post_content,'featured_image' => $post->featured_image,'featured_mini' => $post->featured_mini,'sticky' => $post->sticky,'post_status' => $post->post_status,'reporter_photo' => $post->reporter_photo,'last_update_by' => $post->last_update_by,'view_count' => $post->view_count,'featured_image_caption' => $post->featured_image_caption,'sm_image' => $post->sm_image,'rss' => $post->rss,'created_at' => $post->created_at,'updated_at' => $post->updated_at]
        );
        $post->Tag()->detach();
        $post->category()->detach();
        $post->district()->detach();
        $post->division()->detach();
        $post->upazila()->detach();
        $lead_post_item = LeadPost::where('post_id', $post->id)->first();
        if ($lead_post_item) {
            $lead_post_item->delete();
        }
        $post->delete();
        Session::flash('success', 'Successfully Deleted');
        return Redirect::back();
    }
    public function duplicate($id){
        $post = Post::findOrFail($id);
        $category = '';
        foreach($post->Category as $category){
            $category =$category->id;
        }
        $rand_code = '_copy';
        $newPost = $post->replicate();
        $newPost->headline = $post->headline.' '.$rand_code;
        $newPost->slug = $post->slug.'-'.$rand_code;
        $newPost->created_at = Carbon::now();
        $newPost->save();
        if(!empty($category)){
            $category = $category;
        }else{
            $category = Category::first()->id;
        }
        $newPost->category()->sync($category, false);
        return Redirect()->route('post.index')->with('success',  'Post duplicate successfully');
    }


    public function index()
    {
        $lead_posts = LeadPost::orderBy('position', 'asc')->skip(20)->take(PHP_INT_MAX)->get();
        if($lead_posts->count() > 0){
            foreach($lead_posts as $lead){
                $lead->delete();
            }
        }
        $posts = Post::orderby('id','desc')->paginate(15);
        if(Auth::user()->role == 'user'){
            return Redirect::route('post.user');
        }
        return view('back.post.post_index', compact('posts'));
    }

    public function post_filter(Request $request){
        $category_id = $request->category_id;
        if($category_id != null){
            $posts = Category::find($category_id)->posts()->where('post_status', 1)->orderBy('id', 'desc')->paginate(15);
            $posts->appends($request->all());
        }else if($request->sort_by == 'asc'){
            $posts = Post::where('post_status', 1)->orderBy('id', 'asc')->paginate(15);
            $posts->appends($request->all());
        }
        else if($request->sort_by == 'desc'){
            $posts = Post::where('post_status', 1)->orderBy('id', 'desc')->paginate(15);
            $posts->appends($request->all());
        }
        else{
            $posts = Post::orderby('id', 'desc')->paginate(15);
            $posts->appends($request->all());
        }
        return view('back.post.post_index', compact('posts','category_id'));
    }

    public  function search(Request $request){
        $query = $request->value;
        $post = Post::where('id', $query)->first();
        if(!empty($post)){
            $posts = Post::where('id', $query)->paginate(15);
        }else{
            $posts = Post::where('headline', 'LIKE', '%' . $query . '%')
                ->orWhere('post_content', 'LIKE', '%' . $query . '%')
                ->orWhere('id', 'LIKE' . $query )
                ->paginate(15);
        }
        $posts->appends($request->all());
        return view('back.post.post_index', compact('posts', 'query'));
    }

    public function trashpost_index(){
        $pageNumber = 10;
        $trashposts = DB::table('trashposts')->orderBy('created_at', 'desc')->paginate(15);
        return view('back.trashpost.index', compact('trashposts'));
    }
    public function trashpost_view($id){
        $trashpost = DB::table('trashposts')->where('id',$id)->first();
        return view('back.trashpost.view', compact('trashpost'));
    }
    public function trashpost_destroy($id){
        DB::table('trashposts')->where('id',$id)->delete();
        Session::flash('success', 'Successfully Deleted');
        return Redirect::back();
    }
    public function publicationStatus(Request $request){
        $post = Post::find($request->id);
        $post->post_status = $request->post_status;
        $post->save();
        return response()->json(['success'=>'Publication status change successfully.']);
    }
    public function tagLiveSearch(Request $request, $keyword){
        $tags = DB::table('tags')->select('name')->where('name','LIKE',$keyword.'%')->get();
        return Response::json($tags);
    }
    public function user_post(){
        $user_id = Auth::user()->id;
        $posts = Post::orderby('id','desc')->where('user_id', $user_id)->Paginate(15);
        return view('back.post.user_post', compact('posts'));
    }
    public function AjaxDistrict(Request $request){
        $division_id = $request->id;
        $districts = Division::find($division_id)->district()->orderBy('slug', 'asc')->get();
        return Response::json($districts);
    }
    public function AjaxUpazila(Request $request){
        $district_id = $request->id;
        $upazila = DB::table('upazilas')->where('district_id', $district_id)->get();
        return Response::json($upazila);
    }
    public function categorySubCategoyAJAX($category_id){
        $sub_category  = SubCategory::where('category_id',$category_id)->get();
        return Response::json($sub_category);
    }
    public function postsAutoSearch(Request $request){
        $query = $request->get('q');
        $post = Post::where('id', $query)->first();
        if(!empty($post)){
            $posts = Post::where('id', $query)->select('id','headline')->get();
        }else{
            $posts = Post::where('headline', 'LIKE', '%' . $query . '%')
                ->orWhere('id', 'LIKE' . $query )
                ->select('id','headline')
                ->get();
        }
        return response()->json($posts);
    }
}
