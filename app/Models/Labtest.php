<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labtest extends Model
{
    use HasFactory;
    protected $fillable = [
        'pet_id',
        'test_type',
        'test_detail',
    ];
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

}
