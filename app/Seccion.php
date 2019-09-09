<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    protected $table ='seccion';
    public $timestamps=false;
   


    protected $fillable=[
   
      'grado',
      'letra',
      'anio_acad',
      'capacidad'
    ];


     public function cursos()
    {
       
       return $this->hasMany('App\SeccionDocenteCurso','seccion'); 

    }
 
    public function Alumnos()
    {
        return $this->hasMany('App\Matricula','seccion');
    }

    public function datosGrado()
    {

      return $this->belongsTo('App\Grado','grado');
  
    }

 

    public function datosAnio() 
    {

      return $this->belongsTo('App\AnioAcademico','anio_acad'); 
  
    }
    
}
