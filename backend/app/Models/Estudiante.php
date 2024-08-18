<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function persona()
    {
        //return $this->hasOne(Persona::class);
        return $this->belongsTo('App\Models\Persona');
    }
}
