<?php

namespace App\Http\Controllers\Director;
 
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;


use App\CriterioEvaluacion; 
use App\Repositories\CriterioEvaluacionRepository;


class CriterioEvaluacionController extends Controller
{   


    protected $CriterioEvaluacion;
  
    public function __construct(CriterioEvaluacionRepository $CriterioEvaluacion)
    {
        $this->CriterioEvaluacion = $CriterioEvaluacion;
          
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('director.criterio.index');
    }


 public function getAll()
    {
          $cursos =CriterioEvaluacion::all();
        $output = array('data' => array());
        foreach ($cursos as $curso ) {
        $actionButton = '<div class=" action-buttons">
     
        <a class="green" data-target="#modal-update" href="#" data-toggle="modal"  onclick="editcriterio('."'".route("Director.CriterioEvaluacion.Edit",["id"=>$curso->id])."'".')">
        <i class="ace-icon fa fa-pen bigger-130"></i>
        </a>

        <a class="red" data-target="#modal-destroy" href="#" data-toggle="modal" onclick="destroy('."'".route('Director.CriterioEvaluacion.Destroy',['id'=>$curso->id])."'".')" >
        <i class="ace-icon fa fa-trash bigger-130"></i>
        </a>
        </div>
        ';


        $output['data'][] = array(

                 
             $curso['nombre'],      
        $curso['descripcion'],        
        $this->CriterioEvaluacion->Estado($curso->estado),
        $actionButton  

        );
        }


        return response()->json($output);
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      return $this->CriterioEvaluacion->save($request);  
       
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
            $CriterioEvaluacion=CriterioEvaluacion::find($id);     
           
$selected='';
$option='<option value=""></option> ';
            foreach ($CriterioEvaluacion->estados as $estado) {
                if ($estado == $CriterioEvaluacion->estado) {
                 
                   $option.= '<option value="'.$estado.'" selected="" >'.$estado.'</option>';
                }
                else{
 $option.= '<option value="'.$estado.'" >'.$estado.'</option>';
                }
               

            }

       $select= '
                <select class="select2  col-xs-8 col-sm-4"   data-placeholder="Seleccione" name="estado">
                 '.$option.'
                </select>';

$CriterioEvaluacion['select']=$select;
 $CriterioEvaluacion['ruta']=route("Director.CriterioEvaluacion.Update",["id"=>$CriterioEvaluacion]);

            return response()->json(['CriterioEvaluacion'=>$CriterioEvaluacion]);
        
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
return $this->CriterioEvaluacion->update($request,$id);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     return $this->CriterioEvaluacion->destroy($id);

    }
}
