<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical_case extends Model
{
    use HasFactory;
    protected $fillable = [
       'blood_type',
       'blood_pressure',
       'diabetes',
       'another_health_problem',
    ];
}
