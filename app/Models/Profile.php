<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Pdf;
//use Carbon\Carbon;

class Profile extends Model
{
    use HasFactory;

    protected $dateFormat = 'Y.m.d';

    protected $fillable = [ 'email', 'prenom', 'nom', 'telephone', 'date_debut_experience', 'formation', 'skill1', 'skill2', 'skill3', 'skill4', 'skill5'];

    protected $casts = [
        'date_debut_experience' => 'datetime:Y/m/d',
    ];

    /*public function setDateDebutExperienceAttribute($value)
    {
        $this->attributes['date_debut_experience'] = Carbon::createFromFormat('Y/m/d', $value)->format('Y-m-d');
    }*/

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function pdf(){
        return $this->morphOne(Pdf::class, 'pdfable');
    }
}
