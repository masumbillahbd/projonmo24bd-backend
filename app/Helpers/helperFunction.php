<?php
use App\Models\Ad;
use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use App\Models\Photo;
use App\Models\Ramadan;
use App\Models\Setting;
use App\Models\Upazila;
use App\Models\Category;
use App\Models\District;
use App\Models\Division;
use App\Models\Reporter;
use App\Models\Timeline;
use App\Models\Photobody;
use App\Models\Viewcount;
use App\Models\Livestream;
use App\Models\SubCategory;
use App\Models\VideoGallery;
use Illuminate\Support\Facades\DB;

if (!function_exists('todays_news')) {
    function todays_news(){
        $today = Carbon::today()->toDateString();
        return Post::where([['created_at','LIKE',$today.'%'],['post_status', '1']])->orderBy('id','desc')->get();
    }
}

if (!function_exists('unique_key')) {
    function unique_key() {
        do {
            $uniqid = uniqid();
            $exists = Post::where('uniqid', $uniqid)->exists();
        } while ($exists);

        return $uniqid;
    }
}

if (!function_exists('sub_category_name')) {
    function sub_category_name($id){
        return SubCategory::find($id)->name ?? null;
    }
}
if (!function_exists('division_name')) {
    function division_name($id){
        return Division::find($id)->name ?? null;
    }
}
if (!function_exists('district_name')) {
    function district_name($id){
        return District::find($id)->name ?? null;
    }
}
if (!function_exists('upazila_name')) {
    function upazila_name($id){
        return Upazila::find($id)->name ?? null;
    }
}

// if (!function_exists('view_date_format')) {
//     function view_date_format($date,$format='d-m-Y'){
//         return Carbon::parse($date)->format($format);
//     }
// }

if (!function_exists('view_date_format')) {
    function view_date_format($date, $format = 'd-m-Y h:i A') {
        return \Carbon\Carbon::parse($date)->format($format);
    }
}


if (!function_exists('store_date_format')) {
    function store_date_format($date){
        return Carbon::parse($date)->format('Y-m-d');
    }
}

if (!function_exists('setting')) {
    function setting($col='') {
        if($col != null){
            return Setting::OrderBy('id','desc')->first()->$col;
        }else{
            return Setting::OrderBy('id','desc')->first();
        }
    }
}
if (!function_exists('checkNewsPopupStatus')) {
    function checkNewsPopupStatus($post_id=0,$session_id=''){
        return DB::table('popup_disable')->where('post_id', $post_id)->where('session_id', '=', $session_id)->first();
    }
}

if (!function_exists('today_ramadan')) {
    function today_ramadan($division=''){
        date_default_timezone_set('Asia/Dhaka');
        $date = date('Y-m-d');
        return Ramadan::where([['date',$date],['division',$division]])->first();
    }
}
if (!function_exists('today_one_ramadan')) {
    function today_one_ramadan(){
        date_default_timezone_set('Asia/Dhaka');
        $date = date('Y-m-d');
        return Ramadan::where('date',$date)->first();
    }
}

