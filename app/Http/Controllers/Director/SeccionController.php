<?php
namespace App\Http\Controllers\Director;
 
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Response;


use App\Seccion; 

use App\Repositories\GradoRepository;
use App\Repositories\AnioAcademicoRepository;
use App\Repositories\SeccionRepository;



class SeccionController extends Controller 
{


    protected $seccion;
    protected $grados;
    protected $AnioAcademico;

    private $letras = array("A","B","C","D","E" );
    private $niveles=array("Primaria","Secundaria");

    public function __construct(SeccionRepository $seccion,GradoRepository $grados,AnioAcademicoRepository $AnioAcademico)
    {
        $this->grados=$grados;
        $this->seccion=$seccion;
        $this->AnioAcademico=$AnioAcademico;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('director.seccion.index',['letras'=>$this->letras,'anios'=>$this->AnioAcademico->findwhere(['estado'=>'Activo'])->get(),'grado_repo'=>$this->grados]);
    }



        public function Retrieve()
    {
        $secciones =  Seccion::with(['Alumnos','datosGrado','datosAnio'])->orderBy('letra')->get();
       
        $output = array('data' => array());
        foreach ($secciones->sortByDesc('datosAnio.anio')->sortBy('letra')->sortBy('datosGrado.numero') as $seccion ) {
        $actionButton = '<div class=" action-buttons">
        <a class="blue"  href="'.route("Director.Seccion.Show",["id"=>$seccion->id]).'">
        <i class="ace-icon fa fa-search-plus bigger-130"></i>
        </a>

        <a class="green" data-target="#modal-update" href="#" data-toggle="modal"  onclick="editseccion('."'".route("Director.Seccion.Edit",["id"=>$seccion->id])."'".')">
        <i class="ace-icon fa fa-pen bigger-130"></i>
        </a>

        <a class="red" data-target="#modal-destroy" href="#" data-toggle="modal" onclick="destroy('."'".route('Director.Seccion.Destroy',['id'=>$seccion->id])."'".')" >
        <i class="ace-icon fa fa-trash bigger-130"></i>
        </a>
        </div>
        ';


        $output['data'][] = array(

        $this->grados->nivel($seccion->datosGrado->nivel) ,           
        $this->grados->labelName($seccion->datosGrado->numero),
       $this->seccion->letra($seccion->letra)  ,           
        $seccion['capacidad'],        
        $seccion->datosAnio->descripcion . ' - ' . $seccion->datosAnio->anio,  
     $seccion->capacidad-$seccion->Alumnos->count(),
        $actionButton  

        );
        }


        return response()->json($output);
    }

public function create(Request $request)
{
       if ($request->ajax()) {
            $anio= $this->AnioAcademico->find($request->anio_acad);
        
            $select="<option value=''></option>";
            foreach ($anio->datosPlanAcademico->grados as $grado) {
               
                    $select .= '<option value="'.$grado->datosGrado->id.'" id="grad2" > '.$this->grados->onlyName($grado->datosGrado->numero).'</option>'; 
                
        
            }
            $select= ' <select name="grado" class="select2" data-placeholder="Grado" >'.$select.'</select>  ';  

            return response()->json(['grados'=>$select]);
        }else{
        abort(404);
        }
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          
         return $this->seccion->save($request);     
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         return view('director.seccion.show',['Seccion'=>$this->seccion->find($id)]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        if ($request->ajax()) {
            $seccion= $this->seccion->find($id);
        
            $letraseccion="";
            foreach ($this->letras as $letra) {
                $selected="";
                if ($letra==$seccion['letra']) {
                    $selected = '<option value='.$seccion['letra'].' selected=""> '.$seccion['letra'].'</option>';
                } else {
                    $selected = '<option value='.$letra.' > '.$letra.'</option>'; 
                }
                $letraseccion.=$selected;
            }
            $letraseccion= ' <select name="letra" class="select2" data-placeholder="Letra" >'.$letraseccion.'</select>  ';  
  

            $ruta=route("Director.Seccion.Update",["id"=>$seccion->id]);


            return response()->json(['letra'=>$letraseccion,'capacidad'=>$seccion['capacidad'],'anio'=>$seccion->anio,'ruta'=>$ruta]);
        }else{
        abort(404);
        }
 
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
         return $this->seccion->update($request,$id);
                
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->seccion->destroy($id);    
    }
}
