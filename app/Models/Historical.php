<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MailProfile;
use App\Models\Profile;
use App\Models\User;

class Historical extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'profile_ids', 'user_id', 'skills'];

    /*public function mailProfiles(){
        return $this->belongsToMany(MailProfile::class, 'mail_profile_order');
    }*/

    public function mailProfiles(){
        return $this->hasOne(MailProfile::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    /*public function Profiles(){
        return $this->hasMany(Profile::class);
    }*/
}
