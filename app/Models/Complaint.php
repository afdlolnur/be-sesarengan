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
        // 'title',
        'description',
        'picture_path',
        'latitude',
        'longitude',
        'district',
        'is_public',
        'is_anon',
        'caption_id',
        'status',
        'pending_at',
        'time'

    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->select(['id', 'name','email']);
    }
    
    public function caption()
    {
        return $this->hasOne(Caption::class, 'id', 'caption_id')->select(['id', 'caption']);
    }


    //asesor created at ~afd
    public function getCreatedAtAttribute($value)
    {
        //return Carbon::parse($value)->timestamp;
        // return Carbon::parse($value)->isoFormat('dddd, D MMMM Y');
        return Carbon::parse($value)->translatedFormat('l jS F Y, h:i');
        
        // return Carbon::parse($value)->format('l jS \of F Y h:i:s A');
        
    }

    // asesor updated at ~afd
    public function getUpdatedAtAttribute($value)
    {
        // return Carbon::parse($value)->timestamp;
        return Carbon::parse($value)->translatedFormat('l jS F Y, h:i');
    }

    public function getPicturePathAttribute()
    {
        return url('') . Storage::url($this->attributes['picture_path']);
    }
    
    // asesor updated at ~afd
    public function getPendingAtAttribute()
    {
        // return Carbon::parse($value)->timestamp;
        return Carbon::parse($this->attributes['pending_at'])->translatedFormat('l jS F Y, h:i');
    }
    
    public function getTimeAttribute()
    {
        // return Carbon::parse($value)->timestamp;
        return Carbon::parse($this->attributes['time'])->translatedFormat('l jS F Y, h:i A');
    }
    
}


