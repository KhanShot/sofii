<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'gender', 'birthday', 'notes'
    ];
    public function params()
    {
        return $this->hasOne(PatientParams::class, 'patient_id');
    }
    public function results(){
        return $this->hasMany(Results::class, 'patient_id');
    }
}
