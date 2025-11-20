<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Page;
use App\Models\Poll;
use App\Models\Post;
use App\Models\Photo;
use App\Models\Upazila;
use App\Models\Ramadan;
use App\Models\Category;
use App\Models\District;
use App\Models\Division;
use App\Models\Reporter;
use App\Models\Timeline;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use App\Models\VideoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class FrontendController extends Controller
{

    public function home()
    {
        view_counter();
        $divisions = DB::table('divisions')->get();
        return view('_front.pages.home', compact('divisions'));
    }
    public function devPage()
    {
        $divisions = DB::table('divisions')->get();
        return view('_front.pages.dev_page', compact('divisions'));
    }

    public function AjaxDistrict(Request $request)
    {
        $division_id = $request->id;
        $districts = Division::find($division_id)->district()->orderBy('slug', 'asc')->get();
        return Response::json($districts);
    }
    public function AjaxUpazila(Request $request){
        $district_id = $request->id;
        // $upazila = District::find($district_id)->Upazilas()->get();
        $upazila = DB::table('upazilas')->where('district_id', $district_id)->get();
        return Response::json($upazila);
    }
    public function getAllBDNews(Request $request){
        // dd($request);
        view_counter();
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

    public function singlePage($slug){
        $page = Page::where('slug', $slug)->first();

        if(!empty($page)){
            return view('_front.pages.single_page', compact('page'));
        }
        else{
            return view('errors.404');
        }
    }


    public function reporterPost($id)
    {
        // Reporter খুঁজে বের করা
        $reporter = Reporter::find($id);
    
        // যদি Reporter না পাওয়া যায় তাহলে 404 দেখানো
        if (!$reporter) {
            return abort(404, 'Reporter not found');
        }
    
        // view রিটার্ন করা
        return view('_front.pages.reporterPosts', compact('reporter'));
    }

    public function latestNews(Request $request){
        $posts = Post::where('post_status', '1')->orderBy('id', 'desc')->take(10)->get();
        return view('_front._render.latestNews',compact('posts'))->render();
    }

    public function popularNews(Request $request){
        $date = Carbon::today()->subDays(7);
        $posts = Post::where([['created_at','>=',$date],['post_status','1']])->orderBy('view_count','desc')->take(10)->get();
        return view('_front._render.popularNews',compact('posts'))->render();
    }

    public function popularNewsByCat(Request $request, $category_id){
        $posts = popular_post_by_category($category_id,10);
        return view('_front._render.popularNewsByCat',compact('posts'))->render();
    }


    public function homeCategory2(Request $request){
        $posts = Category::find(2)->posts()->orderBy('created_at', 'desc')->take(3)->get();
        return view('_front._render.homeCategory2',compact('posts'))->render();
    }

    public function homeCategory4_1(Request $request){
        $post = Category::find(1)->posts()->orderBy('created_at', 'desc')->take(1)->get();
        return view('_front._render.homeCategory4_1',compact('post'))->render();
    }
    public function homeCategory4_3(Request $request){
        $posts = Category::find(4)->posts()->orderBy('created_at', 'desc')->skip(1)->take(3)->get();
        return view('_front._render.homeCategory4_3',compact('posts'))->render();
    }

    public function homeCategory3_3(Request $request){
        $posts = Category::find(4)->posts()->orderBy('created_at', 'desc')->skip(1)->take(3)->get();
        return view('_front._render.homeCategory3_3',compact('posts'))->render();
    }

    public function homeCategory18_3(Request $request){
        $posts = Category::find(7)->posts()->orderBy('created_at', 'desc')->skip(1)->take(3)->get();
        return view('_front._render.homeCategory18_3',compact('posts'))->render();
    }
//    public function homeCategory28_3(Request $request){
//        $posts = Category::find(28)->posts()->orderBy('created_at', 'desc')->take(4)->get();
//        return view('_front._render.homeCategory28_3',compact('posts'))->render();
//    }

    public function homePageExcludive(Request $request){
        $posts = Post::where('post_status', '1')->where('special', 1)->orderBy('id', 'desc')->take(6)->get();
        return view('_front._render.homePageExcludive',compact('posts'))->render();
    }

    public function homePageCategory32(Request $request){
        $posts = Category::find(4)->posts()->orderBy('created_at', 'desc')->take(4)->get();
        return view('_front._render.homePageCategory32',compact('posts'))->render();
    }

    public function homeCategory6_3(Request $request){
        $posts = Category::find(6)->posts()->orderBy('created_at', 'desc')->take(4)->get();
        return view('_front._render.homeCategory6_3',compact('posts'))->render();
    }
    public function homeCategory5_3(Request $request){
        $posts = Category::find(5)->posts()->orderBy('created_at', 'desc')->take(4)->get();
        return view('_front._render.homeCategory5_3',compact('posts'))->render();
    }
    public function homeCategory54_3(Request $request){
        $posts = Category::find(4)->posts()->orderBy('created_at', 'desc')->take(4)->get();
        return view('_front._render.homeCategory54_3',compact('posts'))->render();
    }



    public function homeVideo4(Request $request){
        $videos = VideoGallery::orderBy('created_at', 'desc')->skip(1)->take(4)->get();
        return view('_front._render.homeVideo4',compact('videos'))->render();
    }

    public function homeCategory7_3(Request $request){
        $posts = Category::find(7)->posts()->orderBy('created_at', 'desc')->skip(1)->take(3)->get();
        return view('_front._render.homeCategory7_3',compact('posts'))->render();
    }
    public function homeCategory58_3(Request $request){
        $posts = Category::find(4)->posts()->orderBy('created_at', 'desc')->skip(1)->take(3)->get();
        return view('_front._render.homeCategory58_3',compact('posts'))->render();
    }
    public function homeCategory11_3(Request $request){
        $posts = Category::find(12)->posts()->orderBy('created_at', 'desc')->skip(1)->take(3)->get();
        return view('_front._render.homeCategory11_3',compact('posts'))->render();
    }


    public function homePageCat1(Request $request){
        $posts = Category::find(1)->posts()->orderBy('created_at', 'desc')->take(20)->get();
        return view('_front._render.homePageCat1',compact('posts'))->render();
    }

    public function homePageCat2(){
        $posts = Category::find(2)->posts()->orderBy('created_at', 'desc')->take(3)->get();
        return Response::json($posts);
    }

    public function homePageCat3(Request $request){
        $posts = Category::find(2)->posts()->orderBy('created_at', 'desc')->take(20)->get();
        return view('_front._render.category2',compact('posts'))->render();
    }



    public function exclusive(){
        $exclusive = Post::orderBy('created_at', 'desc')->where('post_status', 1)->where('special', 1)->paginate(20);
        return view('_front.pages.exclusive', compact('exclusive'));
    }



    public function categoryPost(Request $request, $category_slug)
    {

        $category = Category::where('slug', $category_slug)->first();
        $page = Page::where('slug', $category_slug)->first();

        if(!empty($category)){
            $posts = Category::find($category->id)->Posts()->orderBy('created_at', 'desc')->take(4)->get();
            return view('_front.pages.category', compact('category', 'posts'));
        }else if($category_slug == 'contact-us'){
            return view('_front.pages.contact_us');
        }   else if($category_slug == 'sahri-iftar-time'){
            $division = $request->division;
            if(empty($division)){
                if(Ramadan::all()->isNotEmpty()){
                    $division = Ramadan::where('division','ঢাকা')->first()->division;
                    $ramadans = Ramadan::where('division','ঢাকা')->get();
                }else{
                    $division =null;
                    $ramadans =null;
                }
            }else{
                $ramadans = Ramadan::where('division',$division)->get();
            }
            return view('_front.pages.ramadan',compact('ramadans','division'));
        }else if(!empty($page)){
            return view('_front.pages.single_page', compact('page'));
        }
        return view('errors.404');
    }

    public function sub_cat_post( $cat, $sub_cat)
    {
        $post = Post::where('uniqid',$sub_cat)->first();
        $sub_category = SubCategory::where('slug',$sub_cat)->first();

        if (!empty($post)) {
            if($post->post_status == 1){
                $category = Category::where('slug', $cat)->select('id','name')->first();
                if($post != null && $category!= null){
                    $timelines = Timeline::where('status',1)->pluck('id','name');
                    $post->view_count = $post->view_count + 1;
                    $post->save();
                    return view('_front.pages.single_post', compact('post', 'category','timelines'));
                }else{
                    return view('errors.404');
                }
            }
        }else if (!empty($sub_category)) {
            $category = Category::where('slug', $cat)->first();
            $sub_category = SubCategory::where('slug', $sub_cat)->first();
            $page = Page::where('slug', $sub_cat)->first();
            if(!empty($sub_category)){
                return view('_front.pages.sub_cat_post', compact('category', 'sub_category'));
            }else if(!empty($page)){
                return view('_front.pages.single_page', compact('page'));
            }else{
                return view('errors.404');
            }
        }
        return view('errors.404');

    }

    public function singlePost($category, $id)
    {
        view_counter();
        $post = Post::where('uniqid',$id)->first();
        $sub_category = SubCategory::where('slug',$id)->first();
        if (!empty($post)) {
            if($post->post_status == 1){
                $category = Category::where('slug', $category)->select('id','name')->first();
                if($post != null && $category!= null){
                    $timelines = Timeline::where('status',1)->pluck('id','name');
                    $post->view_count = $post->view_count + 1;
                    $post->save();
                    return view('_front.pages.single_post', compact('post', 'category','timelines'));
                }else{
                    return view('errors.404');
                }
            }
        }else if (!empty($sub_category)) {
            $category = Category::where('slug', $category)->first();
            $sub_category = SubCategory::where('slug', $id)->first();
            $page = Page::where('slug', $id)->first();
            if(!empty($sub_category)){
                return view('_front.pages.sub_cat_post', compact('category', 'sub_category'));
            }else if(!empty($page)){
                return view('_front.pages.single_page', compact('page'));
            }else{
                return view('errors.404');
            }
        }
        return view('errors.404');
    }

    public function singlePageRelPost1(Request $request, $category_id){
        $posts = Category::find($category_id)->posts()->orderBy('created_at', 'desc')->skip(4)->take(5)->get();
        return view('_front._render.singlePageRelPost1',compact('posts'))->render();
    }

    public function singlePageRelPost2(Request $request, $category_id, $post_id){
        $posts = Category::find($category_id)->posts()->where('id', '!=', $post_id)->orderBy('created_at', 'desc')->skip(0)->take(8)->get();
        return view('_front._render.singlePageRelPost2',compact('posts'))->render();
    }

    public function singlePageRelPost3(Request $request, $category_id){
        $posts = Post::orderBy('created_at', 'desc')->take(4)->get();
        return view('_front._render.singlePageRelPost3',compact('posts'))->render();
    }

    public function singlePostSub_cat($category, $sub_cat, $id)
    {
        $post = Post::find($id);
        $category = Category::where('slug', $category)->first();
        $sub_cat = $post->sub_cat_id;
        $post->view_count = $post->view_count + 1;
        $post->save();
        return view('_front.pages.single_post', compact('post', 'category'));
    }

    public function singlePostSubCat($category, $sub_cat, $id)
    {
        $post = Post::find($id);
        $category = Category::where('slug', $category)->first();
        $sub_cat = $post->sub_cat_id;
        $post->view_count = $post->view_count + 1;
        $post->save();
        return view('_front.pages.single_post', compact('post', 'category'));
    }

    public function getSearch(Request $request)
    {
        $query = $request->x;
        $posts = Post::where('headline', 'LIKE', '%' . $query . '%')->orWhere('post_content', 'LIKE', '%' . $query . '%')->paginate(10);
        $posts->appends($request->all());
        return view('_front.pages.search', compact('posts', 'query'));
    }

    public function tagPost($name)
    {
        $tag = Tag::where('name', $name)->first();
        $page = Page::where('slug', $name)->first();
        if(!empty($tag)){
            $posts = Tag::find($tag->id)->Posts()->orderBy('created_at', 'desc')->paginate(10);
            return view('_front.pages.tag_posts', compact('tag', 'posts'));
        }
        else if(!empty($page)){
            return view('_front.pages.single_page', compact('page'));
        }
        else{
            return view('errors.404');
        }


    }

    public function Archive(Request $request)
    {
        $date = $request->postByDate;
       if($request->postByDate){
            $posts = Post::where('created_at', 'LIKE',  '%'.$date.'%')->where('post_status', 1)->orderBy('created_at', 'desc')->Paginate(20);
            $posts->appends($request->all());

        } else {
            $posts = Post::where('post_status', 1)->orderBy('created_at', 'desc')->Paginate(20);
        }
        return view('_front.pages.all_posts', compact('posts', 'date'));
    }



    public function AboutUs()
    {
        return view('_front.pages.about_us');
    }
    public function ContactUs()
    {
        return view('_front.pages.contact_us');
    }


    public function Disclaimer()
    {
        return view('_front.pages.Disclaimer');
    }
//    public function PrivacyPolicy()
//    {
//        return view('_front.pages.Privacy_Policy');
//    }
    public function TermsofUse()
    {
        return view('_front.pages.Terms_of_Use');
    }


    public function robot()
    {
        return view('_front.pages.robots');
    }

     public function ads()
    {
        return view('_front.pages.ads');
    }



    public function live()
    {
        $code = setting('live_streaming_code');
        $status = setting('streaming_status');
        return view('_front.pages.video.live', compact('code', 'status'));
    }
    //ajax

    public function auto_load(Request $request)
    {
        $posts = Post::where('post_status', '1')->orderBy('id','desc')->paginate(10);
        if ($request->ajax()) {
            $html = '';
            foreach ($posts as $post) {
                $html.='<div class="mt-5"><h1><a href="'.news_url($post->id).'">'.$post->headline.'</a></h1><p>'.$post->post_content.'</p></div>';
            }
            return $html;
        }
        return view('_front.pages.auto_load');
    }

    public function loadmore_post(Request $request)
    {
     if($request->ajax())
     {
      if($request->id > 0)
      {
       // $data = DB::table('posts')
       //    ->where('id', '<', $request->id)
       //    ->orderBy('id', 'DESC')
       //    ->limit(8)
       //    ->get();

        $data = Post::where('post_status', '1')->where('id', '<', $request->id)->orderBy('id','desc')->take(8)->get();
      }
      else
      {
       $data = Post::where('post_status', '1')->orderBy('id','desc')->take(8)->get();
      }
      $output = '';
      $last_id = '';

      if(!$data->isEmpty())
      {
       foreach($data as $row)
       {
        $output .= '
         <div class="col-md-3 col-lg-3 col-6">
                <div class="link-hover-homepage mb-3">
                <a class="card-img-top" href="'.news_url($row->id).'">
                    <div class="media">
                        <img src="/defaults/lazy_image.jpg" data-src="'.$row->featured_image.'" alt="'.$row->headline.'"class="img-fluid img-responsive lazy">
                        <div class="media-title">
                            <h4>'.$row->headline.'</h4>
                        </div>
                    </div>
                </a>
               
                </div>
            </div>';
        $last_id = $row->id;
        }
           $output .= '
           <div id="load_more my-4">
            <center><button type="button" name="load_more_button" class="btn btn-success more__btn my-4" width="250px" data-id="'.$last_id.'" id="load_more_button">আরও</button></center>
           </div>
           ';
        }
        else
        {
           $output .= '
           <div id="load_more">
            <center><button type="button" name="load_more_button" class="btn btn-info my-4" width="250px">আরও</button></center>
           </div>
           ';
        }
            echo $output;
        }
    }

    public function loadmore_category_post(Request $request, $category_id)
    {
        $total_click = $request->total_click*12+5;
     if($request->ajax())
     {
      if($request->id > 0)
      {
        $data = Category::find($category_id)->Posts()->orderBy('id', 'desc')->skip($total_click)->take(12)->get();
      }
      else
      {
        $data = Category::find($category_id)->Posts()->orderBy('id', 'desc')->skip(5)->take(12)->get();
      }
      $output = '';
      $last_id = '';

      if(!$data->isEmpty())
      {
          $settings = setting('lazy_image');
          if(!empty($settings)){
              $lazy_img = asset($settings);
          }else{
              $lazy_img = asset('/defaults/lazy-default.jpg');
          }

       foreach($data as $row)
       {


        $output .= '
        
            <div class="callout-card pb-3 mb-4 border__btm">
                                <div class="row">
                                    <div class="col-md-8 col-8 col-sm-8">
                                        <div class="media-body d-grid">
                                            <ul class="list-inline ">
                                                <li><h4 class="media-heading"><a
                                                                href="'.news_url($row->id).'"><strong>'.$row->headline.'</strong></a>
                                                    </h4></li>
                                                <li class="pull-left"> <i
                                                            class="bi bi-clock"></i> '.bangla_published_time($row->created_at).'
                                                </li>
                                                <li class="clearfix"></li>
                                            </ul>
                                            <p class="d-none d-md-block d-lg-block mb-0" style="display: inline-block;">'.Str::limit($row->excerpt, 110).'
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-4 col-sm-4">
                                        <a href="'.news_url($row->id).'">
                                            <img class="media-object img-responsive lazy"
                                                src="'.$lazy_img.'"  data-src="'.$row->featured_image.'" alt="'.$row->headline.'">
                                        </a>
                                    </div>
                                </div>
                            </div>';
            $last_id = $row->id;
        }
           $output .= '
           <div id="load_more">
            <center><button type="button" name="load_more_button" class="btn btn-success " width="250px" data-id="'.$last_id.'" id="load_more_button">আরও</button></center>
           </div>
           ';
        }
        else
        {
           $output .= '
           <div id="load_more">
            <center><button type="button" name="load_more_button" class="btn btn-danger not__more__info" width="250px"> আর তথ্য নেই </button></center>
           </div>
           ';
        }
            echo $output;
        }

    }







    // video gallery

    public function videoGallery()
    {
        return view('_front.video.videos');
    }

    public function categoryVideoGallery($category)
    {
        $category = Category::where('slug', $category)->first();

        $videos = $category->Videos()->orderBy('created_at', 'asc')->paginate(4);

        return view('_front.video.category', compact('category', 'videos'));

    }

    public function singleVideoGallery($uniqid){
        $video = VideoGallery::where('uniqid',$uniqid)->first();
        $video->view_count = $video->view_count + 1;
        $video->save();
        // dd($video );
        return view('_front.video.single', compact('video'));
    }
    
    public function photoGallery(){
        $photos =  Photo::orderby('id','desc')->get();
        return view('_front.photo.photos', compact('photos'));
    }

    public function singlePhotoGallery($category, $id, $title)
    {
        $photo = Photo::find($id);
        $photo->view_count = $photo->view_count + 1;
        $photo->save();
        $category = Category::where('slug', $category)->first();
        return view('_front.pages.photo.single', compact('category', 'photo'));

    }

    public function categoryPhotoGallery($category)
    {
        $category = Category::where('slug', $category)->first();

        $photos = $category->Photos()->orderBy('created_at', 'asc')->paginate(4);

        return view('_front.pages.photo.category', compact('category', 'photos'));
    }


    public function allPoll(){
        $polls = Poll::orderBy('start_date','asc')->get();
        return view('_front.poll.allPoll', compact('polls'));
    }
    public function livestreamShow(){
        return view('_front.video.live');
    }

    public function sahriIftarTime(Request $request){
        $division = $request->division;
        if(empty($division)){
            if(Ramadan::all()->isNotEmpty()){
                $division = Ramadan::where('division','ঢাকা')->first()->division;
                $ramadans = Ramadan::where('division','ঢাকা')->get();
            }else{
                $division =null;
                $ramadans =null;
            }
        }else{
            $ramadans = Ramadan::where('division',$division)->get();
        }
        return view('_front.pages.ramadan',compact('ramadans','division'));
    }

    public function newsPopupStatus(Request $request){
        // request()->cookie();
        //  Cookie::queue(Cookie::make('stats', $track->id, 365 * 24 * 60));
        // $cookie_id = ($request->cookie('stats'));

        DB::table('popup_disable')->insert([
            'session_id' => $request->session_id,
            'post_id' => $request->post_id,
        ]);
        return response()->json(['success'=>'popup disable.']);
    }

    public function todaysNews(){
        return view('_front.pages.todaysNews');
    }

}
