<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedStory extends Model
{
    use HasFactory;
    protected $table = 'featured_stories';
    protected $fillable = [
        'new_and_media_category_id',
        'title',
        'sub_title',
        'slug',
        'content',
        'meta_title',
        'meta_description',
        'image',
        'status',
    ];

    public function newsMediaCategory()
    {
        return $this->belongsTo(NewsAndMediaCategory::class, 'new_and_media_category_id');
    }
}
