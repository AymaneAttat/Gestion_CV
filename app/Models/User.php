<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;
//use App\Http\Traits\ExposePermissions;, ExposePermissions
use Illuminate\Support\Facades\Auth;
use App\Models\MailProfile;
use App\Models\Profile;
use App\Models\Historical;
//use App\Models\Role;
use App\Models\Pdf;
//use Laravel\Sanctum\HasApiTokens;HasApiTokens, 

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.'password_gmail',
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function profiles(){
        return $this->hasMany(Profile::class);
    }

    /*public function role(){
        return $this->belongsTo(Role::class);
    }*/

    public function pdf(){
        return $this->morphOne(Pdf::class, 'pdfable');
    }

    public function Historicals(){
        return $this->hasMany(Historical::class);
    }
    
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }
    /**
     * Override the mail body for reset password notification mail.
     */
    public function sendPasswordResetNotification($token){
        $this->notify(new \App\Notifications\MailResetPasswordNotification($token));
    }

    public function mailProfiles(){
        return $this->hasMany(MailProfile::class);
    }
}
