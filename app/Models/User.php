<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Post;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubMenu;
use App\Models\Photo;
use App\Models\Page;
use App\Models\Menu;
use App\Models\Ad;
use App\Models\VideoGallery;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'short_name',
        'email',
        'password',
        'position',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }
    
    public function ad()
    {
        return $this->hasMany(Ad::class);
    }
    
    public function category()
    {
        return $this->hasMany(Category::class);
    }
    
    public function subCategory()
    {
        return $this->hasMany(SubCategory::class);
    }
    public function subMenu()
    {
        return $this->hasMany(SubMenu::class);
    }
    public function photo()
    {
        return $this->hasMany(Photo::class);
    }
    public function page()
    {
        return $this->hasMany(Page::class);
    }
    public function menu()
    {
        return $this->hasMany(Menu::class);
    }
    
    public function videoGallery()
    {
        return $this->hasMany(VideoGallery::class);
    }

    // ==============


    public function posts(){
        return $this->hasMany(Post::class);
    }
    
    public function ads(){
        return $this->hasMany(Ad::class);
    }

    public function polls(){
        return $this->hasMany(Poll::class);
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }
    
    public function subCategories(){
        return $this->hasMany(SubCategory::class);
    }
    public function subMenus(){
        return $this->hasMany(SubMenu::class);
    }
    public function photos(){
        return $this->hasMany(Photo::class,'user_id','id');
    }
    public function pages(){
        return $this->hasMany(Page::class);
    }
    public function menus(){
        return $this->hasMany(Menu::class);
    }
    
    public function videoGalleries(){
        return $this->hasMany(VideoGallery::class);
    }

    public function ramadans(){
        return $this->hasMany(Ramadan::class);
    }
    public function sliders(){
        return $this->hasMany(Slider::class,'author','id');
    }
    
}
