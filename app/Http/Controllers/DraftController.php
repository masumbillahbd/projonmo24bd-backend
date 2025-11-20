<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Draft;
use App\Models\Category;
use App\Models\LeadPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class DraftController extends Controller
{

    public function index()
    {
        
        if(Auth::user()->role == 'user'){
            $draft = Draft::where('user_id',Auth::user()->id)->orderby('id','desc')->Paginate(20);
            return view('back.draft.draft_index', compact('draft'));
        }
        $draft = Draft::orderby('id','desc')->Paginate(20);
        return view('back.draft.draft_index', compact('draft'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'headline' => 'required',
            'post_content' => 'required',
            'excerpt' => 'required',
            'category_id' => 'required'
        ]);
        $draft = Draft::find($id);
        if(!empty($draft)){
            $draft = Draft::find($id);
            $draft->category()->detach();
            $draft->Tag()->detach();
            $draft->delete();
        }

        $post = new Post;
        $request->publisher_name ? $writer_name = $request->publisher_name : $writer_name = Auth::user()->name;
        $slug = make_slug($request->headline);
        $request->excerpt ? $excerpt = $request->excerpt : $excerpt = strip_tags(substr($request->post_content, 0, 200));
       
        $post = new Post;
        
        $post->user_id = Auth::user()->id;
        $post->uniqid = unique_key();
        $post->publisher_name = $writer_name;
        $post->headline = $request->headline;
        $post->sub_headline = $request->sub_headline;

        $post->slug = $slug;
        $post->excerpt = $excerpt;
        $post->post_content = $request->post_content;
        
        if($request->hasfile('featured_image')){
            $file = $request->file('featured_image');
            $originalName = time().'_'.$file->getClientOriginalName();
            $fileName =   url('/').'/news/'.$originalName;
            $file->move(public_path('news'), $fileName);
            $post->featured_image = $fileName;
        }else{
            $post->featured_image = $draft->featured_image;
        }
            
        $post->featured_image_caption = $request->featured_image_caption;
        $post->sticky = $request->sticky ? 1 : 0;
        $post->watermark = $request->watermark ? 1 : 0;
        $post->post_status = $request->post_status ? 0 : 1;
        $post->reporter_photo = $request->reporter_photo;
        // $post->sub_cat_id = $request->sub_cat_id;
        $post->special = $request->special;

        $post->save();
        
        if ($request->category_id) {
            $post->Category()->attach($request->category_id);
        }

        if ($request->tag_list) {
            $tags = explode(',', $request->tag_list);
            foreach ($tags as $tag) {
                $item = Tag::firstOrCreate(['name' => $tag]);
                $post->Tag()->attach($item->id);
            }
        }

        $lead_post_position = LeadPost::where('position', $request->sticky_position)->first();
        $lead_post_item = LeadPost::where('post_id', $post->id)->first();
        if ($request->sticky) {
            if ($lead_post_item) {
                $lead_post_item->delete();
            }
            if ($lead_post_position) {
                $leadposts = LeadPost::orderBy('position', 'asc')->get();
                foreach ($leadposts as $leadpost) {
                    if ($leadpost->position == $lead_post_position->position || $leadpost->position > $lead_post_position->position) {
                        $leadpost->position = $leadpost->position + 1;
                        $leadpost->save();
                    }
                }
            }
        } else {
            if ($lead_post_item) {
                $lead_post_item->delete();
            }
        }
        if (!empty($request->sticky_position)) {
            $lead_post = new LeadPost();
            $lead_post->position = $request->sticky_position;
            $lead_post->post_id = $post->id;
            $lead_post->save();
        }
        Session::flash('success', 'Successfully Added');

        return Redirect::route('post.index');
    }

    public function show(Draft $draft)
    {
        //
    }

    public function edit($draft)
    {
        $post = Draft::find($draft);
        $categories = Category::orderBy('position','asc')->get();
        $tags = Tag::pluck('name')->toArray();
        return view('back.draft.draft_edit', compact('post', 'categories','tags'));
    }

    public function update(Request $request, Draft $draft)
    {
        //
    }

    public function destroy( $id)
    {
        $post = Draft::find($id);
        $post->category()->detach();
        $post->Tag()->detach();
        $post->delete();
        Session::flash('success', 'Successfully Deleted');

        return Redirect::back();
    }
}
