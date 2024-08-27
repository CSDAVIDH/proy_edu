<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
 
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function administrativos()
    {
        return $this->hasMany('App\Models\Administrativo');
    }
    public function docente()
    {
        return $this->hasOne(Docente::class);


    }
    public function estudiante()
    {
       // return $this->hasMany('App\Models\Estudiante');
           return $this->hasOne(Estudiante::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
        
    }

}
