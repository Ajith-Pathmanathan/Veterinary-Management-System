<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veterinarian extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'education', 'experience', 'education_certificate','occupation','NIC_copy','profile_picture'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

