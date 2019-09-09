<?php

namespace App\Http\Controllers\director;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Repositories\CursoCriterioRepository;
use App\Repositories\PlanAcademicoGradoCursoRepository;

class CursoCriterioController extends Controller
{
   
    protected $PlanAcademicoGradoCurso;
  
    protected $CursoCriterio;

    

    public function __construct(CursoCriterioRepository $CursoCriterio,PlanAcademicoGradoCursoRepository $PlanAcademicoGradoCurso )
    {
        
        $this->PlanAcademicoGradoCurso=$PlanAcademicoGradoCurso;
        $this->CursoCriterio=$CursoCriterio;

       
    } 





        public function getAll($grado_curso)
    {

  $Cursos = $this->PlanAcademicoGradoCurso->find($grado_curso)->criterios()->with('datosCriterio')->get();


        $output = array('data' => array());
        foreach ($Cursos as $Curso ) {
            
        $actionButton = ' <div class=" action-buttons center">
     
      

        <a class="red" data-target="#modal-destroy" href="#" data-toggle="modal" onclick="destroy('."'".route('Director.CursoCriterio.Destroy',['id'=>$Curso])."'".')" >
        <i class="ace-icon fa fa-trash bigger-130"></i>
        </a>
        </div>
        ';




        $output['data'][] = array(

            $Curso->datosCriterio->nombre,      
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
        // 
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
        return $this->CursoCriterio->save($request);  
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
         return $this->CursoCriterio->destroy($id);
    }
}
