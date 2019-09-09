<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table ='curso';
    public $timestamps=false;
    
    protected $fillable=[
      'nombre'	,
      'nivel',
      'estado'
    ];


    protected $appends = ['estados'];



    public function setNombreAttribute($nombre)
    {
          
           $this->attributes['nombre']= title_case($nombre);
         
    }

    
    public function setDescripcionAttribute($descripcion)
    {
           
            $this->attributes['descripcion']= title_case($descripcion);
    }

      public function getEstadosAttribute()
    {
        return array('Activo','Inactivo');
    }

   

    public function planGradoCurso()
    {
      return $this->hasMany('App\PlanAcademicoGradoCurso','curso'); 
    }



}
