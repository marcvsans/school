<?php

namespace App\Http\Controllers\director;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\AnioAcademico; 
use App\Repositories\AnioAcademicoRepository;
use App\Repositories\PlanAcademicoRepository;
use App\Repositories\HorarioConfigRepository;


class AnioAcademicoController extends Controller
{

    protected $AnioAcademico;
    protected $PlanAcademico;
protected $HorarioConfig;

    private $niveles=array("Primaria","Secundaria");

    public function __construct(AnioAcademicoRepository $AnioAcademico,PlanAcademicoRepository $PlanAcademico,HorarioConfigRepository $HorarioConfig)
    {
        $this->AnioAcademico = $AnioAcademico;
        $this->PlanAcademico= $PlanAcademico;
        $this->HorarioConfig=$HorarioConfig;
       
    } 


    public function getAll()
    {
          $AnioAcademicos = AnioAcademico::with('datosPlanAcademico','datosHorarioConfig')->get();

        $output = array('data' => array());
        foreach ($AnioAcademicos as $AnioAcademico) {
        $actionButton = '<div class=" action-buttons">

        <a class="red" data-target="#modal-destroy" href="#" data-toggle="modal" onclick="destroy('."'".route('Director.AnioAcademico.Destroy',['id'=>$AnioAcademico])."'".')" >
        <i class="ace-icon fa fa-trash bigger-130"></i>
        </a>
        </div>
        ';

        switch ($AnioAcademico->nivel) {
        case 'Primaria':
        $nivel='<span class="label label-lg  ">Primaria</span>';
        break;
        case 'Secundaria':
        $nivel='<span class="label label-lg label-info  ">Secundaria</span>';
        break;
        default:
        $nivel='<span class="label label-lg label-inverse  arrowed">E</span>';
        break;
        }

        $output['data'][] = array(
            $AnioAcademico->descripcion,      
            $nivel , 
            $AnioAcademico->anio,
           $AnioAcademico->datosPlanAcademico->nombre,
$AnioAcademico->datosHorarioConfig->nombre .' ( '.$AnioAcademico->datosHorarioConfig->horainicio .' - '.$AnioAcademico->datosHorarioConfig->horafin.' )' ,
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
        

            return view('director.anio-academico.index',['niveles'=>$this->niveles,'planes'=>$this->PlanAcademico->findWhere(['estado'=>'Activo'])]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
       if ($request->ajax()) {
            $planes= $this->PlanAcademico->findWhere(['nivel'=>$request->nivel,'estado'=>'Activo']);
            $conf_horarios=$this->HorarioConfig->findWhere(['nivel'=>$request->nivel]);

            $conf_h="<option value=''></option>";
            foreach ($conf_horarios as $horario) {
               
                    $conf_h .= '<option value="'.$horario->id.'"  > '.$horario->nombre.' ( '.date("H:i:s",strtotime($horario->horainicio)).' - '.$horario->horafin.' )</option>'; 
                
        
            }
            $conf_h= ' <select name="conf_horario" class="select2" data-placeholder="Seleccione" >'.$conf_h.'</select>  ';  


        
            $select="<option value=''></option>";
            foreach ($planes as $plan) {
               
                    $select .= '<option value="'.$plan->id.'"  > '.$plan->nombre.'</option>'; 
                
        
            }
            $select= ' <select name="planacad" class="select2" data-placeholder="Seleccione" >'.$select.'</select>  ';  

            return response()->json(['planes'=>$select,'confs'=>$conf_h]);
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
         return $this->AnioAcademico->save($request);  
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       return $this->AnioAcademico->destroy($id);
    }

    public function activar()
    {
         return view('director.anio-academico.activar',['niveles'=>$this->niveles,'anios'=>$this->AnioAcademico->all()]);
    }

    public function updateEstado(Request $request)
    {
       $Anios=$this->AnioAcademico->findwhere(['nivel'=>$request->nivel])->update(['estado'=>'Inactivo']);
       $Anio=$this->AnioAcademico->find($request->anio);
       $Anio->update(['estado'=>'Activo']);
       return response()->json(['messages' =>'Registro actualizado correctamente']);
    }
}
