<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HorarioConfig extends Model
{
     protected $table ='confighorario';
    
  
    public $timestamps=false;
    


    protected $fillable=[
      'nombre'	,
      'horainicio',
      'horafin',
      'lunes',
      'martes',
      'miercoles',
      'jueves',
      'viernes',
      'sabado',
      'domingo',
      'duracionclase',
      'nivel'
    ];

    public function setHoraInicioAttribute($horainicio)
    {
          
           $this->attributes['horainicio']= date("H:i:s",strtotime($horainicio));
    }

    
    public function setHoraFinAttribute($horafin)
    {
           
            $this->attributes['horafin']= date("H:i:s",strtotime($horafin));
    }


      public function Horario()
    {
       
       return $this->belongsTo('App\HorarioConfig','id');

    }

    public function HorasLibre()
    {
      return $this->hasMany('App\HorasLibre','idconfig');
    }

}
