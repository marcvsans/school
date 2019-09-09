<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    
    protected $table ='director';
    protected $primaryKey='nrodocumento';
    public $timestamps=false;
    public $incrementing=false;

    protected $fillable=[
     
      'nrodocumento',
      'estado'
   
    ];
  protected $appends = ['estados'];

  

       public function getEstadosAttribute()
    {
        return array('Activo','Inactivo');
    }

       public function persona()
    {
       
       return $this->belongsTo('App\Persona','nrodocumento');

    }

  
}
