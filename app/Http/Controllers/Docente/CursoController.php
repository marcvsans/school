<?php


namespace App\Http\Controllers\Docente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\AnioAcademico; 
use App\SeccionDocenteCurso; 


use App\Repositories\GradoRepository;

use App\Repositories\SeccionRepository;



class CursoController extends Controller
{
    
  protected $seccion;
    protected $grados;
      

	    public function __construct(SeccionRepository $seccion,GradoRepository $grados)
    {
      
                   $this->grados=$grados;
        $this->seccion=$seccion;
       

    }




    public function index()
    {
        return view('docente.curso.index');
    }

    public function getAll(Request $request)
    {

        $output = array('data' => array());

        $anios=AnioAcademico::with(['secciones.datosGrado','datosPlanAcademico'])->where('estado','Activo')->get();

        foreach ($anios as $anio) {

        $secciones=$anio->secciones;
        foreach ($secciones as $seccion) {

        $cursos=SeccionDocenteCurso::where(["docente"=>$request->user()->user,"seccion"=>$seccion->id])->with(["seccioninfo","cursoinfo"])->get();

        foreach ($cursos as $curso ) {


        $output['data'][] = array(


       $curso->cursoInfo->datosCurso->nombre,
       $this->grados->labelName($seccion->datosGrado->numero). $this->seccion->letra($seccion->letra) ,
        $this->grados->nivel($seccion->datosGrado->nivel),
             $seccion->datosAnio->anio,
        '<a class="btn btn-xs btn-success" href="'.route('Docente.Notas.Index',['id'=>$curso->id]).'"   >Asignar</a>',  



        );
        }

        }

        }





        return response()->json($output);
    }



}
