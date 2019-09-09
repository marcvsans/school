<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CursoCriterio extends Model
{
    protected $table ='curso_criterio';
  
    public $timestamps=false;
    


    protected $fillable=[
  'curso', 
  'criterio'
    ];


    public function datosCriterio()
    {
      return $this->belongsTo('App\CriterioEvaluacion','criterio');
    }


}
