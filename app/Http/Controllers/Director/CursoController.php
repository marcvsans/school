<?php
namespace App\Http\Controllers\Director;
 
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Curso; 

use App\Repositories\CursoRepository;

class CursoController extends Controller
{

    protected $curso;

    private $niveles=array("Primaria","Secundaria");

    public function __construct(CursoRepository $curso)
    {
        $this->curso = $curso;
       
    } 


    public function getAll()
    {
          $cursos = Curso::orderBy('nivel')->get();
        $output = array('data' => array());
        foreach ($cursos as $curso ) {
        $actionButton = '<div class=" action-buttons">
     
        <a class="green" data-target="#modal-update" href="#" data-toggle="modal"  onclick="editcurso('."'".route("Director.Curso.Edit",["id"=>$curso])."'".')">
        <i class="ace-icon fa fa-pen bigger-130"></i>
        </a>

        <a class="red" data-target="#modal-destroy" href="#" data-toggle="modal" onclick="destroy('."'".route('Director.Curso.Destroy',['id'=>$curso])."'".')" >
        <i class="ace-icon fa fa-trash bigger-130"></i>
        </a>
        </div>
        ';

        switch ($curso->nivel) {
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
            $curso->nombre,      
            $nivel , 
            $this->curso->estado($curso->estado),
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
        return view('director.curso.index',['niveles'=>$this->niveles]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       return $this->curso->save($request);      
       
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        
        
            $curso= $this->curso->find($id);
        
             

            $estadocurso="";
            foreach ($curso->estados as $estado) {
                   $selected="";
                if ($estado==$curso->estado) {
                    $selected = '<option value='.$estado.' selected=""> '.$estado.'</option>';
                } else {
                    $selected = '<option value='.$estado.' > '.$estado.'</option>'; 
                }
                $estadocurso.=$selected;
            }
            $estadocurso= ' <select name="estado" class="select2" data-placeholder="Estado" >'.$estadocurso.'</select>  ';  


            $ruta=route("Director.Curso.Update",["id"=>$curso]);


            return response()->json(['nombre'=>$curso->nombre,'ruta'=>$ruta,'estado'=>$estadocurso]);
        
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
         return $this->curso->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         return $this->curso->destroy($id);
    }

}