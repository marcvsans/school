<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
     
    protected $table ='notas';
    protected $primaryKey='idnota';
    public $timestamps=false;
    public $incrementing=false;

    protected $fillable=[
     
      'alumno',
      'nota',
      'criterio',
      'curso',
      'trimestre'
   
    ];


  

  

       public function persona()
    {
       
       return $this->belongsTo('App\Persona','nrodocumento');

    }

    public function cursos()
    {
      return $this->hasMany('App\SeccionDocenteCurso','docente');
    }

}
