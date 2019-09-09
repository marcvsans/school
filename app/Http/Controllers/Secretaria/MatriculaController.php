<?php
namespace App\Http\Controllers\Secretaria;
 
use App\Http\Controllers\Controller;


use Storage;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Seccion;
use App\Alumno;
use App\Matricula;
use App\Repositories\SeccionRepository;
use App\Repositories\AlumnoRepository;
use App\Repositories\MatriculaRepository;
use App\Repositories\GradoRepository;


use Carbon\Carbon;

class MatriculaController extends Controller
{
 
    protected $seccion;
    protected $alumno;
    protected $matricula;
    protected $grado;


    public function __construct(AlumnoRepository $alumno,SeccionRepository $seccion,MatriculaRepository $matricula,GradoRepository $grado)
    {
        $this->seccion = $seccion;
        $this->alumno=$alumno;
        $this->matricula=$matricula;
        $this->grado=$grado;
    }


          public function getAll()
    {





      $matriculas = Matricula::with(['datosalumno','datosSeccion.datosGrado','datosSeccion.datosAnio'])->latest('fecha')->get();
         $output = array('data' => array());
       foreach ($matriculas as $matricula ) {
 $datosmatricula=$matricula->datosalumno;
   

              




    $output['data'][] = array(
    
    $matricula['alumno'] ,    
    $matricula->datosalumno->persona->apellidos.' '.$matricula->datosalumno->persona->nombres    ,   
    $this->grado->nivel($matricula->datosSeccion->datosGrado->nivel),
    $this->grado->labelName($matricula->datosSeccion->datosGrado->numero) .$this->seccion->letra($matricula->datosSeccion->letra) . ' '.$matricula->datosSeccion->datosAnio->anio,
             
    date("Y/m/d h:i:s a ",strtotime($matricula['fecha']))
      
    );
       }


      return response()->json($output);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('Secretaria.matricula.index',['secciones'=>Seccion::with(['datosAnio','datosgrado'])->get()->where('datosAnio.estado','Activo'),'repo_grado'=>$this->grado]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          return $this->matricula->save($request);    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
