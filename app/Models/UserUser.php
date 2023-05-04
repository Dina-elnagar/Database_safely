<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserUser extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'emergency_contact_id',
        'relationship',
    'created_at',
    'updated_at',];
}
