<?php

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Controllers\RssController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DraftController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PopupController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ScrollController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\InnerAdController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RamadanController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\UpazilaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HeadlineController;
use App\Http\Controllers\LeadPostController;
use App\Http\Controllers\PmanagerController;
use App\Http\Controllers\ReadMoreController;
use App\Http\Controllers\ReporterController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\LivestreamController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PrayertimeController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BreakingnewsController;
use App\Http\Controllers\VideoGalleryController;
use App\Http\Controllers\PushNotificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\AdminDashboardController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes(['register'=> false]);
Route::get('/register', function (){
    return view('errors.404');
});

Route::fallback(function () {
    return view('errors.404');
});

Route::get('/dashboard', [AdminDashboardController::class, 'view_dashboard'])->name('dashboard.admin.index');
//password resets
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/', [FrontendController::class, 'home'])->name('frontEndRoot');
Route::get('/dev-page', [FrontendController::class, 'devPage']);
// auth middleware
Route::group(['middleware' => 'auth'], function () {

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['prefix' => 'app', 'middleware' => ['isAdmin']], function() {

Route::get('/seed-posts', function () {
    Artisan::call('db:seed', [
        '--class' => 'Database\\Seeders\\PostSeeder'
    ]);

    return "✅ Posts seeded successfully!";
});    
    
//photo manager
Route::get('/pmanager/manager/create',[PmanagerController::class, 'create'])->name('pmanager.create');
Route::post('/pmanager/manager/store',[PmanagerController::class, 'store'])->name('pmanager.store');
Route::get('/pmanager/delete/{id?}',[PmanagerController::class, 'delete'])->name('pmanager.delete');
Route::post('/pmanager/load-more/', [PmanagerController::class, 'loadmorePmanager'])->name('loadmore.pmanager');
Route::get('/pmanager/single/{id?}', [PmanagerController::class, 'single'])->name('pmanager.single');
Route::post('/pmanager/live-search', [PmanagerController::class, 'pmanagerLiveSearch'])->name('pmanager.live.search');
Route::post('/pmanager/data/store', [PmanagerController::class, 'dataStore'])->name('data.store');
Route::get('/pmanager/realtime/photo', [PmanagerController::class, 'realtimePmanager'])->name('realtime.pmanager');
//Prayertime
Route::get('/prayer/time/index', [PrayertimeController::class, 'index'])->name('prayertime.index');
Route::post('/prayer/time/update/', [PrayertimeController::class, 'update'])->name('prayertime.update');
// popup ads
Route::get('/popup/create', [PopupController::class, 'create'])->name('popup.create');
Route::get('/popup/managers', [PopupController::class, 'index'])->name('popup.index');
Route::post('/popup/store', [PopupController::class, 'store'])->name('popup.store');
Route::get('/popup/edit/{id}', [PopupController::class, 'edit'])->name('popup.edit');
Route::post('/popup/update/{id}', [PopupController::class, 'update'])->name('popup.update');
Route::get('/popup/destroy/{id}', [PopupController::class, 'destroy'])->name('popup.destroy');
Route::post('/PopupStatusChange', [PopupController::class, 'PopupStatusChange'])->name('PopupStatusChange');
//division
Route::get('/division/create', [DivisionController::class, 'create'])->name('division.create');
Route::get('/division/managers', [DivisionController::class, 'index'])->name('division.index');
Route::post('/division/store', [DivisionController::class, 'store'])->name('division.store');
Route::get('/division/edit/{id}', [DivisionController::class, 'edit'])->name('division.edit');
Route::post('/division/update/{id}', [DivisionController::class, 'update'])->name('division.update');
Route::delete('/division/delete/{id}', [DivisionController::class, 'destroy'])->name('division.delete');
//district
Route::get('/district/create', [DistrictController::class, 'create'])->name('district.create');
Route::get('/district/managers', [DistrictController::class, 'index'])->name('district.index');
Route::post('/district/store', [DistrictController::class, 'store'])->name('district.store');
Route::get('/district/edit/{id}', [DistrictController::class, 'edit'])->name('district.edit');
Route::post('/district/update/{id}', [DistrictController::class, 'update'])->name('district.update');
Route::delete('/district/delete/{id}', [DistrictController::class, 'destroy'])->name('district.delete');
//upazila
Route::get('/upazila/create', [UpazilaController::class, 'create'])->name('upazila.create');
Route::get('/upazila/managers', [UpazilaController::class, 'index'])->name('upazila.index');
Route::post('/upazila/store', [UpazilaController::class, 'store'])->name('upazila.store');
Route::get('/upazila/edit/{id}', [UpazilaController::class, 'edit'])->name('upazila.edit');
Route::post('/upazila/update/{id}', [UpazilaController::class, 'update'])->name('upazila.update');
Route::delete('/upazila/delete/{id}', [UpazilaController::class, 'destroy'])->name('upazila.delete');
//category
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::get('/categories/managers', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
Route::post('changeHomePage', [CategoryController::class, 'changeHomePage'])->name('changeHomePage');
//sub_category
Route::get('/sub/category/create',[SubCategoryController::class, 'create'])->name('sub_category.create');
Route::get('/sub/categories/managers',[SubCategoryController::class, 'index'])->name('sub_category.index');
Route::post('/sub/category/store',[SubCategoryController::class, 'store'])->name('sub_category.store');
Route::get('/sub/category/edit/{id}',[SubCategoryController::class, 'edit'])->name('sub_category.edit');
Route::post('/sub/category/update/{id}',[SubCategoryController::class, 'update'])->name('sub_category.update');
Route::delete('/sub/category/destroy/{id}',[SubCategoryController::class, 'destroy'])->name('sub_category.destroy');
//menu
Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
Route::get('/menu/managers', [MenuController::class, 'index'])->name('menu.index');
Route::post('/menu/store', [MenuController::class, 'store'])->name('menu.store');
Route::get('/menu/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
Route::post('/menu/update/{id}', [MenuController::class, 'update'])->name('menu.update');
Route::get('/menu/delete/{id}', [MenuController::class, 'destroy'])->name('menu.delete');
//submenu
Route::get('/submenu/create', [SubMenuController::class, 'create'])->name('submenu.create');
Route::get('/submenu/managers', [SubMenuController::class, 'index'])->name('submenu.index');
Route::post('/submenu/store', [SubMenuController::class, 'store'])->name('submenu.store');
Route::get('/submenu/edit/{id}', [SubMenuController::class, 'edit'])->name('submenu.edit');
Route::post('/submenu/update/{id}', [SubMenuController::class, 'update'])->name('submenu.update');
Route::delete('/submenu/delete/{id}', [SubMenuController::class, 'destroy'])->name('submenu.delete');
//post
Route::get('/post/managers',  [PostController::class, 'index'])->name('post.index');
Route::get('/post/search',  [PostController::class, 'search'])->name('post.search');
Route::get('/my/post/managers',  [PostController::class, 'user_post'])->name('post.user');
Route::get('/post/create',  [PostController::class, 'create'])->name('post.create');
Route::post('/post/store',  [PostController::class, 'store'])->name('post.store');
Route::get('/post/edit/{id}',  [PostController::class, 'edit'])->name('post.edit');
Route::post('/post/update/{id}',  [PostController::class, 'update'])->name('post.update');
Route::delete('/post/destroy/{id}',  [PostController::class, 'destroy'])->name('post.destroy');
Route::get('/post/duplicate/{id}',  [PostController::class, 'duplicate'])->name('post.duplicate');
Route::get('/post/filter/',  [PostController::class, 'post_filter'])->name('post.filter');
Route::get('/trashpost/index',  [PostController::class, 'trashpost_index'])->name('trashpost.index');
Route::get('/trashpost/view/{id}',  [PostController::class, 'trashpost_view'])->name('trashpost.view');
Route::delete('/trashpost/destroy/{id}',  [PostController::class, 'trashpost_destroy'])->name('trashpost.destroy');
Route::get('/category-sub-category/{category_id?}', [PostController::class, 'categorySubCategoyAJAX'])->name('category.subcategory.ajax');
Route::get('post-division-district/{id?}', [PostController::class, 'AjaxDistrict'])->name('division.district');
Route::get('post-district-upazila/{id?}', [PostController::class, 'AjaxUpazila'])->name('district.upazila');
Route::post('publicationStatus', [PostController::class, 'publicationStatus'])->name('publicationStatus');
Route::get('tag/search/{keyword?}', [PostController::class, 'tagLiveSearch'])->name('tagLiveSearch');
Route::get('tag/search/{keyword?}', [PostController::class, 'tagLiveSearch'])->name('tagLiveSearch');
Route::get('/posts-auto-students', [PostController::class, 'postsAutoSearch'])->name('posts.auto.search');
// schedule_post
Route::get('/post/schedule', [ScheduleController::class, 'index'])->name('post.schedule');
Route::get('/post/schedule/edit/{id}', [ScheduleController::class, 'edit'])->name('post.schedule.edit');
Route::get('/post/schedule/show/{id}', [ScheduleController::class, 'show'])->name('post.schedule.show');
Route::post('/post/schedule/update/{id}', [ScheduleController::class, 'update'])->name('post.schedule.update');
Route::delete('/post/schedule/destroy/{id}',  [ScheduleController::class, 'destroy'])->name('post.schedule.destroy');
//poll
Route::get('/poll/create', [PollController::class, 'create'])->name('poll.create');
Route::get('/poll/managers', [PollController::class, 'index'])->name('poll.index');
Route::post('/poll/store', [PollController::class, 'store'])->name('poll.store');
Route::get('/poll/edit/{id}', [PollController::class, 'edit'])->name('poll.edit');
Route::post('/poll/update/{id}', [PollController::class, 'update'])->name('poll.update');
Route::delete('/poll/delete/{id}', [PollController::class, 'destroy'])->name('poll.delete');
//read more
Route::get('/readmore/managers',  [ReadMoreController::class, 'index'])->name('readmore.index');
Route::post('/readmode/store',  [ReadMoreController::class, 'store'])->name('readmore.store');
Route::get('/readmode/edit/{leader}',  [ReadMoreController::class, 'edit'])->name('readmore.edit');
Route::post('/readmode/update/{id}',  [ReadMoreController::class, 'update'])->name('readmore.update');
Route::delete('/readmode/delete/{id}',  [ReadMoreController::class, 'destroy'])->name('readmore.delete');
//reports
Route::get('report/user/post',  [ReportController::class, 'user_post'])->name('user.post.report');
Route::get('report/user/post/by',  [ReportController::class, 'user_post_by_date'])->name('user.post.by.date');
Route::get('/date-wise-post-view',[ReportController::class, 'dateWisePostView'] )->name('pageviewreport');
Route::get('/date-wise-post-view-by',[ReportController::class, 'dateWisePostViewSearch']  )->name('date.wise.view');
Route::get('/userPostCountByDate/{id}/{start_date}/{end_date}',[ReportController::class, 'userPostCountByDate']  )->name('userPostCountByDate');
Route::get('/login/report',[ReportController::class, 'loginReport']  )->name('loginReport');
Route::get('/logout/report',[ReportController::class, 'logoutReport']  )->name('logoutReport');
//draft
Route::get('/draft/managers',  [DraftController::class, 'index'])->name('draft.index');
Route::get('/draft/edit/{id}',  [DraftController::class, 'edit'])->name('draft.edit');
Route::post('/draft/draft2post/{id}',  [DraftController::class, 'store'])->name('post.store.draft2post');
Route::delete('/draft/destroy/{id}',  [DraftController::class, 'destroy'])->name('draft.destroy');
//lead post
Route::get('/lead/post',  [LeadPostController::class, 'index'])->name('leadpost.index');
Route::delete('/lead/post/destroy{id}',  [LeadPostController::class, 'destroy'])->name('leadpost.destroy');
Route::post('/lead/post/position/update',  [LeadPostController::class, 'updatePosition'])->name('leadpost.position.update');
//breakingnews
Route::get('/breakingnews/managers',  [BreakingnewsController::class, 'index'])->name('breakingnews.index');
Route::post('/breakingnews/store',  [BreakingnewsController::class, 'store'])->name('breakingnews.store');
Route::get('/breakingnews/edit/{id}',  [BreakingnewsController::class, 'edit'])->name('breakingnews.edit');
Route::post('/breakingnews/update/{id}',  [BreakingnewsController::class, 'update'])->name('breakingnews.update');
Route::get('/breakingnews/destroy/{id}',  [BreakingnewsController::class, 'destroy'])->name('breakingnews.destroy');
//photo
Route::get('/photo/managers',  [PhotoController::class, 'index'])->name('photo.index');
Route::get('/photo/create',  [PhotoController::class, 'create'])->name('photo.create');
Route::post('/photo/store',  [PhotoController::class, 'store'])->name('photo.store');
Route::get('/photo/edit/{id}',  [PhotoController::class, 'edit'])->name('photo.edit');
Route::post('/photo/update/{id}',  [PhotoController::class, 'update'])->name('photo.update');
Route::delete('/photo/destroy/{id}',  [PhotoController::class, 'destroy'])->name('photo.destroy');
//video
Route::get('/video/managers',  [VideoGalleryController::class, 'index'])->name('video.index');
Route::get('/video/create',  [VideoGalleryController::class, 'create'])->name('video.create');
Route::post('/video/store',  [VideoGalleryController::class, 'store'])->name('video.store');
Route::get('/video/edit/{id}',  [VideoGalleryController::class, 'edit'])->name('video.edit');
Route::post('/video/update/{id}',  [VideoGalleryController::class, 'update'])->name('video.update');
Route::delete('/video/destroy/{id}',  [VideoGalleryController::class, 'destroy'])->name('video.destroy');
//livestream
Route::get('/livestream',  [LivestreamController::class, 'index'])->name('livestream');
Route::post('/livestream/store',  [LivestreamController::class, 'store'])->name('livestream.store');
Route::post('/livestream/update/{id}',  [LivestreamController::class, 'update'])->name('livestream.update');
Route::post('/livestream/changeLivestreamStatus',  [LivestreamController::class, 'changeLivestreamStatus'])->name('changeLivestreamStatus');
//headline
Route::get('/headline/managers',  [HeadlineController::class, 'index'])->name('headline.index');
Route::get('/headline/create',  [HeadlineController::class, 'create'])->name('headline.create');
Route::post('/headline/store',  [HeadlineController::class, 'store'])->name('headline.store');
Route::get('/headline/edit/{id}',  [HeadlineController::class, 'edit'])->name('headline.edit');
Route::post('/headline/update/{id}',  [HeadlineController::class, 'update'])->name('headline.update');
Route::delete('/headline/destroy/{id}',  [HeadlineController::class, 'destroy'])->name('headline.destroy');
//tag
Route::get('/tag/managers',[TagController::class, 'index'])->name('tag.index');
Route::post('/tag/store',[TagController::class, 'store'])->name('tag.store');
Route::get('/tag/edit/{id}',[TagController::class, 'edit'])->name('tag.edit');
Route::post('/tag/update/{id}',[TagController::class, 'update'])->name('tag.update');
Route::get('/tag/destroy/{id}',[TagController::class, 'destroy'])->name('tag.destroy');
Route::get('/tag/find',[TagController::class, 'search'])->name('tag.search');
Route::post('/tag/feature',[TagController::class, 'featureTagStatus'])->name('featureTagStatus');
// slider
Route::get('/slider/managers', [SliderController::class, 'index'])->name('slider.index');
Route::get('/slider/create', [SliderController::class, 'create'])->name('slider.create');
Route::post('/slider/store', [SliderController::class, 'store'])->name('slider.store');
Route::get('/slider/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
Route::post('/slider/update/{id}', [SliderController::class, 'update'])->name('slider.update');
Route::get('/slider/delete/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');
//setting
Route::get('/general/setting', [SettingController::class, 'index'])->name('general_setting.index');
Route::post('/general/setting/update/', [SettingController::class, 'update'])->name('general_setting.update');
Route::post('/sm_banner_status', [SettingController::class, 'sm_banner_status'])->name('sm_banner_status');
Route::post('/scrollBarToggle', [SettingController::class, 'scrollBarToggle'])->name('scrollBarToggle');
Route::post('/menuBarToggle', [SettingController::class, 'menuBarToggle'])->name('menuBarToggle');
Route::post('/popularTagToggle', [SettingController::class, 'popularTagToggle'])->name('popularTagToggle');
// featureTag
Route::get('/feature/tag/post/show', [SettingController::class, 'featureTagShow'])->name('featureTagShow');
Route::post('/feature/tag/post/store', [SettingController::class, 'featureTagPostStore'])->name('featureTagStore');
Route::post('/feature/tag/status/change', [SettingController::class, 'featureTagStatusChange'])->name('featureTagStatusChange');
//advertisement
Route::get('/advertisement/managers', [AdController::class, 'index'])->name('ad.index');
Route::post('/advertisement/store', [AdController::class, 'store'])->name('ad.store');
Route::get('/advertisement/edit/{id}', [AdController::class, 'edit'])->name('ad.edit');
Route::post('/advertisement/update/{id}', [AdController::class, 'update'])->name('ad.update');
Route::get('/advertisement/delete/{id}', [AdController::class, 'destroy'])->name('ad.delete');
Route::post('/change-ad-status', [AdController::class, 'changeAdStatus'])->name('change-ad-status');
//banner
Route::get('/banner/managers', [BannerController::class, 'index'])->name('banner.index');
Route::get('/banner/create', [BannerController::class, 'create'])->name('banner.create');
Route::post('/banner/store', [BannerController::class, 'store'])->name('banner.store');
Route::get('/banner/edit/{id}', [BannerController::class, 'edit'])->name('banner.edit');
Route::post('/banner/update/{id}', [BannerController::class, 'update'])->name('banner.update');
Route::get('/banner/delete/{id}', [BannerController::class, 'destroy'])->name('banner.delete');
Route::post('/banner/status/toggle', [BannerController::class, 'banner_status_toggle'])->name('banner_status_toggle');
//content-innder-ads
Route::get('/inner-ad/managers', [InnerAdController::class, 'index'])->name('innerAd.index');
Route::get('/inner-ad/create', [InnerAdController::class, 'create'])->name('innerAd.create');
Route::post('/inner-ad/store', [InnerAdController::class, 'store'])->name('innerAd.store');
Route::get('/inner-ad/edit/{id}', [InnerAdController::class, 'edit'])->name('innerAd.edit');
Route::post('/inner-ad/update/{id}', [InnerAdController::class, 'update'])->name('innerAd.update');
Route::delete('/inner-ad/delete/{id}', [InnerAdController::class, 'destroy'])->name('innerAd.delete');
Route::post('/change-inner-ad-status', [InnerAdController::class, 'change_inner_ad_status'])->name('change_inner_ad_status');

//page
Route::get('/pages/managers',[PageController::class, 'index'])->name('page.index');
Route::get('/page/create',[PageController::class, 'create'])->name('page.create');
Route::post('/page/store',[PageController::class, 'store'])->name('page.store');
Route::get('/page/edit/{id}',[PageController::class, 'edit'])->name('page.edit');
Route::post('/page/update/{id}',[PageController::class, 'update'])->name('page.update');
Route::delete('/page/destroy/{id}',[PageController::class, 'destroy'])->name('page.destroy');
Route::get('/image/marge',[PageController::class, 'imageMarge'])->name('image.marge');
Route::post('/image/marge/store',[PageController::class, 'imageMargeStore'])->name('imageMarge.store');
//user
Route::get('/users/managers',[UserController::class, 'index'])->name('user.index');
Route::get('/users/create',[UserController::class, 'create'])->name('user.create');
Route::post('/users/store',[UserController::class, 'store'])->name('user.store');
Route::get('/users/edit/{id}',[UserController::class, 'edit'])->name('user.edit');
Route::post('/users/update/{id}',[UserController::class, 'update'])->name('user.update');
Route::get('/users/destroy/{id}',[UserController::class, 'destroy'])->name('user.destroy');
//user profile
Route::get('/my/profile',[ProfileController::class, 'profile_index'])->name('user.profile.index');
Route::get('/my/profile/edit/', [ProfileController::class, 'profile_edit'])->name('user.profile.edit');
Route::post('/my/profile/update/',[ProfileController::class, 'profile_update'])->name('user.profile.update');
Route::get('/my/change/password/',[ProfileController::class, 'changePassword'])->name('user.change.password');
Route::post('/my/password/update/',[ProfileController::class, 'passwordUpdate'])->name('user.password.update');
//
Route::get('/reporter/index/', [ReporterController::class, 'index'])->name('reporter.index');
Route::get('/reporter/create/', [ReporterController::class, 'create'])->name('reporter.create');
Route::get('/reporter/show/', [ReporterController::class, 'show'])->name('reporter.show');
Route::post('/reporter/store/', [ReporterController::class, 'store'])->name('reporter.store');
Route::get('/reporter/edit/{id}', [ReporterController::class, 'edit'])->name('reporter.edit');
Route::post('/reporter/update/{id}', [ReporterController::class, 'update'])->name('reporter.update');
Route::DELETE('/reporter/destroy/{id}', [ReporterController::class, 'destroy'])->name('reporter.destroy');
//user toggle buttom
Route::post('/changeUserStatus',[UserController::class, 'changeUserStatus'])->name('changeUserStatus');
//admin
Route::get('/admin/managers',[UserController::class, 'admin_index'])->name('admin.index');
Route::get('/admin/create',[UserController::class, 'admin_create'])->name('admin.create');
Route::post('/admin/store',[UserController::class, 'admin_store'])->name('admin.store');
Route::get('/admin/edit/{id}',[UserController::class, 'admin_edit'])->name('admin.edit');
Route::post('/admin/update/{id}',[UserController::class, 'admin_update'])->name('admin.update');
Route::delete('/admin/destroy/{id}',[UserController::class, 'admin_destroy'])->name('admin.destroy');
//role
Route::get('/roles/managers', [RoleController::class, 'index'])->name('role.index');
Route::get('/roles/create', [RoleController::class, 'create'])->name('role.create');
Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
Route::delete('/roles/destroy/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
Route::post('/roles/store', [RoleController::class, 'store'])->name('role.store');
Route::post('/roles/update/{id}', [RoleController::class, 'update'])->name('role.update');
//staff
Route::get('/staffs/managers', [StaffController::class, 'index'])->name('staff.index');
Route::get('/staffs/create', [StaffController::class, 'create'])->name('staff.create');
Route::get('/staffs/edit/{id}', [StaffController::class, 'edit'])->name('staff.edit');
Route::delete('/staffs/destroy/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');
Route::post('/staffs/update/{id}', [StaffController::class, 'update'])->name('staff.update');
Route::post('/staffs/store', [StaffController::class, 'store'])->name('staff.store');
// permission
Route::get('/permission/managers',[PermissionController::class, 'index'])->name('permission.index');
Route::get('/permission/create',[PermissionController::class, 'create'])->name('permission.create');
Route::post('/permission/store',[PermissionController::class, 'store'])->name('permission.store');
Route::get('/permission/edit/{id}',[PermissionController::class, 'edit'])->name('permission.edit');
Route::post('/permission/update/{id}',[PermissionController::class, 'update'])->name('permission.update');
Route::get('/permission/destroy/{id}',[PermissionController::class, 'destroy'])->name('permission.destroy');
// reports
Route::get('/report/stock/result/show', [ReportController::class, 'stock_report'])->name('report.product.stock');
Route::get('/report/search/result/show', [ReportController::class, 'user_search_report'])->name('report.user.searches');
// ramadan
Route::get('/ramadan/create/', [RamadanController::class, 'create'])->name('ramadan.create');
Route::post('/ramadan/store/', [RamadanController::class, 'store'])->name('ramadan.store');
Route::get('/ramadan/edit/{id}', [RamadanController::class, 'edit'])->name('ramadan.edit');
Route::post('/ramadan/update/{id}', [RamadanController::class, 'update'])->name('ramadan.update');
Route::get('/ramadan/destroy/{id}', [RamadanController::class, 'destroy'])->name('ramadan.destroy');
// timeline
Route::get('/timeline/create/', [TimelineController::class, 'create'])->name('timeline.create');
Route::post('/timeline/store/', [TimelineController::class, 'store'])->name('timeline.store');
Route::get('/timeline/edit/{id}', [TimelineController::class, 'edit'])->name('timeline.edit');
Route::post('/timeline/update/{id}', [TimelineController::class, 'update'])->name('timeline.update');
Route::get('/timeline/destroy/{id}', [TimelineController::class, 'destroy'])->name('timeline.destroy');
Route::post('/timelineStatusChange', [TimelineController::class, 'timelineStatusChange'])->name('timelineStatusChange');
//push-notification
Route::get('push-notification',[PushNotificationController::class, 'index'])->name("pushNotification.index");
Route::get('push-notification/post-search',[PushNotificationController::class, 'postSearch'])->name("notification.post.search");
}); //adminMiddleware

}); // auth middleware

// frontend
Route::get('todays-news',[FrontendController::class,'todaysNews'])->name('todays.news');
Route::get('all-poll', [FrontendController::class, 'allPoll'])->name('polls');
Route::get('exclusive ',[FrontendController::class, 'exclusive']);
Route::get('latest',[FrontendController::class, 'Archive'])->name('Archive');
Route::get('search', [FrontendController::class, 'getSearch'])->name('search');
Route::get('photo-gallery', [FrontendController::class, 'photoGallery'])->name('photo.gallery');
Route::post('news-popup-tatus', [FrontendController::class, 'newsPopupStatus'])->name('newsPopupStatus');
//push-notification
Route::post('save-push-notification-sub', [PushNotificationController::class, 'saveSubcription'])->name('saveSubcription');
Route::post('save-push-notification', [PushNotificationController::class, 'sendNotification'])->name('sendNotification');

Route::prefix('/video/')->group(function () {
    Route::get('/',[FrontendController::class, 'videoGallery'])->name('video.gallery');
    Route::get('/topic/{category}',[FrontendController::class, 'categoryVideoGallery'])->name('category.video.gallery');
    Route::get('/{uniqid}',[FrontendController::class, 'singleVideoGallery'])->name('single.video.gallery');
});

//category product filter
Route::get('/tag/{name}',[FrontendController::class, 'tagPost'])->name('tag.posts');
Route::get('/live/video/stream',[FrontendController::class, 'livestreamShow'])->name('livestream.show');
//category product
Route::get('/{category}/{id}',[FrontendController::class, 'singlePost'])->name('single.post');

Route::get('/rss.xml',[RssController::class, 'last_day_rss']);
Route::get('sitemap.xml', [SitemapController::class, 'index']);
Route::get('/{category_slug}',[FrontendController::class, 'categoryPost'])->name('category.posts');
Route::get('/{slug}', [FrontendController::class, 'singlePage'])->name('single.page');
Route::get('/{cat}/{sub_cat}',[FrontendController::class, 'sub_cat_post'])->name('sub_cat.post');
Route::prefix('/profile/reporter')->group(function () {
    Route::get('/{id}',[FrontendController::class, 'reporterPost'])->name('reporter.post');
});

Route::get('/single/Page/Rel/Post/1/{category_id?}', [FrontendController::class, 'singlePageRelPost1'])->name('singlePageRelPost1');
Route::get('/single/Page/Rel/Post/2/{category_id?}/{post_id?}', [FrontendController::class, 'singlePageRelPost2'])->name('singlePageRelPost2');
Route::get('/single/Page/Rel/Post/3/{category_id?}', [FrontendController::class, 'singlePageRelPost3'])->name('singlePageRelPost3');
//
Route::post('/category/load-more/news/{category_id?}', [FrontendController::class, 'loadmore_category_post'])->name('loadmore.category.post');
Route::post('/post/load-more/', [FrontendController::class, 'loadmore_post'])->name('loadmore.post');
Route::get('post/auto_load', [FrontendController::class, 'auto_load']);

Route::get('/search',[FrontendController::class, 'getSearch'])->name('search');
Route::get('/contact-us',[FrontendController::class, 'ContactUs'])->name('ContactUs');
//Route::get('/privacy-policy',[FrontendController::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('/sahri-iftar-time', [FrontendController::class, 'sahriIftarTime'])->name('sahri.iftar.time');

Route::get('/latest/News/11/11/11/11', [FrontendController::class, 'latestNews'])->name('latestNews');
Route::get('/popular/News/11/11/11/11', [FrontendController::class, 'popularNews'])->name('popularNews');
Route::get('/popular/News/11/11/11/11/{category_id?}', [FrontendController::class, 'popularNewsByCat'])->name('popularNewsByCat');
Route::get('/homeCategory2/11/11/11/11', [FrontendController::class, 'homeCategory2'])->name('homeCategory2');
Route::get('/homeCategory4_1/11/11/11/11', [FrontendController::class, 'homeCategory4_1'])->name('homeCategory4_1');
Route::get('/home/Category4_3/11/11/11/11', [FrontendController::class, 'homeCategory4_3'])->name('homeCategory4_3');
Route::get('/home/Category/3_3/11/11/11/11', [FrontendController::class, 'homeCategory3_3'])->name('homeCategory3_3');
Route::get('/home/Page/Excludive/11/11/11/11', [FrontendController::class, 'homePageExcludive'])->name('homePageExcludive');
Route::get('/homePageCategory32/11/11/11/11', [FrontendController::class, 'homePageCategory32'])->name('homePageCategory32');
Route::get('/homeVideo4/11/11/11/11', [FrontendController::class, 'homeVideo4'])->name('homeVideo4');
Route::get('/homeCategory7_3/11/11/11/11', [FrontendController::class, 'homeCategory7_3'])->name('homeCategory7_3');
Route::get('/homeCategory58_3/11/11/11/11', [FrontendController::class, 'homeCategory58_3'])->name('homeCategory58_3');
Route::get('/homeCategory11_3/11/11/11/11', [FrontendController::class, 'homeCategory11_3'])->name('homeCategory11_3');

Route::get('/homeCategory6_3/11/11/11/11', [FrontendController::class, 'homeCategory6_3'])->name('homeCategory6_3');
Route::get('/homeCategory5_3/11/11/11/11', [FrontendController::class, 'homeCategory5_3'])->name('homeCategory5_3');
Route::get('/homeCategory54_3/11/11/11/11', [FrontendController::class, 'homeCategory54_3'])->name('homeCategory54_3');

Route::get('/homeCategory18_3/11/11/11/11', [FrontendController::class, 'homeCategory18_3'])->name('homeCategory18_3');

Route::get('/homePageCat1/11/11/11/11', [FrontendController::class, 'homePageCat1'])->name('homePageCat1');
Route::get('homePageCat2/11/11/11/11',[FrontendController::class, 'homePageCat2'])->name('homePageCat2');
Route::get('/homePageCat3/11/11/11/11', [FrontendController::class, 'homePageCat3'])->name('homePageCat3');

Route::get('division/district/news/{id?}', [FrontendController::class, 'AjaxDistrict'])->name('division.district.news');
Route::get('district/upazila/news/{id?}', [FrontendController::class, 'AjaxUpazila'])->name('district.upazila.news');
Route::get('/bangladesh/district/news/',[FrontendController::class, 'getAllBDNews'])->name('search_all_bd_news');

Route::post('poll/choice/store',[PollController::class, 'pollChoiceStore'])->name('poll.choice');

//scrolldown
Route::get('/load-more-posts', [ScrollController::class, 'loadMorePosts'])->name('load.more.posts');
