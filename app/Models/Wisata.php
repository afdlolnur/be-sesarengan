<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;
    protected $table = 'wisata';

    protected $fillable = [
        'name',
        'photo',
        'address',
        'description',
        'is_publish'
    ];
    
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
}
