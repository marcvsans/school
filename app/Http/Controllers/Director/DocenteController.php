<?php
namespace App\Http\Controllers\Director;
 
use App\Http\Controllers\Controller;


use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Persona;

use App\Docente;
use App\Repositories\DocenteRepository;
use App\Repositories\PersonaRepository;

use PDF;
use Storage;

class DocenteController extends Controller
{


    protected $persona;
    protected $docente;
  private $niveles=array("Primaria","Secundaria");
   

    public function __construct(PersonaRepository $persona,DocenteRepository $docente)
    {
     
        $this->persona=$persona;
        $this->docente=$docente;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Director.Docente.index'); 
    }

  
    public function getAll()
    {

        $docentes = Docente::with('persona')->get();

        $output = array('data' => array());
        foreach ($docentes as $docente ) {
            $datosdocente=$docente->persona;
            $actionButton = '<div class=" action-buttons">
            <a class="blue"  href="'.route("Director.Docente.Show",["id"=>$datosdocente["nrodocumento"]]).'">
            <i class="ace-icon fa fa-search-plus bigger-130"></i>
            </a>

            <a class="green"  href="'.route("Director.Docente.Edit",["id"=>$datosdocente["nrodocumento"]]).'" onclick="editproduct('."'".$docente[0]."'".')">
            <i class="ace-icon fa fa-pen bigger-130"></i>
            </a>

            <a class="red" data-target="#modal-destroy" href="" data-toggle="modal" onclick="destroy('."'".route('Director.Docente.Destroy',['id'=>$datosdocente["nrodocumento"]])."'".')" >
            <i class="ace-icon fa fa-trash bigger-130"></i>
            </a>
            </div>
            ';


            $output['data'][] = array(

                $datosdocente['nrodocumento'] ,           
                $datosdocente['nombres'],
                $datosdocente['apellidos'],             
                '
                <ul class="ace-thumbnails clearfix" onclick="colorboxthis();">
                <a href="'.url(Storage::url('sistem/photos/'.$datosdocente['foto'])).'" data-rel="colorbox">
                <img height="50" id="photoss" width="50" class="thumbnail inline no-margin-bottom " src="'.url(Storage::url('sistem/photos/'.$datosdocente['foto'])).'">
                </a>
                </ul>',
                 $docente->nivel,
                $docente->especialidad ,
                 $this->persona->Estado($docente->estado),
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
          
       return view('Director.Docente.create',["niveles"=>$this->niveles]);
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
        return $this->docente->save($request);  
      

    }

       public function store2(Request $request)
    {
       
       return $this->docente->save2($request);     
    
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
$docente=Docente::findOrFail($id);

       return view('Director.Docente.show',['Persona'=>$Persona,'Docente'=>$docente]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

       return view('Director.Docente.edit',['Persona'=>$this->persona->find($id),'docente'=>$this->docente->find($id),"niveles"=>$this->niveles]);
         
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
      $this->docente->update($request,$id);
         
        return response()->json(['messages' =>'Docente Actualizado Correctamente','success'=>true  ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->docente->destroy($id);       
    }



}
