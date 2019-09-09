<?php

namespace App\Http\Controllers\Director; 
use App\Http\Controllers\Controller;
use Storage;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Persona;
use App\Alumno;
use App\Apoderado;
use App\Repositories\ApoderadoRepository;
use App\Repositories\PersonaRepository;
use App\Repositories\AlumnoRepository;

use Excel; 
use PDF;
use App\Helpers\Helper;

class Alumnocontroller extends Controller
{


    protected $alumno;
    protected $persona;
    protected $apoderado;

    private $estados=array("Estudiando","Egresado","Suspendido","Retirado");


    public function __construct(AlumnoRepository $alumno,PersonaRepository $persona,ApoderadoRepository $apoderado)
    {
        $this->alumno = $alumno;
        $this->persona=$persona;
        $this->apoderado=$apoderado; 
        $this->helper=New Helper;
        $this->middleware(['role:Director']);
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('director.alumno.index');
    }


    public function getAll()
    {

        $alumnos = Alumno::with('persona')->get();

        $output = array('data' => array());
        foreach ($alumnos as $alumno ) {
            $datosalumno=$alumno->persona;
            $actionButton = '
             <div class=" action-buttons">
                    <a class="blue"  href="'.route("Director.Alumno.Show",["id"=>$datosalumno->nrodocumento]).'" >
                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                    </a>

                    <a class="green" href="'.route("Director.Alumno.Edit",["id"=>$datosalumno->nrodocumento]).'" >
                    <i class="ace-icon fa fa-pen bigger-130"></i>
                    </a>

                    <a class="red" data-target="#modal-destroy" href="" data-toggle="modal"  onclick="destroy('."'".route('Director.Alumno.Destroy',['id'=>$datosalumno->nrodocumento])."'".')">
                    <i class="ace-icon fa fa-trash bigger-130"></i>
                    </a>

            </div>';

            $output['data'][] = array(

                $datosalumno['nrodocumento'] ,           
                $datosalumno['nombres'],
                $datosalumno['apellidos'],
                $datosalumno->direccion,
                '<ul class="ace-thumbnails clearfix center" onclick="colorboxthis();">
                <a href="'.url(Storage::url('sistem/photos/'.$datosalumno['foto'])).'" data-rel="colorbox">
                <img height="38" id="photoss" width="40" class="thumbnail inline no-margin-bottom " src="'.url(Storage::url('sistem/photos/'.$datosalumno['foto'])).'">
                </a>
                </ul>',
                $this->alumno->estadoacademico($alumno->estadoacademico),
                $actionButton

            );
        }

        return response()->json($output);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       return view('director.alumno.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->persona->save($request);
       return $this->alumno->save($request);        

    }

       public function store2(Request $request)
    {
       
       return $this->alumno->save2($request);     
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $Persona=Persona::findOrFail($id);
$alumno=Alumno::findOrFail($id);

       return view('director.alumno.show',['Persona'=>$Persona,'Alumno'=>$alumno]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

       return view('director.alumno.edit',['Persona'=>$this->persona->find($id),'alumno'=>$this->alumno->find($id),"estados"=>$this->estados]);
         
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
       $this->persona->update($request,$id);
      $this->alumno->update($request,$id);
         
        return response()->json(['messages' =>'Registro actualizado correctamente','success'=>true  ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->alumno->destroy($id);       
    }
 
 public function SearchLive(Request $request)
{
   


        $tags = Alumno::where('nrodocumento','like','%'.$request->q."%")->where('estadoacademico','Estudiando')->limit(5)->get();

        $formatted_tags = [];

        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->persona->nrodocumento, 'text' => $tag->persona->nombres .' '.$tag->persona->apellidos,'img'=>$tag->persona->foto];
        }

        $arrayName = array('data' => $formatted_tags,'pagination' =>array("more"=> 'true') );

        return response()->json($arrayName);
    
    
}



}
