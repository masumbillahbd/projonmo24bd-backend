<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\Category;
class VideoGallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'video_url',
        'video_id',
        'thumbnail',
        'streaming_site',
        'uniqid',
    ];
    
    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
    public function Tag()
    {
        return $this->belongsToMany(Tag::class);
    }
}