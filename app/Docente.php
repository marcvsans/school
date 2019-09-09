<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table ='docente';
    protected $primaryKey='nrodocumento';
    public $timestamps=false;
    public $incrementing=false;

    protected $fillable=[
     
      'nrodocumento',
      'especialidad',
      'estado',
      'nivel'
   
    ];

 protected $appends = ['estados'];

  

        public function setEspecialidadAttribute($especialidad)
    {
           
           $this->attributes['especialidad']=title_case( $especialidad);
    }

       public function getEstadosAttribute()
    {
        return array('Activo','Inactivo');
    }


       public function persona()
    {
       
       return $this->belongsTo('App\Persona','nrodocumento');

    }

    public function cursos()
    {
      return $this->hasMany('App\SeccionDocenteCurso','docente');
    }


}
