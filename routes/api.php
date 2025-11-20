<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::get('/scroll-posts/{take?}/{skip?}/{order?}', [ApiController::class, 'scrollPosts']);
// Route::get('/breakingnews', [ApiController::class, 'breakingNews']);
// Route::get('/polls', [ApiController::class, 'polls']);
// Route::post('/poll/vote', [ApiController::class, 'vote']);
// Route::get('/ad/{position}', [ApiController::class, 'ad']);

// Route::get('/posts/{take?}/{skip?}', [ApiController::class, 'posts']);
// Route::get('/lead-post/{take?}/{skip?}', [ApiController::class, 'leadPost']);

// Route::get('/{category}/article/{id}', [ApiController::class, 'singlePost']);
// Route::get('/show-categories/{take?}/{skip?}',[ApiController::class,'showCategories']);
// Route::get('/menus/{take?}/{skip?}',[ApiController::class,'menus']);
// Route::get('/category-with-posts/{category_slug}/{take?}/{skip?}',[ApiController::class,'categoryWithPosts']);
// Route::get('/posts-by-category/{category_id}/{take?}/{skip?}',[ApiController::class,'postsByCategory']);

Route::get('/settings', [ApiController::class, 'settings']);
Route::get('/today-dates', [ApiController::class, 'dates']);
Route::get('/latest-posts', [ApiController::class, 'latestPosts']);
Route::get('/header-content', [ApiController::class, 'header']);
Route::get('/post-search',[ApiController::class,'postSearch']);
Route::get('/reporter-posts/{id}', [ApiController::class, 'reporterPosts']);
Route::get('/tag-posts/{tagSlug?}', [ApiController::class, 'tagPosts']);
Route::get('/category-post/{categorySlug?}', [ApiController::class, 'categoryPost']);
Route::get('/sub-category-post/{categorySlug?}/{subCategorySlug?}', [ApiController::class, 'subCategoryPost']);
Route::get('/home-first-section',[ApiController::class,'homeFirstSection']);
Route::get('/home-second-section',[ApiController::class,'homeSecondSection']);
Route::get('/locations', [ApiController::class, 'getLocations']);
Route::get('/location-news', [ApiController::class, 'getLocationNews']);
Route::get('/videos', [ApiController::class, 'videos']);
Route::get('/single-video/{uniqid?}', [ApiController::class, 'singleVideoGallery']);
Route::get('/{categorySlug}/{uniqid}', [ApiController::class, 'SinglePost']);
Route::get('/privacy-policy', [ApiController::class, 'privacyPolicy']);
Route::get('/terms', [ApiController::class, 'terms']);
Route::get('/contact-us', [ApiController::class, 'contactUs']);
Route::get('/about-us', [ApiController::class, 'aboutUs']);