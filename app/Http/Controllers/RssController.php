<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Post;

class RssController extends Controller
{
    public function last_day_rss(){
       $posts = Post::orderBy('created_at','desc')->where('post_status', 1)->take(10)->get();
       $setting = Setting::orderBy('id','desc')->first();

        return response()->view('_front.rss.instant_articles', [
            'posts' => $posts,
            'setting' => $setting,
        ])->header('Content-Type', 'text/xml');
    }
}
