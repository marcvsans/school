<?php
namespace App\Http\Controllers\Director;
 
use App\Http\Controllers\Controller;


use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Seccion;
use App\Alumno;
use App\Deuda; 
use App\Descuento;
use App\Pago;
use App\Matricula;
use App\AnioAcademico;


use App\Repositories\SeccionRepository;
use App\Repositories\AlumnoRepository;
use App\Repositories\MatriculaRepository;
use App\Repositories\GradoRepository;


class DeudaController extends Controller
{   

        protected $seccion;
  
    protected $grado;



    public function __construct(SeccionRepository $seccion,GradoRepository $grado)
    {
        
    
        $this->seccion=$seccion;
 
        $this->grado=$grado;
       
    }
    public function getAll()
    {

 



      $deudas = Deuda::with(['pagoInfo','alumnoInfo'])->get();
         $output = array('data' => array());
       foreach ($deudas as $deuda ) {

  switch ($deuda->estado) {
      case 'Pendiente':
  $estado='<span class="label label-danger arrowed-in">Pendiente</span>';
          break;
      
      default:
     $estado='<span class="label label-sucess arrowed-in">Pagado</span>';
          break;
  }

               $actionButton = '<div class=" action-buttons">
                    <a class="blue" data-target="#modal-wizarddetalles" href="" data-toggle="modal" >
                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                    </a>


                    <a class="red"  data-target="#modal-destroy" href="" data-toggle="modal" onclick="destroy2('."'".route('Director.Deuda.Destroy',['id'=>$deuda->id])."'".')">
                    <i class="ace-icon fa fa-trash bigger-130"></i>
                    </a>
                    </div>
        ';



    $output['data'][] = array(
    $deuda->alumnoInfo->nrodocumento,
     $deuda->alumnoInfo->persona->apellidos ." ".  $deuda->alumnoInfo->persona->nombres ,
    $deuda->pagoInfo->descripcion ,
    "S/.".$deuda->pagoInfo->cantidad,
   " S/. ".$deuda->pagoInfo->mora_dia,
    $deuda->pagoInfo->fechavencimiento->format('y-m-d'),
    $deuda->pagoInfo->anio,
    $estado,
    $actionButton  
      
    );
       }


      return response()->json($output);
    }

    public function getAlumno()
    {

 



      $alumnos = Alumno::with('persona')->get();
         $output = array('data' => array());
       foreach ($alumnos as $alumno ) {




 

    $output['data'][] = array(
        '   <th class="center">
                                                     
                                                        <div class="form-group">
                           

                            <div class="col-xs-12 col-sm-6">
                             <label class="position-relative">
                                                            <input type="checkbox" class="ace alum" value="'.$alumno->persona->nrodocumento.'"  name="alumno[]" />
                                                            <span class="lbl"></span>
                                                        </label>
                            </div>
                            <span class="block input-icon input-icon-right">
                            </span> 
                            </div>
                                                    </th>',
     $alumno->persona->nrodocumento,
    $alumno->persona->apellidos ." " . $alumno->persona->nombres,
   
    $alumno->estadoacademico
      
    );
       }


      return response()->json($output);
    }

        public function getSeccion()
    {


$anios=AnioAcademico::with(['secciones.datosGrado','datosPlanAcademico'])->where('estado','Activo')->get();
 $output = array('data' => array());
foreach ($anios as $anio) {


       
        foreach ($anio->secciones as $seccion ) { 
 
  

 

 

    $output['data'][] = array(
'                                  
                                                         
                                                        <div class="form-group">
                            

                            <div class="col-xs-12 col-sm-6">
                                <label class="position-relative">
                                                            <input type="checkbox" class="ace alum" value="'.$seccion->id.'"  name="seccion[]" />
                                                            <span class="lbl"></span>
                                                        </label>
                            </div>
                            <span class="block input-icon input-icon-right">
                            </span> 
                            </div>

                          
                     
                        
                           ',
  $this->grado->nivel($seccion->datosGrado->nivel) ,           
        $this->grado->labelName($seccion->datosGrado->numero),
        $this->seccion->letra($seccion->letra) ,    
        $anio->anio,  
    );
       }
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
       
        return view('director.pago.deuda',['pagos'=>Pago::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
               
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Deuda::create($request->all());


        if (!empty($request->alumno)) {
           $alumnos=$request->alumno;

    foreach($alumnos as $alumno)
    {
        $valid=deuda::where(['pago'=>$request->pago,'alumno'=>$alumno])->count();
        if ($valid == 0 ) {
                 Deuda::Create(
   [ 'pago'=>$request->pago,
     
     "alumno"=>$alumno,
    "estado"=>"Pendiente"

   ]
   
);
        }


        
    
    }
        }else{
             return response()->json(['messages' =>'No se  ha  seleccionado  ningun alumno','success'=>false],422);
        }





    return response()->json(['messages' =>'Registro agregado correctamente','success'=>true]);
        // return response()->json(['messages' =>'Registro agregado correctamente','success'=>true  ]);       

    }

    public function store2(Request $request)
    {


        foreach ($request->seccion as $seccion) {
         $alumnos=Seccion::find($seccion)->Alumnos;

         foreach ($alumnos as $alumno) {

                    $valid=deuda::where(['pago'=>$request->pago,'alumno'=>$alumno->alumno])->count();
        if ($valid == 0 ) {
                 Deuda::Create(
   [ 'pago'=>$request->pago,
     
     "alumno"=>$alumno->alumno,
    "estado"=>"Pendiente"

   ]
   
);
        }
                  
         }

        }
      

     //  $alumnos=$seccion['Alumnos'];

       return response()->json(['messages' =>'Registro agregado correctamente','success'=>$seccion]);
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


 
    public function alumnoDeudas(Request $request)
    {



        $deudas=Alumno::find($request->alumno)->deudas->where("estado","Pendiente");

         

            $option="<option></option>";
            foreach ($deudas as $deuda) {
           
                 
              
                $option.= '<option value='.$deuda->id.' > '.$deuda->pagoInfo->descripcion.'</option>'; 
            }
            $deudas= ' <select name="deuda" class="select2" id="deuda" data-placeholder="Deuda" >'.$option.'</select>  ';

        return response()->json(['deudas'=>$deudas]);

    }


  


    public function edit($id)
    {
        $Curso=deuda::findOrFail($id);
        $ruta=route("deuda.update",["id"=>$Curso["id"]]);

        return response()->json(["datos"=>$Curso,"ruta"=>$ruta]);
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
        $Seccion=deuda::findOrFail($id);
         $Seccion->update($request->all());
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
        
      try {
        deuda::find($id)->delete();
          return response()->json(['messages' =>'Registro eliminado correctamente','success'=>true  ]);
      } catch (\Exception $e) {
        return response()->json(['messages' =>'No se puede  eliminar el registro'],422);
      }
    }
}
