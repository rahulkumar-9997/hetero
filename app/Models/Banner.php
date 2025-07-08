<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table = 'banners';
    protected $fillable = [
        'banner_heading_name',
        'banner_content',
        'banner_other_content',
        'banner_link',
        'banner_desktop_img',
        'banner_mobile_img'
    ];
}
