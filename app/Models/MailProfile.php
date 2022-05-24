<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;
use App\Models\Historical;
use App\Models\User;

class MailProfile extends Model
{
    use HasFactory;

    /*public function orders(){
        return $this->belongsToMany(Order::class, 'mail_profile_order');
    }*/

    public function Historicals(){
        return $this->belongsTo(Historical::class)->withTimestamps();
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'mail_profile_profile')->withTimestamps();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
