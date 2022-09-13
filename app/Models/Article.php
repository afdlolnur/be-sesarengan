<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'is_publish'
    ];
    
     public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->translatedFormat('l jS F Y, h:i');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->translatedFormat('l jS F Y, h:i');
    }
}
