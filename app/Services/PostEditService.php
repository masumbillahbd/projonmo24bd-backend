<?php
namespace App\Services;

use App\Models\Tag;
use App\Models\Post;
use App\Models\LeadPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class PostEditService
{
    public function updatePost($request, $postId)
    {
        $sticky_position = $request['sticky_position'] ? preg_replace('/[^\p{L}\p{N}\s]/u', '', $request['sticky_position']) : null;
        $writer_name  = $request['publisher_name'] ?? $writer_name = Auth::user()->name;
        $excerpt = $request['excerpt'] ?? strip_tags(substr($request['post_content'], 0, 400));

        $post = Post::find($postId);
        $post->user_id = Auth::user()->id;
        $post->publisher_name = $writer_name;
        $post->reporter_id = $request['reporter_id'];
        $post->headline = $request['headline'];
        $post->sub_headline = $request['sub_headline'];
        //video
        $post->video_url = $request['video_url'];
        $post->video_from = $request['video_from'];
        $post->video_id = $request['video_id'];
        $post->video_thumbnail = $request['video_thumbnail'];
        $post->slug = make_slug($request['headline']);
        $post->excerpt = $excerpt;
        $post->post_content = $request['post_content'];
        // File upload for podcast
        if (isset($request['podcast']) && $request['podcast']->isValid()) {
            $file = $request['podcast'];
            $fileName = time() . '_podcast.' . $file->getClientOriginalExtension();
            $file->move(public_path('/podcast/'), $fileName);
            $post->podcast = $fileName;
        }
        // Featured image handling
        if (isset($request['featured_image'])) {
            $post->featured_mini = $request['featured_image'];
            $post->featured_image = $request['featured_image'];
        }else{
            $fDefault = setting('lazy_image') ?? 'defaults/lazy_logo.jpg';
            $post->featured_image = '/'.$fDefault;
            $post->featured_mini = '/'.$fDefault;
        }
        $post->featured_image_caption = $request['featured_image_caption'];
        $post->rss = isset($request['rss']) && $request['rss'] == '1' ? 1 : 0;
        $post->scroll = isset($request['scroll']) && $request['scroll'] == '1' ? 1 : 0;
        $post->sticky = isset($request['sticky']) && $request['sticky'] == '1' ? 1 : 0;
        $post->post_status = $request['post_status'] ?? 1;
        $post->reporter_photo = $request['reporter_photo'] ?? null;
        $post->special = $request['special'] ?? null;
        $post->category()->detach();
        $post->subCategory()->detach();
        $post->Tag()->detach();
        $post->division()->detach();
        $post->district()->detach();
        $post->upazila()->detach();
        if (isset($request['timeline_id']) && is_numeric($request['timeline_id'])) {
            $post->timelines()->detach();
        }         
        $post->save();


        if ($request['category_id']) {
            $post->Category()->attach($request['category_id']);
        }
        if ($request['sub_category_id']) {
            $post->subCategory()->attach($request['sub_category_id']);
        }
        if ($request['division_id']) {
            $post->Division()->attach($request['division_id']);
        }
        if ($request['district_id']) {
            $post->District()->attach($request['district_id']);
        }
        if ($request['upazila_id']) {
            $post->Upazila()->attach($request['upazila_id']);
        }
        if (isset($request['timeline_id']) && is_numeric($request['timeline_id'])) {
            $post->timelines()->attach((int) $request['timeline_id']);
        }        
        if ($request['tag_list']) {
            $tags = explode(',', $request['tag_list']);
            $cleanedTagsArray = array_map(function($tag) {
                return preg_replace('/[^A-Za-z0-9\s]/', '', $tag);
            }, $tags);
            foreach ($cleanedTagsArray as $tag) {
                if (!empty(trim($tag))) {
                    $item = Tag::firstOrCreate(['name' => $tag]);
                    $post->Tag()->attach($item->id);
                }
            }
        }
        $lead_post_position = LeadPost::where('position', $sticky_position)->first();
        $lead_post_item = LeadPost::where('post_id', $post->id)->first();
        if (isset($request['sticky'])) {
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
        if (!empty($sticky_position)) {
            $lead_post = new LeadPost();
            $lead_post->position = $sticky_position;
            $lead_post->post_id = $post->id;
            $lead_post->save();
        }
        Session::flash('success', 'Successfully Updated');
        return $post;
    }
}
