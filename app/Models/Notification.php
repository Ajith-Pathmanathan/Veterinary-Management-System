<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id','user_id','appointment_time','discription','viewed'];
    public function user(){
        return $this->belongsTo(user::class);
    }
}
