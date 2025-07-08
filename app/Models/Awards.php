<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Awards extends Model
{
    use HasFactory;
    protected $table = 'awards';
    protected $fillable = [
        'year_id',
        'awards_category_id',
        'title',
        'slug',
        'content',
        'status',
    ];

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function awardCategory()
    {
        return $this->belongsTo(AwardCategories::class, 'awards_category_id');
    }

    public function awardImages()
    {
        return $this->hasMany(AwardsImage::class);
    }
}
