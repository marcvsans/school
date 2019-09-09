<?php
namespace App\Repositories;
use App\Matricula;
use App\Seccion;
use Illuminate\Http\Request;

use Carbon\Carbon;
/**
* 
*/
class MatriculaRepository
{



	public function save(Request $request)
	{
	  $matriculas= Matricula::with('datosSeccion')->where($request->only(['alumno']))->get();
      $seccion=Seccion::find($request->seccion);

      $anioSeccion=$seccion->datosAnio->anio;

$validacion=0;
      foreach ($matriculas as $matricula) {
         
         if ($matricula->datosSeccion->datosAnio->anio == $anioSeccion) {
            $validacion=1;
         } 
         
      }

    $validacion2=Matricula::where("seccion",$request->seccion)->count();
    $capacidad=Seccion::find($request->seccion);
    $vacanteslibres=$capacidad->capacidad - $validacion2;

    if ($vacanteslibres >= 1) {
        if ($validacion==0) {
             $matricula= Matricula::create($request->all());
                         
             return response()->json(['messages' =>'Matricula Registrada Correctamente','success'=>true ,$vacanteslibres ]);
          } else {
              return response()->json(['messages' =>'El alumno solo puede tener una matricula  por  año  academico'],422);
         }
    } else {
     return response()->json(['messages' =>'No hay vacantes  libres para esta seccion'],422);
    }
    

      
           
	}



}