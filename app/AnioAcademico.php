<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnioAcademico extends Model
{
   
       protected $table ='anio_academico';
    public $timestamps=false;
  

    protected $fillable=[
   
      'descripcion',
      'anio',
      'nivel',
      'planacad',
      'estado',
      'conf_horario'
    ];

        public function datosPlanAcademico()
    {
      return $this->belongsTo('App\PlanAcademico','planacad');
    }
           public function datosHorarioConfig()
    {
      return $this->belongsTo('App\HorarioConfig','conf_horario');
    }

    public function secciones()
    {

      return $this->hasMany('App\Seccion','anio_acad');

    }
       public function trimestres()
    {

      return $this->hasMany('App\Trimestre','anio_acad');

    }

}
