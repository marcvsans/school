<?php

namespace App\Http\Controllers\director;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PlanAcademicoGrado; 
use App\PlanAcademico; 
use App\Repositories\PlanAcademicoGradoRepository;
use App\Repositories\PlanAcademicoRepository;
use App\Repositories\GradoRepository;


class PlanAcademicoGradoController extends Controller
{

 protected $PlanAcademicoGrado;
 protected $PlanAcademico;
 protected $grado;

    private $niveles=array("Primaria","Secundaria");

    public function __construct(PlanAcademicoGradoRepository $PlanAcademicoGrado,PlanAcademicoRepository $PlanAcademico,GradoRepository $grado)
    {
        $this->PlanAcademicoGrado = $PlanAcademicoGrado;
        $this->PlanAcademico = $PlanAcademico;
        $this->grado=$grado;
    } 

    public function getAll($plan)
    {

  $Grados = $this->PlanAcademico->find($plan)->grados()->with('datosGrado')->get();
 

        $output = array('data' => array());
        foreach ($Grados as $Grado ) {
            
        $actionButton = '<div class=" action-buttons center">
     
      

        <a class="red" data-target="#modal-destroy" href="#" data-toggle="modal" onclick="destroy('."'".route('Director.PlanAcademicoGrado.Destroy',['id'=>$Grado])."'".')" >
        <i class="ace-icon fa fa-trash bigger-130"></i>
        </a>
        </div>
        ';


        $output['data'][] = array(

           $this->grado->labelName( $Grado->datosGrado->numero),      
           $this->grado->nivel($Grado->datosGrado->nivel) , 
            '<a class="btn btn-sm btn-yellow" href="'.route('Director.PlanAcademico.GradoCurso',['grado'=>$Grado]).'">Curso</a>',
            $actionButton  
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
        return $this->PlanAcademicoGrado->save($request);  
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
    public function destroy($id)
    {
         return $this->PlanAcademicoGrado->destroy($id);
    }
}