if (!function_exists('ramadan')) {
    function ramadan(){
        return Ramadan::orderby('position','asc')->get();
    }
}
if (!function_exists('livestream')) {
    function livestream(){
        return Livestream::orderBy('id','desc')->first();
    }
}
if (!function_exists('popular_post_by_date')) {
    function popular_post_by_date($take=10){
        $current_date = date("Y-m-d H:i:s");
        $date = date_create(date("Y-m-d H:i:s"));
        date_sub($date,date_interval_create_from_date_string("30 days"));
        return Post::where('post_status', '1')->orderBy('view_count','desc')->select('id','headline','sub_headline','excerpt','featured_image','post_status','created_at')->take($take)->get();
    }
}
function popular_post_by_category($category_id, $take=10){
    $date = date_create(date("Y-m-d H:i:s"));
    date_sub($date,date_interval_create_from_date_string("30 days"));
    return  Category::find($category_id)->Posts()->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('view_count','desc')->take($take)->get();
}
function popular_tags($take=8){
    return Tag::where('feature',1)->select('id','name','slug')->get();
}
if(!function_exists('view_counter')){
    function view_counter(){
        $today = Carbon::today()->toDateString();
        $Viewcount = Viewcount::where('date', $today)->first();
        if($Viewcount != null){
            $Viewcount->view = $Viewcount->view + 1;
            $Viewcount->save();
        }else{
            $Viewcount = new Viewcount();
            $Viewcount->date = $today;
            $Viewcount->view = $Viewcount->view + 1;
            $Viewcount->save();
        }
    }
}
if(!function_exists('post_updated_by')){
    function post_updated_by($id = 0){
        $user = User::where('id',$id)->first();
        if ($user != null) {
            return $user->name;
        }
        return null;
    }
}
if(!function_exists('post_updated_time')){
    function post_updated_time($time = 0){
        if ($time != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('H:i/d M Y');
        }
        return null;
    }
}
if(!function_exists('menu_query')){
    function menu_query($take=5, $skip=0, $order='asc'){
        if($take == 1){
            return Menu::OrderBy('position', $order)->select('id','url_path','url_text')->skip($skip)->first();
        }else{
            return Menu::OrderBy('position', $order)->select('id','url_path','url_text')->skip($skip)->take($take)->get();
        }
        return null;
    }
}
if(!function_exists('page_query')){
    function page_query($take=1,$skip=0,$order='desc'){
        if($take == 1){
            return Page::OrderBy('id', $order)->select('id','title','content')->skip($skip)->first();
        } else {
            return Page::OrderBy('id', $order)->skip($skip)->take($take)->get();
        }
        return null;
    }
}
if(!function_exists('page_url')){
    function page_url($slug){
        $page = Page::where('slug',$slug)->first();
        if(!empty($page)){
            return route('single.page', ['slug' => $page->slug ]);
        }
        return null;
    }
}

if(!function_exists('photo_query')){
    function photo_query($take=1, $skip=0, $order='desc'){
        if($take == 1){
            return Photo::orderBy('id', $order)->skip($skip)->first();
        }else{
            return Photo::orderBy('id', $order)->skip($skip)->take($take)->get();
        }
        return null;
    }
}
if(!function_exists('multiple_photo')){
    function multiple_photo($photo_id){
        return Photobody::where('photo_id',$photo_id)->get();
    }
}

if(!function_exists('post_scroll_query')){
    function post_scroll_query($take=10, $skip=0, $order='desc'){
        return Post::where([['post_status', '1'],['scroll', '1']])->orderBy('id', $order)->select('id','headline','sub_headline','excerpt','featured_image','post_status','created_at')->skip($skip)->take($take)->get();
    }
}
if(!function_exists('post_query')){
    function post_query($take=10, $skip=0,$order='desc'){
        return Post::where('post_status', '1')->orderBy('id', $order)->select('id','headline','sub_headline','excerpt','featured_image','post_status','created_at')->skip($skip)->take($take)->get();
    }
}
if(!function_exists('ad_by_position')){
    function ad_by_position($position = 1){
        return Ad::where('position', $position)->first();
    }
}
if(!function_exists('ad_query')){
    function ad_query($take=1, $skip=0, $order='asc'){
        if($take == 1){
            return Ad::orderBy('position', $order)->skip($skip)->first();
        }else{
            return Ad::orderBy('position', $order)->skip($skip)->take($take)->get();
        }
        return null;
    }
}

if(!function_exists('timeline_post')){
    function timeline_post($timeline_id, $take=10, $skip=0){
        $timeline = Timeline::find($timeline_id);
        if(!empty($timeline)){
            if($take == 1){
                return Timeline::find($timeline_id)->posts()->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->skip($skip)->first();
            }else{
                return Timeline::find($timeline_id)->posts()->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->skip($skip)->take($take)->get();
            }
        }
        return null;
    }
}

if(!function_exists('posts_by_category')){
    function posts_by_category($category_id, $take=10, $skip=0){
        $cat = Category::find($category_id);
        if(!empty($cat)){
            if($take == 1){
                return Category::find($cat->id)->posts()->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->skip($skip)->first();
            }else{
                return Category::find($cat->id)->posts()->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->skip($skip)->take($take)->get();
            }
        }
        return null;
    }
}

if(!function_exists('posts_by_reporter')){
    function posts_by_reporter($reporter_id, $take=10, $skip=0){
        return Post::where([['post_status', '1'],['reporter_id', $reporter_id]])->orderBy('created_at', 'desc')->select('id','headline','sub_headline','excerpt','featured_image','post_status','created_at')->skip($skip)->take($take)->paginate(20);
    }
}

