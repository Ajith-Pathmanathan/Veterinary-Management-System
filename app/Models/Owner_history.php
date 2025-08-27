<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner_history extends Model
{
    use HasFactory;
    protected $fillable = ['farm_id','pet_id', 'to_date', 'from_date'];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
}
