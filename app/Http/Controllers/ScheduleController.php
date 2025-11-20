<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Division;
use App\Models\SchedulePost;
use Illuminate\Http\Request;
use App\Services\PostEditService;
use App\Services\PostCreateService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ScheduleController extends Controller{

    protected $postCreateService;
    protected $postEditService;

    public function __construct(PostCreateService $postCreateService, PostEditService $postEditService)
    {
        $this->postCreateService = $postCreateService;
        $this->postEditService = $postEditService;
    }
    
    public function index(){
        $posts = SchedulePost::orderby('publish_time','asc')->paginate(10);
        return view('back.post.schedule_post', compact('posts'));
    }
    
    public function edit($id){
        $divisions = Division::all();
        $post = SchedulePost::find($id);
        $categories = Category::orderBy('position','asc')->get();
        return view('back.post.schedule_edit', compact('divisions','post', 'categories'));
    }

    public function show($id){
        $divisions = Division::all();
        $post = SchedulePost::find($id);
        $categories = Category::orderBy('position','asc')->get();
        return view('back.post.schedule_show', compact('divisions','post', 'categories'));
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
        
        $validation = $request->validate([
            'headline' => 'required|string|max:255|unique:schedule_posts,headline,' . $id,
            'sub_headline' => 'nullable|string|max:255',
            'excerpt' => 'required|string|max:1500',
            'sticky_position' => 'nullable|integer|max:2147483647',
            'sticky' => 'nullable|integer|max:1',
            'post_content' => 'required|string|max:65535',
            'featured_image' => 'nullable|string|max:255',
            'featured_image_caption' => 'nullable|string|max:250',
            'publisher_name' => 'nullable|string|max:250',
            'category_id' => 'required|integer|max:2147483647',
            'sub_category_id' => 'nullable|integer|max:2147483647',
            'division_id' => 'nullable|integer|max:2147483647',
            'district_id' => 'nullable|integer|max:2147483647',
            'upazila_id' => 'nullable|integer|max:2147483647',
            'tag_list' => 'nullable|string|max:150',
        ]);
      
        $tagsString = $request['tag_list'];  // Example: "Delectus dolore sed,dafdgfdsg!@@#$%^&*(),demo"
        // Split the string by commas into an array
        $tagsArray = explode(',', $tagsString);  // Converts string into array
        // Clean each tag using preg_replace
        $cleanedTagsArray = array_map(function($tag) {
            // Remove any special characters (except letters, numbers, and spaces)
            return preg_replace('/[^A-Za-z0-9\s]/', '', $tag);
        }, $tagsArray);
        $sticky_position = $request['sticky_position'] ? preg_replace('/[^\p{L}\p{N}\s]/u', '', $request['sticky_position']) : null;
        // $writer_name  = $request['publisher_name'] ?? $writer_name = Auth::user()->name;
        $excerpt = $request['excerpt'] ?? strip_tags(substr($request['post_content'], 0, 400));
        $publish_time = Carbon::parse($request['publish_time'])->format('Y-m-d H:i');
        $post =SchedulePost::find($id);
        $post->user_id = Auth::user()->id;
        $post->headline = $request['headline'];
        $post->sub_headline = $request['sub_headline'];
        $post->excerpt = $excerpt;
        $post->post_content = $request['post_content'];
        // Featured image handling
        if (isset($request['featured_image'])) {
            $post->featured_mini = $request['featured_image'];
            $post->featured_image = $request['featured_image'];
        }else{
            $post->featured_image = '/defaults/lazy_logo.jpg';
            $post->featured_mini = '/defaults/lazy_logo.jpg';
        }
        $post->featured_image_caption = $request['featured_image_caption'];
        $post->rss = isset($request['rss']) && $request['rss'] == 'on' ? 1 : 0;
        $post->sticky = isset($request['sticky']) && $request['sticky'] == 'on' ? 1 : 0;
        $post->sticky_position = $sticky_position;
        $post->post_status = 1;
        $post->publish_time = $publish_time ?? null;
        $post->tag_list = json_encode($cleanedTagsArray);  // Store as JSON
        $post->category_id = json_encode($request['category_id']);  // Store as JSON
        $post->sub_category_id = json_encode($request['sub_category_id']);  // Store as JSON
        $post->division_id = json_encode($request['division_id']);  // Store as JSON
        $post->district_id = json_encode($request['district_id']);  // Store as JSON
        $post->upazila_id = json_encode($request['upazila_id']);  // Store as JSON
        // Save post to database
        $post->save();
        Session::flash('success', 'Schedule Updated Successfully');
        return Redirect::route('post.schedule');
    }
    
    public function destroy($id)
    {
        $post = SchedulePost::find($id);
        $post->delete();
        Session::flash('success', 'Successfully Deleted');
        return Redirect::back();
    }
    
}