if(!function_exists('reporter_url')){
    function reporter_url($reporter_id=0){
        $reporter_id = Reporter::find($reporter_id)->id ?? 0;
        if($reporter_id){
            return route('reporter.post', ['id' =>$reporter_id]);
        }
    }
}
if(!function_exists('posts_by_sub_category')){
    function posts_by_sub_category($sub_category_id, $take=10, $skip=0){
        $sub_cat = SubCategory::find($sub_category_id);
        if(!empty($sub_cat)){
            $subCatId = $sub_cat->id;
            if($take == 1) {
                return SubCategory::find($subCatId)->posts()->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->skip($skip)->take($take)->first();
            }else{
                return SubCategory::find($subCatId)->posts()->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->skip($skip)->take($take)->get();
            }
            if (!empty($posts_by_subcategory)) {
                return $posts_by_subcategory;
            }
            return $posts_by_subcategory = null;
        }
        return $posts_by_subcategory = null;
    }
}

if(!function_exists('posts_by_tag')){
    function posts_by_tag($tag_id, $take = 8, $skip = 0){
        if ($take == 1) {
            $posts = Tag::find($tag_id)->Posts()->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->skip($skip)->take($take)->first();
        } else {
            $posts = Tag::find($tag_id)->Posts()->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->skip($skip)->take($take)->get();
        }
        if (!empty($posts)) {
            return $posts;
        }
        return $posts = null;
    }
}

function category_slug($id){
    return Category::find($id)->slug;
}

function category_name($id){
    return Category::findOrFail($id)->name;
}

function tag_name($id){
    return Tag::findOrFail($id)->name;
}
function tag($id=0){
    $tag = Tag::where('id',$id)->first();
    if(!empty($tag)){
        return Tag::select('id','name')->findOrFail($id);
    }
    return null;
}
function category_url($id){
    return route('category.posts', ['category_slug' => Category::find($id)->slug ]);
}
if(!function_exists('sub_category_url')){
    function sub_category_url($sub_cat){
        $sub_cat = SubCategory::where('slug',$sub_cat)->first();
        $cat = Category::where('id', $sub_cat->category_id)->first();
        if ($sub_cat){
            return route('sub_cat.post', ['cat' => $cat->slug,'sub_cat' => $sub_cat->slug]);
        }
        return null;
    }
}

function tag_url($name){
    return route('tag.posts',['name' =>$name]);
}

