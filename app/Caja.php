<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    
        protected $table ='caja';
   
    public $timestamps=false;
   
   protected $dates = [
        'fecha'
    ];

    protected $fillable=[
     
      'deuda',
      'fecha', 
      'operacion',
    
      'cajero'
   
    ];


        public function deudaInfo()
    {
      return $this->belongsTo('App\Deuda','deuda');
    }

      public function descuentos()
    {
      return $this->hasMany('App\DeudaDescuento', 'caja');
    }

}
