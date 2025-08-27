<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_time',
        'date',
        'reason',
        'user_id',
        'hospital_id',
        'doctor_id',
        'pet_id',
        'is_cancelled',
        'viewed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function veterinarian()
    {
        return $this->belongsTo(Veterinarian::class,'doctor_id');
    }
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id');
    }
}