if(!function_exists('notify_post_query')){
    function notify_post_query($amount=10,$skip=0,$order='desc'){
        return Post::where([['post_status', '1'],['notify', '0']])->select('posts.id','posts.headline','posts.excerpt','posts.featured_image','posts.created_at')->orderBy('id','desc')->skip($skip)->take($amount)->get();
    }
}
if(!function_exists('sticky_posts_by_position')){
    function sticky_posts_by_position($take=null, $skip=null){
        if($take == null){
            $sticky_post = Post::join('lead_posts', 'posts.id', '=', 'lead_posts.post_id')->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status')->orderBy('lead_posts.position', 'ASC')->where('post_status', 1)->get();
        }else{
            if($skip == null){
                $sticky_post = Post::join('lead_posts', 'posts.id', '=', 'lead_posts.post_id')->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status')->orderBy('lead_posts.position', 'ASC')->where('post_status', 1)->take($take)->skip(0)->get();
            }else{
                $sticky_post = Post::join('lead_posts', 'posts.id', '=', 'lead_posts.post_id')->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status')->orderBy('lead_posts.position', 'ASC')->where('post_status', 1)->take($take)->skip($skip)->get();
            }
        }
        if($take == 1){
            $sticky_post = Post::join('lead_posts', 'posts.id', '=', 'lead_posts.post_id')->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status')->orderBy('lead_posts.position', 'ASC')->where('post_status', 1)->first();
        }
        return $sticky_post;
    }
}
if(!function_exists('make_slug')){
    function make_slug($title){
        $title = preg_replace('[\‘]', '', $title);
        $title = preg_replace('[\’]', '', $title);
        $title = preg_replace('[/]', '', $title);
        $title = preg_replace('[,]', '', $title);
        $title = preg_replace('[\?]', '', $title);
        $title = preg_replace('[\!]', '', $title);
        $title = preg_replace('[\']', '', $title);
        $title = preg_replace('[\"]', '', $title);
        $title = preg_replace('[\:]', '', $title);
        $title = preg_replace('[\.]', '', $title);
        $title = preg_replace('[\)]', '', $title);
        $title = preg_replace('[\(]', '', $title);
        $title = str_replace(' ', '-', $title);
        $title = preg_replace('[-+]', '-', $title);
        $title = rtrim($title, "-");
        $title = strip_tags($title);
        $title = strtolower($title);
        return $title;
    }
}
function video_query($take=1, $skip=0, $order='desc'){
    if($take == 1) {
        return VideoGallery::orderBy('created_at', $order)->select('id','thumbnail','title', 'uniqid', 'created_at')->first();
    }else{
        return VideoGallery::orderBy('created_at', $order)->select('id','thumbnail','title', 'uniqid', 'created_at')->skip($skip)->take($take)->get();
    }
}
function all_video_query($order = 'desc', $show = 24){
    return VideoGallery::orderBy('id', $order)->paginate($show);
}
function single_video_query(){
    return VideoGallery::orderBy('created_at', 'desc')->first();
}
function Percent($total, $ans_count){
    if ($total == 0 or $ans_count == 0) {
        return 0;
    } else {
        $x = $total / $ans_count;
        $x = 100 / $x;
        $x = (int)$x;
        return $x;
    }
}
function todays_date() {
    $enDate = new \EasyBanglaDate\Types\BnDateTime('now', new \DateTimeZone('Asia/Dhaka'));
    $bdDate = new \EasyBanglaDate\Types\BnDateTime('now', new \DateTimeZone('Asia/Dhaka'));
    $bdDate = $bdDate->modify('+0 day');
    echo $enDate->getDateTime()->format('l, jS F Y, ') . $bdDate->format('jS F Y');
}
function todays_eng_date() {
    $enDate = new \EasyBanglaDate\Types\BnDateTime('now', new \DateTimeZone('Asia/Dhaka'));
    $bdDate = new \EasyBanglaDate\Types\BnDateTime('now', new \DateTimeZone('Asia/Dhaka'));
    $bdDate = $bdDate->modify('+0 day');
    echo $enDate->getDateTime()->format('l, jS F Y');
}
function todays_ban_date() {
    $enDate = new \EasyBanglaDate\Types\BnDateTime('now', new \DateTimeZone('Asia/Dhaka'));
    $bdDate = new \EasyBanglaDate\Types\BnDateTime('now', new \DateTimeZone('Asia/Dhaka'));
    $bdDate = $bdDate->modify('+0 day');
    echo $bdDate->format('jS F Y');
}
function e_to_b_int($input){
    $bn_digits=array('০','১','২','৩','৪','৫','৬','৭','৮','৯');
    return str_replace(range(0, 9),$bn_digits, $input);
}
function ampa_replace($input){
    $ban_month=array("এএম","পিএম");
    $eng_month=array("am","pm");
    return str_replace($eng_month,$ban_month, $input);
}
function news_url($post_id, $cat = null) {
    $post = Post::where('id',$post_id)->first();
    $category = $post->category()->first();
    if($category){
        return route('single.post', ['category' => $category->slug, 'id' => $post->uniqid]);
    }
    // If no category found, handle accordingly
    return route('single.post', ['category' => 'default-category', 'id' => $post->uniqid]); // Or some fallback logic
}
function news_url_for_readmore($post_id, $cat = null){
    $post = Post::where('id',$post_id)->first();
    $category = $post->category()->first();
    if ($category) {
        return route('single.post', ['category' => $category->slug, 'id' => $post->uniqid]);
    }
    // If no category found, handle accordingly
    return route('single.post', ['category' => 'default-category', 'id' => $post->uniqid]); // Or some fallback logic
}
function photo_url($photo) {
    return route('single.photo.gallery', ['category' => Photo::find($photo->id)->Category()->first()->slug, 'id' => $photo->id, 'title' => make_slug($photo->title)]);
}
function photo_category_url($category){
    return route('category.photo.gallery', ['category'=>Category::find($category->id)->slug]);
}
function video_url($uniqid) {
    $video = VideoGallery::where('uniqid',$uniqid)->first();
    // Check if video was found
    if (!$video) {
        return null;
    }
    return route('single.video.gallery', ['uniqid'=>$video->uniqid]);
}
function video_category_url($category){
    return route('category.video.gallery', ['category'=>Category::find($category->id)->slug]);
}
function publisher_photo($post) {
    return '<img src="'. $post->reporter_photo .'" alt="'.$post->headline.'" style="width: 70px">';
}

