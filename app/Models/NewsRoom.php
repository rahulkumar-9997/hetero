<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsRoom extends Model
{
    use HasFactory;
    protected $table = 'news_rooms';
    protected $fillable = [
        'new_and_media_category_id',
        'title',
        'slug',
        'year_id',
        'location',
        'content',
        'post_date',
        'meta_title',
        'meta_description',
        'status',
    ];

    public function newsMediaCategory()
    {
        return $this->belongsTo(NewsAndMediaCategory::class, 'new_and_media_category_id');
    }

    public function year()
    {
        return $this->belongsTo(Year::class, 'year_id');
    }
}
