<?php

namespace App\Http\Controllers\Alumno;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Matricula;
use App\Repositories\SeccionRepository;
use App\Repositories\GradoRepository;

class GradoController extends Controller
{  

  protected $seccion;
    protected $grado;


    public function __construct(SeccionRepository $seccion,GradoRepository $grado)
    {
        $this->seccion = $seccion;
        $this->grado=$grado;
    }

    public function index()
    {
      return  view('alumno.grado.index');
    }


    public function getAll()
    {
    	 $matriculas=Matricula::where(["alumno"=>request()->user()->user])->with(["datosseccion"])->get();

    	         $output = array('data' => array());
        foreach ($matriculas as $matricula ) {
      
            $output['data'][] = array(
                 $this->grado->labelName($matricula->datosSeccion->datosGrado->numero) ,
            $this->seccion->letra($matricula->datosSeccion->letra),
                 $this->grado->nivel($matricula->datosSeccion->datosGrado->nivel),
              $matricula->datosSeccion->datosAnio->anio,
           
          
                '<a class="btn btn-xs btn-success" href="'.route('Alumno.Notas.Index',['id'=>$matricula]).'"   >ver <i class="ace-icon fa fa-eye align-top bigger-125 icon-on-right"></i></a>',      
            );
        }


    	return response()->json($output);
    }


  
}
