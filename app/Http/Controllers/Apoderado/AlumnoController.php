<?php

namespace App\Http\Controllers\Apoderado;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Matricula;
use App\Repositories\SeccionRepository;
use App\Repositories\GradoRepository;

class AlumnoController extends Controller
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
      return  view('apoderado.alumno.index');
    }


    public function getAll()
    {
    	 $alumnos=auth()->user()->persona->apoderado->alumnos;
       

    	         $output = array('data' => array());
        foreach ($alumnos as $alumno) {
      
            $output['data'][] = array(
              $alumno ->persona->nrodocumento,
                $alumno->persona->nombres ." ".  $alumno->persona->apellidos ,           
       
                '<a class="btn btn-xs btn-success" href="'.route('Apoderado.Grado.Index',['id'=>$alumno ->nrodocumento]).'"   >ver <i class="ace-icon fa fa-eye align-top bigger-125 icon-on-right"></i></a>', 
          
                '<a class="btn btn-xs btn-success" href="'.route('Apoderado.Horario.Index',['id'=>$alumno->nrodocumento]).'"   >ver <i class="ace-icon fa fa-eye align-top bigger-125 icon-on-right"></i></a>',    
            );
        }


    	return response()->json($output);
    }


  
}
