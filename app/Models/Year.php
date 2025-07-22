<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Year extends Model
{
    use HasFactory;
    
    protected $table = 'years';
    protected $fillable = [
        'title',
        'slug',
        'status',
    ];

    public function awards()
    {
        return $this->hasMany(Awards::class);
    }

    public function newsRooms()
    {
        return $this->hasMany(NewsRoom::class, 'year_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($year) {
            $year->slug = static::generateUniqueSlug($year->title);
        });
    }

    protected static function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }
}