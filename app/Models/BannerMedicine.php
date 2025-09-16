<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerMedicine extends Model
{
    use HasFactory;
    protected $table = 'banner_medicine';
    protected $fillable = [
        'banner_id',
        'title',
        'link',
    ];
    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }
}
