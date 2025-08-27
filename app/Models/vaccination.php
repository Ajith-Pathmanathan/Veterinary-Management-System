<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vaccination extends Model
{
    use HasFactory;
    protected $fillable = ['pet_id',  'vaccination_date', 'vaccine_id', 'dose'];
    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}
