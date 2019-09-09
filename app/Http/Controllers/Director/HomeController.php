<?php

namespace App\Http\Controllers\Director;
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

use Carbon\Carbon;

class HomeController extends Controller
{
    
    public function Data()
    {
    	 

    }

    public function index()
    {

        $anios=AnioAcademico::with(['secciones.datosGrado','datosPlanAcademico'])->where('estado','Activo')->get();

 $secciones =0;
foreach ($anios as $anio) {

$secciones +=$anio->secciones->count();
       
       }


    	$data= collect([
    'alumnos' => Alumno::All()->count(),
    'alumnos.activo' => Alumno::where('estadoacademico','Estudiando')->count(),
    'alumnos.egresado' => Alumno::where('estadoacademico','Egresado')->count(),
    'alumnos.retirado' => Alumno::where('estadoacademico','Retirado')->count(),
    'alumnos.suspendido' => Alumno::where('estadoacademico','Suspendido')->count(),

    'docentes' =>Docente::All()->count(),
    'docentes.activo' => Docente::where('estado','Activo')->count(),

    'apoderados'=>Apoderado::All()->count(),

    'secciones'=>$secciones,

    'cursos'=>Curso::All()->count(),
    

    'deuda'=>Deuda::All()->count(),
    'deuda.pagado'=>Deuda::where('estado','Pagado')->count(),
    'deuda.pendiente'=>Deuda::where('estado','Pendiente')->count(),

    'caja'=>Caja::with(['deudaInfo'])->orderBy('fecha','desc')->limit(5)->get(),

    'user'=>User::with(['persona'])->orderBy('created_at','desc')->limit(9)->get(),


    
]);
    	


    	  return view('director.index',['data'=>$data]);
    }

    


}
