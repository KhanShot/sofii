<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 'all_dots', 'pressed_dots',
        'unpressed_dots', 'eye',
    ];
}
