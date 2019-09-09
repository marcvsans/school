<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeccionDocenteCurso extends Model
{
     protected $table ='seccion_docente_curso';
 
    public $timestamps=false;
 

   protected $fillable=[
     
      'curso',
      'seccion',
      'docente',
      'anio'
   
    ];


   
      
    public function cursoinfo()
    {
      return $this->belongsTo('App\PlanAcademicoGradoCurso','curso'); 
    }

     public function docenteinfo()
    {
      return $this->belongsTo('App\Docente','docente');
    }

       public function seccionInfo()
    {
      return $this->belongsTo('App\Seccion','seccion');
    }

}
