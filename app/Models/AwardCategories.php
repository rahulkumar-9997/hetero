<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwardCategories extends Model
{
    use HasFactory;
    protected $table = 'award_categories';
    protected $fillable = [
        'title',
        'slug',
        'status',
    ];
    public function awards()
    {
        return $this->hasMany(Awards::class, 'awards_category_id');
    }
}
