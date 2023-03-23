<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Medical_case extends Model
{
    use HasFactory;
    protected $fillable = [
       'blood_type',
       'blood_pressure',
       'diabetes',
       'another_health_problem',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class,'user_medical_cases');
    }
}
