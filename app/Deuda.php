<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deuda extends Model
{
        protected $table ='deuda';
   
    public $timestamps=false;
 

    protected $fillable=[
     
      'pago',
      'alumno',
    
      'estado'
   
    ];


        public function pagoInfo()
    {
      return $this->belongsTo('App\Pago','pago');
    }
          public function alumnoInfo()
    {
      return $this->belongsTo('App\Alumno','alumno');
    }

    public function descuentos()
    {
      return $this->hasMany('App\DeudaDescuento', 'deuda');
    }

           public function cajaInfo()
    {
      return $this->hasOne('App\caja','deuda');
    }

}
