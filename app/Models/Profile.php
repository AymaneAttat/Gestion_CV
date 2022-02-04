<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [ 'email', 'prenom', 'nom', 'telephone', 'date_debut_experience', 'formation', 'skill1', 'skill2', 'skill3', 'skill4', 'skill5'];
}
