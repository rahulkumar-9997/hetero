<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MedicineContent extends Model
{
    use HasFactory;
    protected $table = 'medicine_content';
    protected $fillable = ['medicine_category_id', 'title', 'slug', 'image', 'short_content', 'content', 'status'];

    public function MedicineCategory()
    {
        return $this->belongsTo(MedicineCategories::class, 'medicine_category_id');
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($page) {
            $page->slug = $page->createSlug($page->title);
        });
    }

    private function createSlug($title)
    {
        $slug = Str::slug($title);
        $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
        return $count ? "{$slug}-{$count}" : $slug;
    }
}
