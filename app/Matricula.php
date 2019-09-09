<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
     protected $table ='matricula';
	 protected $primaryKey='idmatricula';
   public $timestamps=false;
   public $incrementing=false;

       protected $fillable=[
     
      'alumno',
      'seccion',
      'costo',
      'fecha',
      'anio'
    ];
 

      public function datosalumno()
    {
       
       return $this->belongsTo('App\Alumno', 'alumno');

    }

       public function datosSeccion()
    {
       
       return $this->belongsTo('App\Seccion', 'seccion');

    }
}