if(!function_exists('postVideoStream')){
    function postVideoStream($site,$video_id) {
        if($site == 'youtube'){
            $embed_code = '<div class="ratio ratio-16x9"><iframe src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0" allow="encrypted-media" allowfullscreen></iframe></div>';
        }elseif($site == 'facebook'){
            $embed_code = '<div class="ratio ratio-16x9"><iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2FPlayStation%2Fvideos%2F'.$video_id. '%2F&show_text=0&width=560" style="border:none;overflow:hidden" scrolling="no" allowTransparency="true" allowFullScreen="true" ></iframe></div>';
        }else{
            $embed_code = "Sorry, Something is Wrong. Please play another video.";
        }
        return $embed_code;
    }
}
if(!function_exists('embed_video')){
    function embed_video($video) {
        if ($video->streaming_site == 'youtube') {
            $embed_code = '<div class="ratio ratio-16x9"><iframe src="https://www.youtube.com/embed/'.$video->video_id.'" frameborder="0" allow="encrypted-media" allowfullscreen></iframe></div>';
        } elseif( $video->streaming_site == 'facebook') {
            $embed_code = '<div class="ratio ratio-16x9"><iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2FPlayStation%2Fvideos%2F'. $video->video_id . '%2F&show_text=0&width=560" style="border:none;overflow:hidden" scrolling="no" allowTransparency="true" allowFullScreen="true"></iframe></div>';
        } else {
            $embed_code = "Sorry, Something is Wrong. Please play another video.";
        }
        return $embed_code;
    }
}
if (! function_exists('words')) {
    function words($value, $words = 100, $end = ''){
        return \Illuminate\Support\Str::words($value, $words, $end);
    }
}
if (! function_exists('special_news')) {
    function special_news($take){
        return Post::where('post_status', '1')->where('special', 1)->orderBy('id', 'desc')->select('id','headline','sub_headline','excerpt','featured_image','post_status','created_at')->take($take)->get();
    }
}
function engMonth_to_banMonth_replace($input){
    $ban_month=array("জানুয়ারি","ফেব্রুয়ারি","মার্চ","এপ্রিল","মে","জুন","জুলাই","আগষ্ট","সেপ্টেম্বর","অক্টোবর","নভেম্বর","ডিসেম্বর");
    $eng_month=array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    return str_replace($eng_month,$ban_month, $input);
}
function day_replace($day) {
    $ban_day=array("শনিবার","রবিবার","সোমবার","মঙ্গলবার","বুধবার","বৃহস্পতিবার","শুক্রবার");
    $eng_day=array("Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday","Friday");
    return str_replace($eng_day,$ban_day, $day);
}
function bangla_published_time($time) {
    return e_to_b_int( engMonth_to_banMonth_replace($time->format('j F Y, H:i') ) );
}
function e_to_b_replace($input){
    $bn_digits=array('০','১','২','৩','৪','৫','৬','৭','৮','৯');
    return str_replace(range(0, 9),$bn_digits, $input);
}
if(!function_exists('bn_ago_time')){
    function bn_ago_time($timestamp){
        $time_ago = strtotime($timestamp);
        $current_time = time();
        $time_deff = $current_time - $time_ago;
        $seconds = $time_deff;
        $minutes = round($seconds / 60);
        $hours = round($seconds / 3600);
        $days = round($seconds / 86400);
        $weeks = round($seconds / 604800);
        $months = round($seconds / 2629440);
        $years = round($seconds / 31553280);

        if($seconds <= 60){
            return 'একটু আগে';
        }else if($minutes <= 60){
            if($minutes == 1){
                return 'এক মিনিট আগে';
            }else{
                return $minutes.'মিনিট আগে';
            }
        }else if($hours <= 24){
            if($hours == 1){
                return 'এক ঘন্টা আগে';
            }else{
                return $hours.' ঘন্টা আগে';
            }
        }else if($days <= 7){
            if($days == 1){
                return 'এক দিন আগে';
            }elseif($days == 7){
                return 'এক সপ্তাহ আগে';
            }
            else{
                return $days.' দিন আগে';
            }
        }else if($weeks <= 4.3){
            if($weeks == 1){
                return 'এক সপ্তাহ আগে';
            }else{
                return $weeks.' সপ্তাহ আগে';
            }
        }else if($months <= 12){
            if($months == 1){
                return 'এক মাস আগে';
            }else{
                return $months.' মাস আগে';
            }
        }else{
            if($years == 1){
                return 'এক বছর আগে';
            }else{
                return $years.' বছর আগে';
            }
        }
    }
}
