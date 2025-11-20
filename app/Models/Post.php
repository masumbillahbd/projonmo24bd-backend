<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Tag;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\ReadMore;
use App\Models\Reporter;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'uniqid', 'publisher_name', 'headline', 'single_page_headline', 'sub_headline', 'slug', 'excerpt', 'facebook_description', 'post_content', 'featured_image', 'featured_mini', 'sticky', 'post_status', 'reporter_photo','featured_image_caption', 'watermark', 'sm_image', 'sub_cat_id', 'special', 'publish_time'];
    protected $table = 'posts';

    public function timelines() {
        return $this->belongsToMany(Timeline::class);
    }

    public function category() {
        return $this->belongsToMany(Category::class);
    }
    public function categories() {
        return $this->belongsToMany(Category::class);
    }
    public function subCategory()
    {
        return $this->belongsToMany(SubCategory::class);
    }
    
    public function division()
    {
        return $this->belongsToMany(Division::class);
    }
    
    public function district()
    {
        return $this->belongsToMany(District::class);
    }
    public function upazila()
    {
        return $this->belongsToMany(Upazila::class);
    }

    public function Tag()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
    
    
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function reporter()
    {
        return $this->belongsTo(Reporter::class);
    }
    
    public function readmore()
    {
        return $this->hasMany(ReadMore::class);
    }
}
