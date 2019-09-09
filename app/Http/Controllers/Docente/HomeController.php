<?php

namespace App\Http\Controllers\Docente;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Alumno;
use App\Docente;
use App\Apoderado;
use App\Seccion;
use App\Curso;
use App\Deuda;
use App\Caja;
use App\User;
use App\AnioAcademico;
use App\SeccionDocenteCurso;

use Carbon\Carbon;

class HomeController extends Controller
{
    
    public function Data()
    {
    	 

    }

    public function index()
    {

    


        $anios=AnioAcademico::with(['secciones.datosGrado','datosPlanAcademico'])->where('estado','Activo')->get();
        $cursos=collect();
        foreach ($anios as $anio) {

        $secciones=$anio->secciones;
        foreach ($secciones as $seccion) {

        $cursos=SeccionDocenteCurso::where(["docente"=>auth()->user()->user,"seccion"=>$seccion->id])->with(["seccioninfo","cursoinfo"])->get();
     
 
        }

        }

    	$data= collect([
  
    'cursos'=>$cursos,

]);
    	


    	  return view('docente.index',['data'=>$data]);
    }

    


}
