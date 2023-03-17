<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_medical_case extends Model
{
    use HasFactory;
   protected $fillable = [
        'user_id',
        'medical_case_id',
    ];
}
