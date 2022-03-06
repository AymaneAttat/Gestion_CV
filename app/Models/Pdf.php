<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Pdf extends Model
{
    use HasFactory;

    protected $fillable = ['path'];

    //public function post(){
    //    return $this->belongsTo('App\Post');}

    public function pdfable(){
        return $this->morphTo();
    }

    /*public function url(){
        return Storage::url($this->path);
    }*/

    public function getpathAttribute($value){
        return $this->attributes['path'] = Storage::url($value);
    }
}
