<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table ='alumno';
    protected $primaryKey='nrodocumento';
    public $timestamps=false;
    public $incrementing=false;

    protected $fillable=[
     
      'nrodocumento',
      'estadoacademico',
      'apoderado'
    ];


     public function persona()
    {
       
       return $this->belongsTo('App\Persona','nrodocumento');

    }

     public function deudas()
    {
      return $this->hasMany('App\Deuda','alumno');
    }

    public function datosApoderado()
    {
      return $this->belongsTo('App\Apoderado','apoderado');
    }


}
