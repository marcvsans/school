<?php

namespace App\Http\Controllers\Director;
 
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Response;

use App\Seccion;
use App\SeccionDocenteCurso;
use App\PlanAcademicoGrado;
use App\AnioAcademico;
use App\Docente;

use App\Repositories\SeccionRepository;
use App\Repositories\CursoRepository;
use App\Repositories\GradoRepository;

use App\Repositories\DocenteRepository;



class SeccionDocenteCursoController extends Controller
{

     

    protected $seccion;
    protected $curso;
    protected $docente;
    protected $grado;



    public function __construct(DocenteRepository $docente,SeccionRepository $seccion,CursoRepository $curso,GradoRepository $grado)
    {
        
        $this->docente=$docente;
        $this->seccion=$seccion;
        $this->curso=$curso;
        $this->grado=$grado;
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('director.seccion.docentecurso'); 
    }



        public function getAll()
    {

$anios=AnioAcademico::with(['secciones.datosGrado','datosPlanAcademico'])->where('estado','Activo')->get();
 $output = array('data' => array());
foreach ($anios as $anio) {


       
        foreach ($anio->secciones as $seccion ) { 

        $grad=PlanAcademicoGrado::Where(['grado'=>$seccion->datosGrado->id,'plan'=>$anio->datosPlanAcademico->id])->first();
        
        if ($grad) {
           $countcursos=$grad->cursos->count();

            $count=SeccionDocenteCurso::Where(["seccion"=>$seccion->id,["docente","<>","null"]])->count();
           $labelcount='';
            if ($count==0) {
                $labelcount='<span class="label label-danger ">Sin asignar</span>';
            } elseif($count== $countcursos) {
                $labelcount='<span class="label label-success "> Asignado</span>';
            }
            else{
              $labelcount='<span class="label label-warning">
                                                <i class="ace-icon fa fa-exclamation-triangle bigger-120"></i>
                                                '.$count.' Asignados
                                            </span>';
            }
  


        $output['data'][] = array(

        $this->grado->nivel($seccion->datosGrado->nivel) ,           
        $this->grado->labelName($seccion->datosGrado->numero),
        $this->seccion->letra($seccion->letra) ,    
        $anio->anio,   
       '<button class="btn btn-success" data-target="#modal-create" data-toggle="modal" onclick="createcursodocente('."'".route('Director.SeccionDocenteCurso.Create',['id'=>$seccion])."'".')"   >Asignar</button>',        
          
        $labelcount 

        );
        }
        

        }
}

        return response()->json($output);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
               
        if ($request->ajax()) {

            $idseccion=$request->id;
             $seccion= $this->seccion->find($idseccion);

                $cursos=PlanAcademicoGrado::Where(['grado'=>$seccion->datosGrado->id,'plan'=>$seccion->datosAnio->datosPlanAcademico->id])->first()->cursos; 
                
                     $docentes=Docente::where(["nivel"=>$seccion->datosGrado->nivel,'estado'=>'Activo'])->get();

            $count= SeccionDocenteCurso::Where('seccion',$idseccion)->count();
            if ($count == 0) {
               
           

                $option='';
                foreach ($docentes as $docente) {
                    $option.='<option value="'.$docente->nrodocumento .'" >'.$docente->persona->nombres.' '.$docente->persona->apellidos  .' </option>';
                }


                $form='<input type="text" name="seccion" value="'.$seccion->id.'" hidden="" >';

                foreach ($cursos as $curso) {
                    $form.=  '<div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">'.$curso->datosCurso->nombre.'</label>

                    <div class="col-xs-12 col-sm-6">

                    <select  name="docente[]"  class="select2" data-placeholder="Docente"  >
                    <option value=""></option> '             
                    .$option. 
                    '</select>

                    <input type="text" name="curso[]" value="'.$curso->id.'" hidden="" >
                    </div>
                    <span class="block input-icon input-icon-right">
                    </span> 
                    </div>';

                }


               


                return response()->json(['curso'=>$form]);

            } else {



                $form='<input type="text" name="seccion" value="'.$seccion->id.'" hidden="" >';

                foreach ($cursos as $curso) {

                    $count2=SeccionDocenteCurso::Where(['curso'=>$curso->id,"seccion"=>$seccion->id])->count();

                    if ($count2 ==1 ) {

                    $option='';
                    foreach ($docentes as $docente) {

                    $count3=SeccionDocenteCurso::Where(['curso'=>$curso->id,"seccion"=>$seccion->id,"docente"=>$docente->nrodocumento])->count();
                    if ($count3 == 1) {
                        $docCurso=SeccionDocenteCurso::Where(['curso'=>$curso->id,"seccion"=>$seccion->id,"docente"=>$docente->nrodocumento]);
                 
                        $option.='<option value="'.$docente->nrodocumento .'" selected="" >'.$docente->persona->nombres.' '.$docente->persona->apellidos  .' </option>';
                 

                   }else{
                       $option.='<option value="'.$docente->nrodocumento .'"  >'.$docente->persona->nombres.' '.$docente->persona->apellidos  .' </option>';
                   }


                    }

                    $form.=  '<div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">'.$curso->datosCurso->nombre.'</label>

                    <div class="col-xs-12 col-sm-6">

                    <select  name="docente[]"  class="select2" data-placeholder="Docente"  >
                    <option value=""></option> '             
                    .$option. 
                    '</select>

                    <input type="text" name="curso[]" value="'.$curso->id.'" hidden="" >
                    </div>
                    <span class="block input-icon input-icon-right">
                    </span> 
                    </div>';







                    } else {

                        $option='';
                        foreach ($docentes as $docente) {
                            $option.='<option value="'.$docente->nrodocumento .'" >'.$docente->persona->nombres.' '.$docente->persona->apellidos  .' </option>';
                        }
                        $form.=  '<div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">'.$curso->datosCurso->nombre.'</label>

                        <div class="col-xs-12 col-sm-6">

                        <select  name="docente[]"  class="select2" data-placeholder="Docente"  >
                        <option value=""></option> '             
                        .$option. 
                        '</select>

                        <input type="text" name="curso[]" value="'.$curso->id.'" hidden="" >
                        </div>
                        <span class="block input-icon input-icon-right">
                        </span> 
                        </div>';

                    }

                }


               


                return response()->json(['curso'=>$form]);

            
            }


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
    $docentes=$request->docente;

  
    $i=0;
    foreach($request->get('curso') as $curso)
    {

        SeccionDocenteCurso::updateOrCreate(
   [ 'curso'=>$curso,
     
     "seccion"=>$request->seccion
    
   ],
   ["docente"=>$docentes[$i]]
);
        
        $i++;
    }

    return response()->json(['messages' =>'Registro agregado correctamente','success'=>true]);

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
        //
    }
}
