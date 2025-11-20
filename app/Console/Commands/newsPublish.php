<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Post;
use App\Models\LeadPost;
use App\Models\SchedulePost;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class newsPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /** publish_time
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('News publish started');
        $posts = SchedulePost::whereRaw("DATE_FORMAT(publish_time, '%Y-%m-%d %H:%i') = ?", [Carbon::now()->format('Y-m-d H:i')])->get();

        //post create 
        foreach ($posts as $post_item) {
            $post = new Post;
            $post->user_id = $post_item->user_id ?? null;
            $post->uniqid = unique_key();
            // $post->publisher_name = $writer_name;
            $post->rss = $post_item->rss;
            $post->scroll = $post_item->scroll;
            $post->reporter_id = $post_item->reporter_id;
            $post->headline = $post_item->headline;
            $post->sub_headline = $post_item->sub_headline;
            //video
            $post->video_url = $post_item->video_url;
            $post->video_from = $post_item->video_from;
            $post->video_id = $post_item->video_id;
            $post->video_thumbnail = $post_item->video_thumbnail;

            $post->slug = make_slug($post_item->headline);
            $post->excerpt = $post_item->excerpt;
            $post->post_content = $post_item->post_content;
            $post->podcast = $post_item->podcast;
            $post->featured_mini = $post_item->featured_image;
            $post->featured_image = $post_item->featured_image;
                
            $post->featured_image_caption = $post_item->featured_image_caption;
            $post->sticky = $post_item->sticky;
            $post->watermark = 0;
            $post->post_status = 1;
            $post->reporter_photo = $post_item->reporter_photo;
            $post->special = $post_item->special;
            $post->save();

            // JSON Decode 
            $categoryIds = json_decode($post_item->category_id, true); 
            if (!empty($categoryIds)) {
                $post->Category()->attach($categoryIds);
            }
            $sub_categoryIds = json_decode($post_item->sub_category_id, true); 
            if (!empty($sub_categoryIds)) {
                $post->subCategory()->attach($sub_categoryIds);
            }
            $divisionIds = json_decode($post_item->division_id, true); 
            if (!empty($divisionIds)) {
                $post->Division()->attach($divisionIds);
            }
            $districtIds = json_decode($post_item->district_id, true); 
            if (!empty($districtIds)) {
                $post->District()->attach($districtIds);
            }
            $upazilaIds = json_decode($post_item->upazila_id, true); 
            if (!empty($upazilaIds)) {
                $post->Upazila()->attach($upazilaIds);
            }
            if ($post_item->tag_list) {
                $tags = json_decode($post_item->tag_list, true); 
                foreach ($tags as $tag) {
                    if (!empty(trim($tag))) {
                        $item = Tag::firstOrCreate(['name' => $tag]);
                        $post->Tag()->attach($item->id);
                    }
                }
            }
            
            $lead_post_position = LeadPost::where('position', $post_item->sticky_position)->first();
            $lead_post_item = LeadPost::where('post_id', $post->id)->first();
            if ($post_item->sticky) {
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
            if (!empty($post_item->sticky_position)) {
                $lead_post = new LeadPost();
                $lead_post->position = $post_item->sticky_position;
                $lead_post->post_id = $post->id;
                $lead_post->save();
            }
            $post_item->delete(); //SchedulePost delete
            $this->info("News publish completed");
        }//foreach
        Log::info("Cron job executed at: " . now());
    }
}