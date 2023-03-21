<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emergency_contact extends Model
{
    use HasFactory;

    protected $fillable =
        ['contact_name',
         'phone_number'];

   
}
