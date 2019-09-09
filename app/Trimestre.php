<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trimestre extends Model
{
    protected $table ='trimestre';
    public $timestamps=false;
    


    protected $fillable=[
      'fechainicio',
      'fechafin',
      'numero',

      'anio_acad'
    ];


     public function cursos()
    {
       
       return $this->hasMany('App\SeccionDocenteCurso','seccion');

    }

    public function datosAnio()
    {
      return $this->belongsTo('App\AnioAcademico','anio_acad');
    }
}
