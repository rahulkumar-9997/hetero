<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class NewsAndMediaCategory extends Model
{
    use HasFactory;
    protected $table = 'news_and_media_categories';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'file',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = $model->generateUniqueSlug($model->title);
        });

        static::updating(function ($model) {
            if ($model->isDirty('title')) {
                $model->slug = $model->generateUniqueSlug($model->title);
            }
        });
    }

    public function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while ($this->slugExists($slug)) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }

    protected function slugExists($slug)
    {
        return static::where('slug', $slug)
            ->where('id', '!=', $this->id ?? null)
            ->exists();
    }

}
