<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'picture_path',
        'location',
        'district',
        'is_public',
        'is_anon',
        'caption'

    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }


    //asesor created at ~afd
    // public function getCreatedAttribute($svalue)
    // {
    //     return Carbon::parse($value)->timestamp;
    // }

    //asesor updated at ~afd
    // public function getUpdatedAttribute($svalue)
    // {
    //     return Carbon::parse($value)->timestamp;
    // }

    public function getPicturePathAttribute()
    {
        return url('') . Storage::url($this->attributes['picture_path']);
    }
}


