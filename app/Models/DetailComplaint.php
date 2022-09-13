<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailComplaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'complaint_id',
        'personal_in_charge'
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class, 'id', 'detail_complaint_id');
    }
}
