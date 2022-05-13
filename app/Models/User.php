<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
//use Spatie\Permission\Traits\HasRoles;, HasRoles
use App\Models\Profile;
use App\Models\Order;
use App\Models\Role;
use App\Models\Pdf;
//use Laravel\Sanctum\HasApiTokens;HasApiTokens, 

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

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

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function pdf(){
        return $this->morphOne(Pdf::class, 'pdfable');
    }

    public function orders(){
        return $this->hasMany(Order::class);
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
}
