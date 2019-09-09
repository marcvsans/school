<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
     protected $table ='pago';
   
    public $timestamps=false;
   
  protected $dates = [
        'fechavencimiento' 
    ];
    protected $fillable=[
     
      'descripcion',
      'cantidad',
      'anio',
      'fechavencimiento',
      'mora_dia'
   
    ];

}
