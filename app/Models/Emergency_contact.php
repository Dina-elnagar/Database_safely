<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\User;

class Emergency_contact extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable =
        [
            'first_name',
            'last_name',
            'phone_number',
        ];
        // ['contact_name',
        //  'phone_number_emergemncy'
        // ];
        public function user()
        {
            return $this->belongsToMany(User::class,'user_emergency_contacts');
        }

}
