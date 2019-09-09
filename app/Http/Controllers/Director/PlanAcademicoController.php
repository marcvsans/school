<?php

namespace App\Http\Controllers\director;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PlanAcademico; 

use App\Repositories\PlanAcademicoRepository;
use App\Repositories\GradoRepository;
use App\Repositories\CursoRepository;
use App\Repositories\CriterioEvaluacionRepository;

use App\Repositories\PlanAcademicoGradoRepository;
use App\Repositories\PlanAcademicoGradoCursoRepository;

class PlanAcademicoController extends Controller
{
    protected $PlanAcademico;
    protected $PlanAcademicoGrado;
    protected $PlanAcademicoGradoCurso;
    protected $grado;
    protected $curso;
    protected $criterio;

    private $niveles=array("Primaria","Secundaria");

    public function __construct(PlanAcademicoRepository $PlanAcademico,GradoRepository $grado,PlanAcademicoGradoRepository $PlanAcademicoGrado , CursoRepository $curso, PlanAcademicoGradoCursoRepository $PlanAcademicoGradoCurso,CriterioEvaluacionRepository $criterio)
    {
        $this->PlanAcademico = $PlanAcademico;
        $this->PlanAcademicoGrado=$PlanAcademicoGrado;
        $this->PlanAcademicoGradoCurso=$PlanAcademicoGradoCurso;
        $this->grado=$grado;
        $this->curso=$curso;
        $this->criterio=$criterio;

       
    } 


     public function getAll()
    {
          $PlanAcademicos = $this->PlanAcademico->all();
        $output = array('data' => array());
        foreach ($PlanAcademicos as $PlanAcademico ) {
        $actionButton = '<div class=" action-buttons">
     <a class="blue"  href="'.route("Director.PlanAcademico.Show",["id"=>$PlanAcademico]).'" >
                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                    </a>
        <a class="green" data-target="#modal-update" href="#" data-toggle="modal"  onclick="edit('."'".route("Director.PlanAcademico.Edit",["id"=>$PlanAcademico])."'".')">
        <i class="ace-icon fa fa-pen bigger-130"></i>
        </a>

        <a class="red" data-target="#modal-destroy" href="#" data-toggle="modal" onclick="destroy('."'".route('Director.PlanAcademico.Destroy',['id'=>$PlanAcademico])."'".')" >
        <i class="ace-icon fa fa-trash bigger-130"></i>
        </a>

        </div>
        ';
        $asignarButton='
                                                <a class="btn btn-sm btn-yellow" href="'.route('Director.PlanAcademico.Grado',['plan'=>$PlanAcademico]).'">Grado</a>
 
                                           ';



        $output['data'][] = array(
            $PlanAcademico->nombre,      
            $this->PlanAcademico->nivel($PlanAcademico->nivel) , 
            $this->PlanAcademico->estado($PlanAcademico->estado),
            $asignarButton,
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
       
        return view('director.plan-academico.index',['niveles'=>$this->niveles]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->PlanAcademico->save($request);  
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('director.plan-academico.show',['plan'=>$this->PlanAcademico->find($id),'repo_grado'=>$this->grado]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $PlanAcademico= $this->PlanAcademico->find($id);
        
         

            $estadoPlanAcademico="";
            foreach ($PlanAcademico->estados as $estado) {
                   $selected="";
                if ($estado==$PlanAcademico->estado) {
                    $selected = '<option value='.$estado.' selected=""> '.$estado.'</option>';
                } else {
                    $selected = '<option value='.$estado.' > '.$estado.'</option>'; 
                }
                $estadoPlanAcademico.=$selected;
            }
            $estadoPlanAcademico= ' <select name="estado" class="select2" data-placeholder="Estado" >'.$estadoPlanAcademico.'</select>  ';  


            $ruta=route("Director.PlanAcademico.Update",["id"=>$PlanAcademico]);


            return response()->json(['nombre'=>$PlanAcademico->nombre,'ruta'=>$ruta,'estado'=>$estadoPlanAcademico]);
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
         return $this->PlanAcademico->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         return $this->PlanAcademico->destroy($id);
    }


    public function grado($plan)
    {
         $plan=$this->PlanAcademico->find($plan);
         return view('director.plan-academico.grado',['niveles'=>$this->niveles,'plan'=>$plan,'grados'=>$this->grado->findWhere(['estado'=>'Activo','nivel'=>$plan->nivel ])->sortBy('numero'),'repo_grado'=>$this->grado]);
    }


    public function gradoCurso($plan)
    {
         $plan=$this->PlanAcademicoGrado->find($plan);
         return view('director.plan-academico.grado-curso',['plan'=>$plan,'cursos'=>$this->curso->findWhere(['estado'=>'Activo','nivel'=>$plan->datosGrado->nivel])]);
    }

     public function gradoCursoCriterio($plan)
    {
         $plan=$this->PlanAcademicoGradoCurso->find($plan);
         return view('director.plan-academico.grado-curso-criterio',['plan'=>$plan,'criterios'=>$this->criterio->findWhere(['estado'=>'Activo'])]);
    }
}
