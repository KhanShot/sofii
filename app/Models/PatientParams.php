<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientParams extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id', 'duration', 'size', 'dot_size', 'sectors'
    ];
}
