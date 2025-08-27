<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    use HasFactory;

    protected $fillable = ['pet_id', 'doctor_id', 'details', 'medicines'];

    public function pet()
    {
        return $this->belongsTo(Pet::class,'pet_id' );
    }


    public function user()
    {
        return $this->belongsTo(User::class,'doctor_id'); // Fixed class name
    }
}


