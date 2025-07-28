<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class MedicineCategories extends Model
{
    use HasFactory;
    protected $table = 'medicine_categories';
    protected $fillable = ['title', 'slug', 'image', 'content', 'status'];

    public function medicineContents()
    {
        return $this->hasMany(MedicineContent::class, 'medicine_category_id');
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
