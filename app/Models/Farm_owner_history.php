<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm_owner_history extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','farm_id','to_date', 'from_date'];
    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
