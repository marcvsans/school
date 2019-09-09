<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class HorasLibre extends Model
{
     protected $table ='horaslibre';
     protected $primaryKey='id';
  
    public $timestamps=false;
    


    protected $fillable=[
      'idconfig'	,
      'horainicio',
      'duracionclase',
      'descripcion',
      'duracion'
    ];

    public function setHoraInicioAttribute($horainicio)
    {
          
           $this->attributes['horainicio']= date("H:i:s",strtotime($horainicio));
          
    }



     public function HorarioConfig()
    {
      return $this->belongsTo('App\HorasrioConfig','idconfig');
    }

}
