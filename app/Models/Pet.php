<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    // Fillable fields to allow mass assignment
    protected $fillable = [
        'pet_id',
        'type',
        'breed',
        'date_of_birth',
        'color',
        'gender',
        'farm_id',
    ];

    /**
     * Define the relationship with the Farm model.
     * A pet belongs to a farm.
     */
    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
    public function labtest()
    {
        return $this->belongsTo(Labtest::class);
    }
}
