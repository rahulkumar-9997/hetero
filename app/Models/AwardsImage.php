<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwardsImage extends Model
{
    use HasFactory;
    protected $table = 'awards_images';
    protected $fillable = [
        'award_id',
        'file',
    ];

    public function award()
    {
        return $this->belongsTo(Awards::class);
    }
}
