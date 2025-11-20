<?php
namespace App\Http\Controllers;
  
use App\Models\Post;
  
class SitemapController extends Controller
{
    
    public function index($value='')
    {
        $posts = Post::latest()->get();
        return response()->view('_front.sitemap.sitemap', [
            'posts' => $posts
        ])->header('Content-Type', 'text/xml');
    }
}