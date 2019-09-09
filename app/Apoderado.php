<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apoderado extends Model
{
    protected $table ='apoderado';
    protected $primaryKey='nrodocumento';
    public $timestamps=false;
    public $incrementing=false;

    protected $fillable=[
     
      'nrodocumento',
      'ocupacion',
      'estado'
     
    ];

protected $appends = ['estados'];




      public function setOcupacionAttribute($ocupacion)
    {
           
           $this->attributes['ocupacion']=title_case( $ocupacion);
    }

    public function getEstadosAttribute()
    {
        return array('Activo','Inactivo');
    }

        public function persona()
    {
       
       return $this->belongsTo('App\Persona','nrodocumento');

    }

public function p()
{
    return $this->hasOne('App\Persona','nrodocumento');
}
    public function alumnos()
    {
       return $this->hasMany('App\Alumno', 'apoderado');
    }

}
