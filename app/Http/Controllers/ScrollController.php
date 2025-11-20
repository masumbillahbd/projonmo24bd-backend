<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScrollController extends Controller
{
    public function loadMorePosts(Request $request)
    {
        $category_id = 12; // You can dynamically pass this if needed
        $page = $request->get('page', 1);  // Page number from the AJAX request
        // Fetch posts for the given category and page
        $posts = posts_by_category($category_id, 2, $page);  // Modify as needed
        if ($posts->isEmpty()) {
            return response()->json(['status' => 'no_more_posts'], 200);
        }
        $output = '';
        foreach ($posts as $post) {
            $output .= view('srolldown.post', compact('post'))->render();  // Render each post using a partial view
        }
        return response()->json(['status' => 'success', 'html' => $output, 'next_page' => $page + 1]);
    }


}
