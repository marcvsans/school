<?php
namespace App\Http\Controllers\Director;
 
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Response;


use App\Seccion; 
use App\SeccionDocenteCurso; 
use App\Notas; 
use App\Trimestre;

use App\PlanAcademicoGradoCurso;

use App\Repositories\SeccionRepository;
use App\Repositories\GradoRepository;

class NotasController extends Controller
{

    protected $seccion;
    protected $grados;
  


    public function __construct(SeccionRepository $seccion,GradoRepository $grados)
    {
        $this->seccion = $seccion;
        $this->grados=$grados;
    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function index()
    {
        return view('director.notas.index');
    }



        public function Retrieve()
    {
        $secciones =  Seccion::with('Alumnos','datosGrado','datosAnio')->get();
      $output = array('data' => array());
        foreach ($secciones->sortByDesc('datosAnio.anio')->sortBy('letra')->sortBy('datosGrado.numero') as $seccion ) {

        $output['data'][] = array(
  $this->grados->nivel($seccion->datosGrado->nivel) ,           
        $this->grados->labelName($seccion->datosGrado->numero),
       $this->seccion->letra($seccion->letra)  ,           
           
        $seccion->datosAnio->descripcion . ' - ' . $seccion->datosAnio->anio,  
           
       '<a class="btn btn-success" href="'.route('Director.Notas.Create',['seccion'=>$seccion->id]).'"   >Asignar</a>'
       
        );
        }


        return response()->json($output);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$seccion)
    {
              
 
        return view('Director.notas.edit',['seccion'=>Seccion::find($seccion)]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           

  $seccion=Seccion::find($request->id);

        $curso=SeccionDocenteCurso::find($request->curso);
   
        $criterios=$curso->cursoInfo->criterios;
        
        $trimestres=$seccion->datosAnio->trimestres;


$matriculas=$seccion->Alumnos;
foreach ($matriculas as $matricula) {


           foreach ($trimestres as $trimestre) {
              
   
                            
  foreach ($criterios as $criterio) {



       $name=$trimestre->id."-".$criterio->id."-".$curso->id."-".$matricula->alumno ;


Notas::updateOrCreate(["alumno"=>$matricula->alumno,"criterio"=>$criterio->id,"trimestre"=>$trimestre->id,"curso"=>$curso->id],
["nota"=>$request->$name]);
             
               }

              }

           

}
           

  
        
        
          return response()->json(['messages' =>'Registro actualizado correctamente','success'=>true]);
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
    public function edit(Request $request,$id)
    {
        $seccion=Seccion::find($id);

        $curso=SeccionDocenteCurso::find($request->curso);
   
        $criterios=$curso->cursoInfo->criterios;
        
        $trimestres=$seccion->datosAnio->trimestres;

        $thead='';
        $thead2="";

        foreach ($trimestres as $trimestre) {
            $thead.='<th class="center" colspan="'.(count($criterios)+1).'" >'.$trimestre->numero.'</th>' ;

            foreach ($criterios as $criterio) {
                $thead2.='<th  >'.$criterio->datoscriterio->nombre.'</th>' ;
            }

            $thead2.="<th class='white ' style='background-color:#748c98;'>Prom.</th>";
        }

        $body="";
        $matriculas=$seccion->Alumnos;
        foreach ($matriculas as $matricula) {
            $bodyalumno="<th class='align-left lighter'>".$matricula->datosalumno->persona->apellidos." ".$matricula->datosalumno->persona->nombres."</th>";
           
            $thnota='' ;
            $notafinal=0;
            foreach ($trimestres as $trimestre) {

                $notas=0;                
                foreach ($criterios as $criterio) {

                    $existsnota=Notas::where(["alumno"=>$matricula->alumno,"criterio"=>$criterio->id,"trimestre"=>$trimestre->id,"curso"=>$curso->id])->first();
                    if ($existsnota) {
                        $class=$this->color($existsnota->nota);
                

                        $notas=$notas+$existsnota->nota;

                        $thnota.='<th class="center">
                        <input type="number" class="input-mini center lighter '.$class.'"  name="'.$trimestre->id."-".$criterio->id."-".$curso->id."-".$matricula->alumno.'" value="'.$existsnota->nota.'"></th>' ;
                    }
                    else{
                        $thnota.='<th class="center">
                        <input type="number" class="input-mini center lighter"  name="'.$trimestre->id."-".$criterio->id."-".$curso->id."-".$matricula->alumno.'" value="00"></th>' ;

                    }


                }

                if ($criterios && $notas != 0) {
                   $notatrimestre=round($notas/count($criterios),0,PHP_ROUND_HALF_UP);
                 $notafinal=$notafinal + $notatrimestre;
                 $class=$this->color($notatrimestre);
                $thnota.="<th class='center ".$class."' style='background-color:#99b8c7;'>".$notatrimestre."</th>";
                } else {
                     $thnota.="<th class='center red' style='background-color:#99b8c7;'>00</th>";
                }
                
                
            }
            if ($trimestres && $criterios) {
                if (count($trimestres)>0) {
                      $nfinal=round($notafinal/count($trimestres),0,PHP_ROUND_HALF_UP);
            $class=$this->color($nfinal);
            $body.="<tr>".$bodyalumno.$thnota."<th class='center ".$class."' style='background-color:#cecaa5;'>".$nfinal."</th></tr>";  # code...
                }
            
            } else {
              $body.="<tr>".$bodyalumno.$thnota."<th class='center ".$class."' style='background-color:#cecaa5;'>".$nfinal."</th></tr>";
            }
            
           

        }


        $thead="<tr class='blue'>".$thead."</tr>";
        $thead2="<tr class='blue'>".$thead2."</tr>";  


        $table='<thead ><tr class="blue" ><th rowspan="3" class="blue">Apellidos y Nombres</th><th colspan="'.(count($trimestres)*(count($criterios)+1)).'" class="center">Trimestres</th><th rowspan="3" class="white" style="background-color:#748c98;">Prom. final</th></tr>' .$thead.$thead2.'
         </thead>

 <tbody  >'.$body.'


        </tbody>
        '        ;  


        return response()->json(["table"=>$table]);
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
      
    }



    public function color($nota)
    {
         $class="";
        if ($nota >=0 && $nota <= 10) {$class="red";}
                        if ($nota >=11 && $nota <= 12) {$class="orange";}
                        if ($nota >=13 && $nota <= 16) {$class="blue";}
                        if ($nota >=17 && $nota <= 20) {$class="green";}

                        return $class;
    }
}
