<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Photo;
use App\Models\Setting;
use App\Models\Upazila;
use App\Models\Reporter;
use App\Models\Category;
use App\Models\Division;
use App\Models\District;
use App\Models\PollAnswer;
use App\Models\Livestream;
use App\Models\SubCategory;
use App\Models\VideoGallery;
use App\Models\Breakingnews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ApiController extends Controller
{

    public function dates()
    {
        $enDate = new \EasyBanglaDate\Types\BnDateTime('now', new \DateTimeZone('Asia/Dhaka'));
        $bdDate = new \EasyBanglaDate\Types\BnDateTime('now', new \DateTimeZone('Asia/Dhaka'));
        $bdDate = $bdDate->modify('+0 day');
        $eng_date = $enDate->getDateTime()->format('l, jS F Y');

        $enDate = new \EasyBanglaDate\Types\BnDateTime('now', new \DateTimeZone('Asia/Dhaka'));
        $bdDate = new \EasyBanglaDate\Types\BnDateTime('now', new \DateTimeZone('Asia/Dhaka'));
        $bdDate = $bdDate->modify('+0 day');
        $ban_date = $bdDate->format('jS F Y');
        return response()->json([
            'status' => 'success',
            'eng_date' => $eng_date,
            'ban_date' => $ban_date,
            
        ], 200);
    }

    public function latestPosts(){
        try {
            $setting = Setting::OrderBy('id','desc')->select('site_title', 'meta_keywords', 'meta_description', 'meta_image', 'site_url', 'site', 'meta_title', 'logo','scroll_bar', 'popular_tag')->first();
            // $latestPosts = Post::whereDate('created_at', Carbon::today())->where('post_status', 1)->orderBy('created_at', 'desc')->get();

            $latestPosts = Post::with(['categories:id,slug,name'])
            ->where('post_status', '1')
            ->orderBy('created_at', 'desc')
            ->limit(30)
            ->get([
                'id',
                'uniqid',
                'headline',
                'sub_headline',
                'excerpt',
                'featured_image',
                'post_status',
                'created_at'
            ]);

            $firstAd = ad_by_position(1);

            return response()->json([
                'status' => 'success',
                'setting' => $setting,
                'latestPosts' => $latestPosts,
                'firstAd' => $firstAd,
            ], 200);
            
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error fetching latest news: ' . $e->getMessage());
    
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to fetch latest news at the moment.',
            ], 500);
        }
    }

    public function header()
    {
        try {
            $breakingnews = Breakingnews::latest()->take(20)->get();
            $enDate = new \EasyBanglaDate\Types\BnDateTime('now', new \DateTimeZone('Asia/Dhaka'));
            $bdDate = new \EasyBanglaDate\Types\BnDateTime('now', new \DateTimeZone('Asia/Dhaka'));
            $bdDate = $bdDate->modify('+0 day');
            $eng_date = $enDate->getDateTime()->format('l, jS F Y');
            
            $enDate = new \EasyBanglaDate\Types\BnDateTime('now', new \DateTimeZone('Asia/Dhaka'));
            $bdDate = new \EasyBanglaDate\Types\BnDateTime('now', new \DateTimeZone('Asia/Dhaka'));
            $bdDate = $bdDate->modify('+0 day');
            $ban_date = $bdDate->format('jS F Y');
            
            
            
            $menus = Menu::with(['subMenu' => function($query) {
                $query->orderBy('position', 'asc')
                      ->select('id', 'menu_id', 'url_text', 'url_path'); // include menu_id for relation
                }])
            ->orderBy('position', 'asc')
            ->select('id', 'url_text', 'url_path')
            ->limit(15) // safer than take + skip if skip is 0
            ->get();
            
            $desktopMenus = Menu::with(['subMenu' => function($query) {
                $query->orderBy('position', 'asc')
                      ->select('id', 'menu_id', 'url_text', 'url_path'); // include menu_id for relation
                }])
            ->orderBy('position', 'asc')
            ->select('id', 'url_text', 'url_path')
            ->get();
            
            
            $marqueePosts = Post::query()
            ->where('post_status', 1)
            ->where('scroll', 1)
            ->orderBy('id', 'desc')
            ->select('id', 'headline', 'featured_image')
            ->offset(0)
            ->limit(10)
            ->get();
            
            return response()->json([
                'status' => 'success',
                'breakingnews' => $breakingnews->isNotEmpty() ? $breakingnews : [],
                'eng_date' => $eng_date,
                'ban_date' => $ban_date,
                'menus' => $menus,
                'desktopMenus' => $desktopMenus,
                'marqueePosts' => $marqueePosts,
                
            ], 200);
            
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error fetching breaking news: ' . $e->getMessage());
    
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to fetch breaking news at the moment.',
            ], 500);
        }
    }

    public function settings()
    {
        $settings = Setting::orderBy('id', 'desc')
        ->select(
            'id',
            'admin_prefix',
            'site_url',
            'site',
            'site_title',
            'site_email',
            'editor',
            'address',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'meta_image',
            'fb_app_id',
            'logo',
            'favicon',
            'facebook',
            'twitter',
            'youtube',
            'instagram',
            'live_streaming_code',
            'streaming_status',
            'site_mobile',
            'linkedin',
            'lazy_image',
            'scroll_bar',
            'popular_tag',
            'feature_tag_id',
            'feature_tag_banner',
            'feature_tag_status'
        )
        ->first();

        $liveStream = Livestream::orderBy('id','desc')->select('status','content')->first();

        $videos = VideoGallery::orderBy('created_at', 'desc')->select('id', 'thumbnail', 'title', 'uniqid', 'created_at')->take(8)->get();

        $marqueePosts = Post::join('category_post', 'posts.id', '=', 'category_post.post_id') // Join category_post pivot table
            ->join('categories', 'category_post.category_id', '=', 'categories.id') // Join categories table
            ->select(
                'posts.id',
                'posts.uniqid',
                'posts.headline',
                'categories.slug as category_slug' // Select category slug
            )
            ->where('posts.post_status', 1)
            ->where('posts.scroll', 1)
            ->orderBy('posts.id', 'DESC')
            ->offset(0)
            ->limit(10)
            ->get();

        return response()->json([
            'status' => 'success',
            'settings' => $settings,
            'liveStream' => $liveStream,
            'videos' => $videos,
            'marqueePosts' => $marqueePosts,
        ], 200);
    
    }

    public function postSearch(Request $request)
    {
        $firstAd  = ad_by_position(4);
        $secondAd = ad_by_position(5);
        
        $searchTerm = $request->input('query'); // user search input
    
        // pagination params
        $limit = $request->query('limit', 12);
        $page  = $request->query('page', 1);
    
        $limit = is_numeric($limit) ? intval($limit) : 12;
        $page  = is_numeric($page)  ? intval($page)  : 1;
    
        // build query
        $posts = Post::with(['category:id,name,slug'])
            ->where(function ($q) use ($searchTerm) {
                $q->where('headline', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('post_content', 'LIKE', '%' . $searchTerm . '%');
            })
            ->select('posts.id', 'posts.uniqid', 'posts.headline', 'posts.excerpt', 'posts.featured_image', 'posts.created_at')
            ->orderBy('id', 'desc');
    
        // paginate correctly
        $paginated = $posts->paginate($limit, ['*'], 'page', $page);
        
        return response()->json([
            'status' => 'success',
            'firstAd' => $firstAd,
            'secondAd' => $secondAd,
            'posts' => $paginated->items(),
            'meta' => [
                'current_page' => $paginated->currentPage(),
                'last_page'    => $paginated->lastPage(),
                'per_page'     => $paginated->perPage(),
                'total'        => $paginated->total(),
            ],
        ], 200);
    }
    
    public function reporterPosts(Request $request, $id)
    {
        $reporter = Reporter::find($id);
    
        if (!$reporter) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Reporter not found'
            ], 404);
        }
        
        // pagination params
        $limit = $request->query('limit', 12);
        $page  = $request->query('page', 1);
    
        $limit = is_numeric($limit) ? intval($limit) : 12;
        $page  = is_numeric($page)  ? intval($page)  : 1;
    
        // build query
        $posts = Post::with(['category:id,name,slug'])
            ->where('post_status', '1')
            ->where('reporter_id', $reporter->id) // $reporter->id ব্যবহার
            ->select('posts.id', 'posts.uniqid', 'posts.headline', 'posts.excerpt', 'posts.featured_image', 'posts.created_at')
            ->orderBy('id', 'desc');
    
        // paginate correctly
        $paginated = $posts->paginate($limit, ['*'], 'page', $page);
    
    
        return response()->json([
            'status'  => 'success',
            'reporter' => $reporter,
            'posts'   => $paginated->items(),
            'meta'    => [
                'current_page' => $paginated->currentPage(),
                'last_page'    => $paginated->lastPage(),
                'per_page'     => $paginated->perPage(),
                'total'        => $paginated->total(),
            ],
        ], 200);
    }


    public function tagPosts(Request $request, $tagSlug)
    {
        // ✅ Find tag by slug or name
        $tag = Tag::where('slug', $tagSlug)
            ->orWhere('name', $tagSlug)
            ->first();

        if (!$tag) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tag not found',
            ], 404);
        }

        // ✅ Pagination parameters
        $limit = (int) $request->query('limit', 12);
        $page  = (int) $request->query('page', 1);

        // ✅ Handle exclude_ids as array or comma-separated string
        $excludeIds = $request->query('exclude_ids', []);
        if (!is_array($excludeIds)) {
            $excludeIds = array_filter(explode(',', $excludeIds));
        }

        // ✅ Query posts related to the tag
        $query = $tag->posts()
            ->where('posts.post_status', 1)
            ->when(!empty($excludeIds), fn($q) => $q->whereNotIn('posts.id', $excludeIds))
            ->select(
                'posts.id',
                'posts.headline',
                'posts.excerpt',
                'posts.featured_image',
                'posts.post_status',
                'posts.created_at'
            )
            ->with(['categories:id,slug'])
            ->orderByDesc('posts.id');

        // ✅ Paginate properly (keeps Laravel pagination metadata intact)
        $paginated = $query->paginate($limit, ['*'], 'page', $page);

        // ✅ Total posts in this tag (without exclusions)
        $totalAllPosts = $tag->posts()->where('posts.post_status', 1)->count();

        // ✅ Return clean JSON response
        return response()->json([
            'status' => 'success',
            'tag' => $tag,
            'posts' => $paginated->items(),
            'meta' => [
                'current_page' => $paginated->currentPage(),
                'last_page' => $paginated->lastPage(),
                'per_page' => $paginated->perPage(),
                'total' => $paginated->total(),
                'total_all_posts' => $totalAllPosts,
                'excluded_ids' => $excludeIds,
            ],
        ]);
    }


    public function categoryPost(Request $request, $categorySlug = null){
        $category = Category::where('slug',$categorySlug)->select('id','name','slug')->first();
        if (!$category) {
            return response()->json(['status' => 'error', 'message' => 'Category not found'], 404);
        }

        $subCategories = $category->SubCategory->select('id','name','slug')->all();
            
        $firstAd = ad_by_position(2);  //position 11
        $secondAd = ad_by_position(6);  //position 12
        
        $postOne = Category::find($category->id)
            ->posts()
            ->where('posts.post_status', 1)
            ->select('posts.id', 'posts.headline', 'posts.uniqid', 'posts.excerpt', 'posts.featured_image', 'posts.post_status', 'posts.created_at') // You MUST include the foreign key
            ->withPivot('category_id', 'post_id')
            ->orderBy('id', 'desc')
            ->first();
            
        $postFour = Category::find($category->id)
            ->posts()
            ->where('posts.post_status', 1)
            ->select('posts.id', 'posts.headline', 'posts.uniqid','posts.excerpt', 'posts.featured_image', 'posts.post_status', 'posts.created_at') // You MUST include the foreign key
            ->withPivot('category_id', 'post_id')
            ->orderBy('id', 'desc')
            ->skip(1)
            ->take(4)
            ->get();
        
        $excludeIds = $category->posts()->where('posts.post_status', 1)->latest('posts.created_at')->take(5)->pluck('posts.id');
        
        // pagination params
        $limit = $request->query('limit', 12);
        $page  = $request->query('page', 1);
    
        $limit = is_numeric($limit) ? intval($limit) : 12;
        $page  = is_numeric($page)  ? intval($page)  : 1;
        
        // query remaining posts excluding the ones above
        $query = $category->posts()
            ->where('posts.post_status', 1)->whereNotIn('posts.id', $excludeIds)
            ->select('posts.id', 'posts.headline', 'posts.excerpt', 'posts.featured_image', 'posts.post_status', 'posts.created_at')
            ->orderBy('posts.id', 'desc');
    
        // paginate (pass current page so pagination responds to ?page=)
        $paginated = $query->paginate($limit, ['*'], 'page', $page);
    
        // full count of all published posts in this category (optional)
        $totalAllPosts = $category->posts()->where('posts.post_status', 1)->count();
    
        return response()->json([
            'status' => 'success',
            'category' => $category,
            'subCategories' => $subCategories,
            'postOne' => $postOne,
            'postFour' => $postFour,
            'firstAd' => $firstAd,
            'secondAd' => $secondAd,
            // paginated posts (already exclude first 5)
            'posts' => $paginated->items(),
            'meta' => [
                'current_page' => $paginated->currentPage(),
                'last_page'    => $paginated->lastPage(),
                'per_page'     => $paginated->perPage(),
                'total'        => $paginated->total(),      // total after excluding postOne+postFour
                'total_all_posts' => $totalAllPosts,        // total count before excluding
                'excluded_ids'  => $excludeIds,
            ],
        ], 200);
    }


    public function subCategoryPost(Request $request, $categorySlug = null, $subCategorySlug = null)
    {
        $category = Category::where('slug', $categorySlug)->select('id','name','slug')->first();
        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ], 404);
        }
    
        $subCategory = SubCategory::where('slug', $subCategorySlug)
            ->where('category_id', $category->id) // ensure it belongs to the category
            ->select('id','name','slug','category_id')
            ->first();
    
        if (!$subCategory) {
            return response()->json([
                'status' => 'error',
                'message' => 'SubCategory not found'
            ], 404);
        }
        
        $subCategories = SubCategory::where('category_id', $category->id)->select('id','name','slug','category_id')->get();
        $adOne = ad_by_position(4);
        $adTwo = ad_by_position(5);
        
         $postOne = SubCategory::find($subCategory->id)
            ->posts()
            ->where('posts.post_status', 1)
            ->select('posts.id', 'posts.headline', 'posts.uniqid', 'posts.excerpt', 'posts.featured_image', 'posts.post_status', 'posts.created_at') 
            ->orderBy('id', 'desc')
            ->first();
            
        $postTwoFirst = SubCategory::find($subCategory->id)
            ->posts()
            ->where('posts.post_status', 1)
            ->select('posts.id', 'posts.headline', 'posts.uniqid', 'posts.excerpt', 'posts.featured_image', 'posts.post_status', 'posts.created_at')
            ->orderBy('id', 'desc')
            ->skip(1)
            ->take(2)
            ->get();
            
        $postTwoSecond = SubCategory::find($subCategory->id)
            ->posts()
            ->where('posts.post_status', 1)
            ->select('posts.id', 'posts.headline', 'posts.uniqid', 'posts.excerpt', 'posts.featured_image', 'posts.post_status', 'posts.created_at')
            ->orderBy('id', 'desc')
            ->skip(3)
            ->take(4)
            ->get();
            
        $excludeIds = $subCategory->posts()->where('posts.post_status', 1)->latest('posts.created_at')->take(5)->pluck('posts.id');
        
        // pagination params
        $limit = $request->query('limit', 12);
        $page  = $request->query('page', 1);
    
        $limit = is_numeric($limit) ? intval($limit) : 12;
        $page  = is_numeric($page)  ? intval($page)  : 1;
        
        // query remaining posts excluding the ones above
        $query = $subCategory->posts()
            ->where('posts.post_status', 1)->whereNotIn('posts.id', $excludeIds)
            ->select('posts.id', 'posts.headline', 'posts.excerpt', 'posts.featured_image', 'posts.post_status', 'posts.created_at')
            ->orderBy('posts.id', 'desc');
    
        // paginate (pass current page so pagination responds to ?page=)
        $paginated = $query->paginate($limit, ['*'], 'page', $page);
    
        // full count of all published posts in this category (optional)
        $totalAllPosts = $subCategory->posts()->where('posts.post_status', 1)->count();
    
    
        return response()->json([
            'status' => 'success',
            'category' => $category,
            'subCategory' => $subCategory,
            'subCategories' => $subCategories,
            'adOne' => $adOne,
            'adTwo' => $adTwo,
            'postOne' => $postOne,
            'postTwoFirst' => $postTwoFirst,
            'postTwoSecond' => $postTwoSecond,
            'posts' => $paginated->items(),
            'meta' => [
                'current_page' => $paginated->currentPage(),
                'last_page'    => $paginated->lastPage(),
                'per_page'     => $paginated->perPage(),
                'total'        => $paginated->total(),      // total after excluding postOne+postFour
                'total_all_posts' => $totalAllPosts,        // total count before excluding
                'excluded_ids'  => $excludeIds,
            ],
        ], 200);
    }

    //// home page first section
    public function homeFirstSection()
    {
        try {
            $settings = Setting::OrderBy('id','desc')->first();
            $specialPosts = Post::with('categories:id,slug') // only load category IDs
                ->where('post_status', 1)
                ->where('special', 1)
                ->orderBy('id', 'desc')
                ->select('id', 'uniqid', 'headline')
                ->offset(0)
                ->limit(4)
                ->get();

            $popularTags = popular_tags(5);
            
            $leadFirstPost = Post::join('lead_posts', 'posts.id', '=', 'lead_posts.post_id')
            ->join('category_post', 'posts.id', '=', 'category_post.post_id') // Join category_post pivot table
            ->join('categories', 'category_post.category_id', '=', 'categories.id') // Join categories table
            ->select(
                'posts.id',
                'posts.uniqid',
                'posts.headline',
                'posts.excerpt',
                'posts.featured_image',
                'posts.created_at',
                'categories.slug as category_slug' // Select category slug
            )
            ->where('posts.post_status', 1)
            ->orderBy('lead_posts.position', 'ASC')
            ->first();

            $leadSecondPost = Post::query()
            ->join('lead_posts', 'posts.id', '=', 'lead_posts.post_id')
            ->join('category_post', 'posts.id', '=', 'category_post.post_id')
            ->join('categories', 'category_post.category_id', '=', 'categories.id')
            ->where('posts.post_status', 1)
            ->select(
                'posts.id',
                'posts.uniqid',
                'posts.headline',
                'posts.excerpt',
                'posts.featured_image',
                DB::raw('MIN(categories.slug) as category_slug'),
                'lead_posts.position'
            )
            ->groupBy(
                'posts.id',
                'posts.uniqid',
                'posts.headline',
                'posts.excerpt',
                'posts.featured_image',
                'lead_posts.position'
            )
            ->orderBy('lead_posts.position', 'ASC')
            ->skip(1)
            ->take(2)
            ->get();


            $leadThirdPosts = Post::query()
                ->join('lead_posts', 'posts.id', '=', 'lead_posts.post_id')
                ->where('posts.post_status', 1)
                ->select(
                    'posts.id',
                    'posts.uniqid',
                    'posts.headline',
                    'posts.featured_image',
                    DB::raw('(
                        SELECT categories.name 
                        FROM categories 
                        JOIN category_post ON categories.id = category_post.category_id 
                        WHERE category_post.post_id = posts.id 
                        ORDER BY categories.id ASC 
                        LIMIT 1
                    ) AS category_name'),
                    DB::raw('(
                        SELECT categories.slug 
                        FROM categories 
                        JOIN category_post ON categories.id = category_post.category_id 
                        WHERE category_post.post_id = posts.id 
                        ORDER BY categories.id ASC 
                        LIMIT 1
                    ) AS category_slug'),
                    'lead_posts.position'
                )
                ->orderBy('lead_posts.position', 'ASC')
                ->skip(3)
                ->take(9)
                ->get();

            

            $leadRightAd = ad_by_position(1);
            
            
            $national = Category::select('id', 'name', 'slug')->find(2);
            $nationalOne = Category::find($national->id)->posts()->select('posts.id', 'posts.uniqid', 'posts.headline','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->first();
            $nationalTwo = Category::find($national->id)->posts()->select('posts.id', 'posts.uniqid', 'posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->skip(1)->take(2)->get();
            $nationalFive = Category::find($national->id)->posts()->select('posts.id', 'posts.uniqid', 'posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->skip(3)->take(5)->get();


            //politics
            $politics = Category::select('id', 'name', 'slug')->find(4);
            $politicsOne = Category::find($politics->id)->posts()->select('posts.id', 'posts.uniqid', 'posts.headline','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->first();
            $politicsTwo = Category::find($politics->id)->posts()->select('posts.id', 'posts.uniqid', 'posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->skip(1)->take(2)->get();
            $politicsFive = Category::find($politics->id)->posts()->select('posts.id', 'posts.uniqid', 'posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->skip(3)->take(5)->get();
            
            $latestPosts = Post::with('category:id,name,slug')->select('posts.id', 'posts.uniqid', 'posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('id', 'desc')->take(7)->get();
            $popularPosts = Post::with('category:id,name,slug')->where('created_at', '>=', Carbon::now()->subDays(30))->where('post_status', '1')->orderByDesc('view_count')->limit(7)->get(['id', 'uniqid', 'headline', 'sub_headline', 'excerpt', 'featured_image', 'post_status', 'created_at']);

            $international = Category::select('id', 'name', 'slug')->find(3);
            $internationalFour = Category::find($international->id)->posts()->select('posts.id', 'posts.uniqid', 'posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->skip(0)->take(6)->get();


            $feature = Category::select('id', 'name', 'slug')->find(1);
            $featureFour = Category::find($feature->id)->posts()->select('posts.id', 'posts.uniqid', 'posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->skip(0)->take(4)->get();

            $country = Category::select('id', 'name', 'slug')->find(6);
            $countryLeftTwo = Category::find($country->id)->posts()->select('posts.id', 'posts.uniqid', 'posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->skip(0)->take(2)->get();
            $countryRightTwo = Category::find($country->id)->posts()->select('posts.id', 'posts.uniqid', 'posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->skip(2)->take(2)->get();
            $countryRightAd = ad_by_position(2);
        

            return response()->json([
                'status' => 'success',
                'settings' => $settings,
                'specialPosts' => $specialPosts,
                'popularTags' => $popularTags,
                'leadFirstPost' => $leadFirstPost,
                'leadSecondPost' => $leadSecondPost,
                'leadThirdPosts' => $leadThirdPosts,
                'leadRightAd' => $leadRightAd,
                'national' => $national,
                'nationalOne' => $nationalOne,
                'nationalTwo' => $nationalTwo,
                'nationalFive' => $nationalFive,

                'politics' => $politics,
                'politicsOne' => $politicsOne,
                'politicsTwo' => $politicsTwo,
                'politicsFive' => $politicsFive,

                'latestPosts' => $latestPosts,
                'popularPosts' => $popularPosts,
                'international' => $international,
                'internationalFour' => $internationalFour,

                'feature' => $feature,
                'featureFour' => $featureFour,

                'country' => $country,
                'countryLeftTwo' => $countryLeftTwo,
                'countryRightTwo' => $countryRightTwo,
                'countryRightAd' => $countryRightAd,
                
            ], 200);
            
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error fetching breaking news: ' . $e->getMessage());
    
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to fetch breaking news at the moment.',
            ], 500);
        }
    }
    
    //// home page second section
    public function homeSecondSection()
    {
        try {
            $health = Category::select('id', 'name', 'slug')->find(16);
            $healthOne = $health->posts()
            ->select('posts.id', 'posts.uniqid', 'posts.headline', 'posts.featured_image', 'posts.post_status', 'posts.created_at')
            ->where('post_status', 1)
            ->orderBy('created_at', 'desc')
            ->first();

            // Next three posts (skip the latest)
            $healthThree = $health->posts()
            ->select('posts.id', 'posts.uniqid', 'posts.headline', 'posts.featured_image', 'posts.post_status', 'posts.created_at')
            ->where('post_status', 1)
            ->orderBy('created_at', 'desc')
            ->skip(1)
            ->take(3)
            ->get();

            $entertainment = Category::select('id', 'name', 'slug')->find(9);
            $entertainmentOne = $entertainment->posts()
            ->select('posts.id', 'posts.uniqid', 'posts.headline', 'posts.featured_image', 'posts.post_status', 'posts.created_at')
            ->where('post_status', 1)
            ->orderBy('created_at', 'desc')
            ->first();
            $entertainmentThree = $entertainment->posts()
            ->select('posts.id', 'posts.uniqid', 'posts.headline', 'posts.featured_image', 'posts.post_status', 'posts.created_at')
            ->where('post_status', 1)
            ->orderBy('created_at', 'desc')
            ->skip(1)
            ->take(3)
            ->get();

            $law = Category::select('id', 'name', 'slug')->find(20);
            $lawOne = $law->posts()
            ->select('posts.id', 'posts.uniqid', 'posts.headline', 'posts.featured_image', 'posts.post_status', 'posts.created_at')
            ->where('post_status', 1)
            ->orderBy('created_at', 'desc')
            ->first();
            $lawThree = $law->posts()
            ->select('posts.id', 'posts.uniqid', 'posts.headline', 'posts.featured_image', 'posts.post_status', 'posts.created_at')
            ->where('post_status', 1)
            ->orderBy('created_at', 'desc')
            ->skip(1)
            ->take(3)
            ->get();

            $opinion = Category::select('id', 'name', 'slug')->find(383);
            $opinionFour = $opinion->posts()
            ->select('posts.id', 'posts.uniqid', 'posts.headline', 'posts.featured_image', 'posts.post_status', 'posts.created_at')
            ->where('post_status', 1)
            ->orderBy('created_at', 'desc')
            ->skip(0)
            ->take(4)
            ->get();

            // technology
            $technology = Category::select('id', 'name', 'slug')->find(12);
            $technologyOne = $technology->posts()
            ->select('posts.id', 'posts.uniqid', 'posts.headline', 'posts.featured_image', 'posts.post_status', 'posts.created_at')
            ->where('post_status', 1)
            ->orderBy('created_at', 'desc')
            ->first();
            $technologyThree = $technology->posts()
            ->select('posts.id', 'posts.uniqid', 'posts.headline', 'posts.featured_image', 'posts.post_status', 'posts.created_at')
            ->where('post_status', 1)
            ->orderBy('created_at', 'desc')
            ->skip(1)
            ->take(3)
            ->get();

            $videoOne =  VideoGallery::orderBy('created_at', 'desc')->select('id','thumbnail','title', 'uniqid', 'created_at')->first();
            $videoFive = VideoGallery::orderBy('created_at', 'desc')->select('id','thumbnail','title', 'uniqid', 'created_at')->skip(1)->take(5)->get();

            $photos = Photo::with('photobodies')->orderBy('id', 'desc')->skip(0)->take(4)->get();

            $photoFour = [];
            
            foreach ($photos as $photo) {
                $photoFour[] = [
                    'photo' => [
                        'id' => $photo->id,
                        'title' => $photo->title,
                        'featured_image' => $photo->featured_image,
                    ],
                    'photobodies' => $photo->photobodies->map(function ($body) {
                        return [
                            'thumbnail' => $body->thumbnail,
                            'caption' => $body->caption,
                        ];
                    })->toArray(), // Important: convert from Collection to array
                ];
            }

                  

            $education = Category::select('id', 'name', 'slug')->find(15);
            $educationOne = $education->posts()
            ->select('posts.id', 'posts.uniqid', 'posts.headline', 'posts.featured_image', 'posts.post_status', 'posts.created_at')
            ->where('post_status', 1)
            ->orderBy('created_at', 'desc')
            ->first();
            $educationThree = $education->posts()
            ->select('posts.id', 'posts.uniqid', 'posts.headline', 'posts.featured_image', 'posts.post_status', 'posts.created_at')
            ->where('post_status', 1)
            ->orderBy('created_at', 'desc')
            ->skip(1)
            ->take(3)
            ->get();

            $relegion = Category::select('id', 'name', 'slug')->find(270);
            $relegionOne = $relegion->posts()
            ->select('posts.id', 'posts.uniqid', 'posts.headline', 'posts.featured_image', 'posts.post_status', 'posts.created_at')
            ->where('post_status', 1)
            ->orderBy('created_at', 'desc')
            ->first();
            $relegionThree = $relegion->posts()
            ->select('posts.id', 'posts.uniqid', 'posts.headline', 'posts.featured_image', 'posts.post_status', 'posts.created_at')
            ->where('post_status', 1)
            ->orderBy('created_at', 'desc')
            ->skip(1)
            ->take(3)
            ->get();


            $economy = Category::select('id', 'name', 'slug')->find(5); 
            $economyOne = $economy->posts()
            ->select('posts.id', 'posts.uniqid', 'posts.headline', 'posts.featured_image', 'posts.post_status', 'posts.created_at')
            ->where('post_status', 1)
            ->orderBy('created_at', 'desc')
            ->first();
            $economyThree = $economy->posts()
            ->select('posts.id', 'posts.uniqid', 'posts.headline', 'posts.featured_image', 'posts.post_status', 'posts.created_at')
            ->where('post_status', 1)
            ->orderBy('created_at', 'desc')
            ->skip(1)
            ->take(3)
            ->get();


            $sports =  Category::select('id', 'name', 'slug')->find(8); 
            $sportsOne = $sports->posts()
            ->select('posts.id', 'posts.uniqid', 'posts.headline', 'posts.featured_image', 'posts.post_status', 'posts.created_at')
            ->where('post_status', 1)
            ->orderBy('created_at', 'desc')
            ->first();
            $sportsThree = $sports->posts()
            ->select('posts.id', 'posts.uniqid', 'posts.headline', 'posts.featured_image', 'posts.post_status', 'posts.created_at')
            ->where('post_status', 1)
            ->orderBy('created_at', 'desc')
            ->skip(1)
            ->take(3)
            ->get();


            
            
            return response()->json([
                'status' => 'success',

                'health' => $health,
                'healthOne' => $healthOne,
                'healthThree' => $healthThree,

                'entertainment' => $entertainment,
                'entertainmentOne' => $entertainmentOne,
                'entertainmentThree' => $entertainmentThree,

                'law' => $law,
                'lawOne' => $lawOne,
                'lawThree' => $lawThree,

                'opinion' => $opinion,
                'opinionFour' => $opinionFour,

                'sports' => $sports,
                'sportsOne' => $sportsOne,
                'sportsThree' => $sportsThree,

                'videoOne' => $videoOne,
                'videoFive' => $videoFive,

                'photoFour' => $photoFour,

                'education' => $education,
                'educationOne' => $educationOne,
                'educationThree' => $educationThree,

                'relegion' => $relegion,
                'relegionOne' => $relegionOne,
                'relegionThree' => $relegionThree,

                'technology' => $technology,
                'technologyOne' => $technologyOne,
                'technologyThree' => $technologyThree,

                'economy' => $economy,
                'economyOne' => $economyOne,
                'economyThree' => $economyThree,
                
            ], 200);
            
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error fetching breaking news: ' . $e->getMessage());
    
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to fetch posts at the moment.',
            ], 500);
        }
    }

    public function getLocations(Request $request)
    {
        if ($request->has('division_id')) {
            // return districts under division
            return District::where('division_id', $request->division_id)->get(['id', 'name']);
        }

        if ($request->has('district_id')) {
            // return upazilas under district
            return Upazila::where('district_id', $request->district_id)->get(['id', 'name']);
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }

    public function getLocationNews(Request $request){
        // dd($request);
        $divisions = DB::table('divisions')->get();

        $division_id = $request->division_id;
        $district_id = $request->district_id;
        $upazila_id = $request->upazila_id;
        $related_district = null;
        $related_upazila = null;
        if($division_id){
            $related_district = District::where('division_id',$division_id)->get();
        }
        if($district_id){
            $related_upazila = Upazila::where('district_id',$district_id)->get();
        }

        $active_division = Division::find($division_id);
        $active_district = District::find($district_id);
        $active_upazila = Upazila::find($upazila_id);
        // dd($active_division);
        if($upazila_id != null){
            $all_bd_news = Upazila::find($upazila_id)->Posts()->orderBy('created_at', 'desc')->skip(0)->take(10)->get();
            $active_upazila = Upazila::find($upazila_id);
            return view('_front.pages.country_news', compact('related_district', 'related_upazila', 'all_bd_news','divisions','division_id','district_id','upazila_id','active_division','active_district','active_upazila'));
        }
        else if($upazila_id == null and $district_id != null){
            $all_bd_news = District::find($district_id)->Posts()->orderBy('created_at', 'desc')->skip(0)->take(10)->get();
            $active_district = District::find($district_id);
            return view('_front.pages.country_news', compact('related_district', 'related_upazila', 'all_bd_news','divisions','division_id','district_id','upazila_id','active_division','active_district','active_upazila'));
        }
        else if($upazila_id == null and $district_id == null){
            $all_bd_news = Division::find($division_id)->Posts()->orderBy('created_at', 'desc')->skip(0)->take(10)->get();
            return view('_front.pages.country_news', compact('related_district', 'related_upazila', 'all_bd_news','divisions','division_id','district_id','upazila_id','active_division','active_district','active_upazila' ));
        }
        else{
            return view('_front.pages.home');
        }
    }

    public function videos(Request $request)
    {
        $limit = $request->query('limit', 12);
        $page = $request->query('page', 1);
    
        $limit = is_numeric($limit) ? intval($limit) : 12;
        $page = is_numeric($page) ? intval($page) : 1;
    
        $query = VideoGallery::orderBy('created_at', 'desc')
                  ->select('id', 'thumbnail', 'title', 'uniqid', 'created_at');
    
        $paginated = $query->paginate($limit);
    
        return response()->json([
            'status' => 'success',
            'data' => $paginated->items(),
            'meta' => [
                'current_page' => $paginated->currentPage(),
                'last_page' => $paginated->lastPage(),
                'per_page' => $paginated->perPage(),
                'total' => $paginated->total(),
            ]
        ], 200);
    }

   
    public function singleVideoGallery($uniqid){
        $singleVideo = VideoGallery::where('uniqid',$uniqid)->first();
        $singleVideo->view_count = $singleVideo->view_count + 1;
        $singleVideo->save();
        $anothervideos = VideoGallery::orderBy('created_at', 'desc')->select('id','thumbnail','title', 'uniqid', 'created_at')->take(7)->get();
        $adOne = ad_by_position(14);
        $adTwo = ad_by_position(15);
        
        return response()->json([
            'status' => 'success',
            'singleVideo' => $singleVideo,
            'anotherVideos' => $anothervideos,
            'adOne' => $adOne,
            'adTwo' => $adTwo,
        ],200);
    }

    public function singlePost($categorySlug, $uniqid)
    {
        $settings = Setting::OrderBy('id','desc')->first();
        $firstAd = ad_by_position(3);
        $secondAd = ad_by_position(4);
        $thirdAd = ad_by_position(5);
        $fourthAd = ad_by_position(6);
    
        // Find category
        $category = Category::where('slug', $categorySlug)
            ->select('id','name','slug')
            ->first();
    
        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ], 404);
        }
    
        // Find single post
        $singlePost = Post::with(['user:id,short_name', 'reporter:id,name,designation', 'tags:id,name,slug'])->where('uniqid', $uniqid)->first();
    
        if (!$singlePost) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post not found'
            ], 404);
        }
    
   
    
        // Related posts by category
        $categoryRelatedPosts = $category->posts()
            ->where('posts.post_status', 1)
            ->select(
                'posts.id',
                'posts.uniqid',
                'posts.headline',
                'posts.featured_image',
                'posts.post_status',
                'posts.created_at'
            )
            ->with(['categories:id,slug,name']) // eager load category slug
            ->orderBy('posts.id', 'desc')
            ->skip(0)
            ->take(8)
            ->get();
    
        // Empty arrays (for now)
        // Current timestamp (if needed)
        $current_date = now(); // Carbon instance
        
        // Popular posts - top 7 by view_count
        $popularPosts = Post::with(['categories:id,slug,name'])
            ->where('post_status', '1')
            ->orderByDesc('view_count')
            ->limit(7)
            ->get([
                'id',
                'uniqid',
                'headline',
                'sub_headline',
                'excerpt',
                'featured_image',
                'post_status',
                'created_at'
            ]);
        
        // Latest posts - latest 7 by ID
        $latestPosts = Post::with(['categories:id,slug,name'])
            ->where('post_status', '1')
            ->orderByDesc('id')
            ->limit(7)
            ->get([
                'id',
                'uniqid',
                'headline',
                'sub_headline',
                'excerpt',
                'featured_image',
                'post_status',
                'created_at'
            ]);
        return response()->json([
            'status' => 'success',
            'settings' => $settings,
            'firstAd' => $firstAd,
            'secondAd' => $secondAd,
            'thirdAd' => $thirdAd,
            'fourthAd' => $fourthAd,
            'category' => $category,
            'singlePost' => $singlePost,
            'categoryRelatedPosts' => $categoryRelatedPosts, // ✅ fixed key
            'popularPosts' => $popularPosts,
            'latestPosts' => $latestPosts,
        ], 200);
    }

    public function privacyPolicy()
    {
        try {
            $page = Page::select('id', 'title', 'content')
                ->where('slug', 'privacy-policy')
                ->first();
    
            if (!$page) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Privacy Policy not found'
                ], 404);
            }
    
            return response()->json([
                'status' => 'success',
                'data'   => $page,
            ]);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Privacy Policy fetch failed: ' . $e->getMessage());
    
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong while fetching the privacy policy.'
            ], 500);
        }
    }
    
    public function terms()
    {
        try {
            $page = Page::select('id', 'title', 'content')
                ->where('slug', 'terms')
                ->first();
    
            if (!$page) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Terms not found'
                ], 404);
            }
    
            return response()->json([
                'status' => 'success',
                'data'   => $page,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong while fetching the terms.'
            ], 500);
        }
    }
    
    public function contactUs()
    {
        try {
            $setting = Setting::OrderBy('id','desc')->first();
            
            if (!$setting) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'setting not found'
                ], 404);
            }
    
            return response()->json([
                'status' => 'success',
                'data'   => $setting,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong while fetching the contact us.'
            ], 500);
        }
    }
    
    public function aboutUs()
    {
        try {
            $page = Page::select('id', 'title', 'content')
                ->where('slug', 'about-us')
                ->first();
    
            if (!$page) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Terms not found'
                ], 404);
            }
    
            return response()->json([
                'status' => 'success',
                'data'   => $page,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong while fetching the terms.'
            ], 500);
        }
    }





    // ===================================================================================
    // ===================================================================================
    // ===================================================================================
    // ===================================================================================
    // ===================================================================================
    // ===================================================================================
    
    
   
   
   // fetch active polls
    public function polls()
    {
        $polls = DB::table('polls')
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->select('id', 'question')
            ->get();

        $data = $polls->map(function ($poll) {
            $choices = DB::table('poll_choices')
                ->where('poll_id', $poll->id)
                ->select('id', 'poll_answer')
                ->get();

            $total_vote = PollAnswer::where('poll_id', $poll->id)->count();

            $choices = $choices->map(function ($choice) use ($poll) {
                $vote_count = PollAnswer::where('poll_answer_id', $choice->id)->count();
                return [
                    'id' => $choice->id,
                    'poll_answer' => $choice->poll_answer,
                    'vote_count' => $vote_count,
                ];
            });

            return [
                'id' => $poll->id,
                'question' => $poll->question,
                'total_vote' => $total_vote,
                'choices' => $choices,
            ];
        });

        return response()->json($data);
    }

    // vote on a poll
    public function vote(Request $request)
    {
        $request->validate([
            'poll_id' => 'required|integer',
            'poll_choice' => 'required|integer',
            
            'session_id' => 'nullable|string',
        ]);
        
        $sessionId = $request->session_id; 
        // $sessionId = $request->session()->getId();
        
        // check if already voted
        $alreadyVoted = PollAnswer::where('poll_id', $request->poll_id)
            ->where('session_id', $sessionId)
            ->first();

        if ($alreadyVoted) {
            return response()->json(['message' => 'You already voted!'], 409);
        }

        // save vote
        PollAnswer::create([
            'poll_id' => $request->poll_id,
            'poll_answer_id' => $request->poll_choice,
            'session_id' => $sessionId,
        ]);

        return response()->json(['message' => 'Vote submitted successfully!']);
    }
   
}