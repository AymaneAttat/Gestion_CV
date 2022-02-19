<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function scopeWithFilters($query, $profiles){
        return $query->whereIn('skill1', $profiles);
    }
    /*->when(count($prices), function ($query) use ($prices){
                $query->where(function ($query) use ($prices) {
                    $query->when(in_array(0, $prices), function ($query) {
                            $query->orWhere('price', '<', '5000');
                        })
                        ->when(in_array(1, $prices), function ($query) {
                            $query->orWhereBetween('price', ['5000', '10000']);
                        })
                        ->when(in_array(2, $prices), function ($query) {
                            $query->orWhereBetween('price', ['10000', '50000']);
                        })
                        ->when(in_array(3, $prices), function ($query) {
                            $query->orWhere('price', '>', '50000');
                        });
                });
            }); */
}
