<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineContent extends Model
{
    use HasFactory;
    protected $table = 'medicine_content';
    protected $fillable = ['medicine_category_id', 'title', 'slug', 'image', 'short_content', 'content', 'status'];
}
