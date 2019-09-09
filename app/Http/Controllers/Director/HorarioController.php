<?php

namespace App\Http\Controllers\Director;
 
use App\Http\Controllers\Controller;



use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Response;

use App\Seccion;
use App\SeccionDocenteCurso;
use App\HorarioConfig;
use App\Horario;
use  App\HorasLibre;
 

use App\Repositories\GradoRepository;
use App\Repositories\SeccionRepository;
use App\Repositories\CursoRepository;
use App\Repositories\DocenteRepository;
use App\Repositories\HorarioConfigRepository;
use App\Repositories\HorasLibreRepository;
use App\Repositories\HorarioRepository;


use Carbon\Carbon;

class HorarioController extends Controller
{


     protected $grado;
  protected $horarioconfig;
    protected $docente;
    protected $curso;
    protected $seccion;
     protected $horaslibre;
     protected $Horario;

    private $grados = array(1,2,3,4,5,6);
    private $letras = array("A","B","C","D","E" );
    private $niveles=array("Primaria","Secundaria");
      private $dias=array("Lunes","Martes","Miercoles","Jueves","Viernes","Sabado","Domingo");

    public function __construct(GradoRepository $grado,DocenteRepository $docente,SeccionRepository $seccion,CursoRepository $curso,HorarioConfigRepository $horarioconfig,HorasLibreRepository $horaslibre,HorarioRepository $Horario)
    {
        $this->grado = $grado;
        $this->docente=$docente;
        $this->seccion=$seccion;
        $this->curso=$curso;
          $this->horarioconfig = $horarioconfig;
              $this->horaslibre=$horaslibre;
              $this->Horario=$Horario;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('director.horario.index',['grados'=>$this->grados,'letras'=>$this->letras,'niveles'=>$this->niveles]);
    }


        public function getAll()
    {

      
        $secciones = Seccion::with('datosGrado','datosAnio')->get();
        $output = array('data' => array());
        foreach ($secciones->sortBy('datosGrado.numero') as $seccion ) {

               
     

        $output['data'][] = array(
 $this->grado->nivel($seccion->datosGrado->nivel) , 
 $this->grado->labelName($seccion->datosGrado->numero),
       $this->seccion->letra($seccion->letra)  ,           
                
      '<a class="btn btn-success" href="'.route('Director.Horario.Create',['seccion'=>$seccion->id]).'"   >Asignar</a>',           
      $seccion->datosAnio->descripcion . ' - ' . $seccion->datosAnio->anio  
      

        );
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
$hlibre=new HorasLibre;

        $seccion= $this->seccion->find($request->seccion);
        

          $config =$seccion->datosAnio->datosHorarioConfig;
     
        $horarioinicio=Carbon::parse($config->horainicio);
        $horariofin=Carbon::parse($config->horafin);
        $duracion=$config->duracionclase;

        $finalizar=0;

        $horaActual =$horarioinicio;
        $array=array( );
      
        while ( $finalizar  == 0 ) {
            if ($horaActual <= $horariofin) {
                array_push($array, date ('h:i a',strtotime($horaActual)));

                if ( $horalibre =  $this->horaslibre->findwhere(['idconfig'=>$config->id,'horainicio'=>$horaActual ])->first()) { 
                  $horaActual->addMinutes($horalibre->duracion);

                }
                else{
                    $horaActual->addMinutes($duracion);
                }

            } else {
                $finalizar=1;
            }
        }

   
        return view('director.horario.edit',['seccion'=>$seccion,'dias'=>$this->dias,'config'=>$config,'horas'=>$array,"hlibre"=>$hlibre]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->Horario->save($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$seccion)
    {

      $seccio= $this->seccion->find($seccion);
        

          $config =$seccio->datosAnio->datosHorarioConfig;
       
        

        $horarioinicio=Carbon::parse($config->horainicio);
        $horariofin=Carbon::parse($config->horafin);
        $duracion=$config->duracionclase;

        $finalizar=0;

        $horaActual =$horarioinicio;
        $array=array( );
        $array2 = array( );
        while ( $finalizar  == 0 ) {
            if ($horaActual <= $horariofin) {
                array_push($array, date ('h:i a',strtotime($horaActual)));

              
                  if ( $horalibre =  $this->horaslibre->findwhere(['idconfig'=>$config->id,'horainicio'=>$horaActual ])->first()) { 
                  $horaActual->addMinutes($horalibre->duracion);

                }
                else{
                    $horaActual->addMinutes($duracion);
                }

            } else {
                $finalizar=1;
            }
        }


        $tableRow='';$f=1;
        $contadorHora=1;


        for ($j=0; $j < count($array)-1 ; $j++) { 

            $td='';
            $i=1;
            $contadorHoraLibre=0;
            foreach ($this->dias as $dia) {
              
     
                  $hlibre= $this->horaslibre->findwhere(['idconfig'=>$config->id,'horainicio'=>date ('H:i:s',strtotime( $array[$j])) ])->first();
                if ($config[strtolower($dia)]=='true') {

                    if ($hlibre) {
                        $td='<td class="cursoseccion" colspan="7">

                        <div class="center">
                        <h5 class="blue">'.$hlibre->descripcion .'</h5>
                        </div>
                        </td>'; 
                        if ($j==$i) {
                            $contadorHora--;
                        } 
 $contadorHoraLibre=1;

                    } else {

                      $seccion_docente_cursos=SeccionDocenteCurso::where("seccion",$seccion)->get();
                            
                      $td2=null;
                      foreach ($seccion_docente_cursos as $seccion_docente_curso) {
$hora_curso=Horario::where(["seccion_docente_curso"=>$seccion_docente_curso->id,"horainicio"=>date ('H:i:s',strtotime( $array[$j])),"dia"=>$dia])->first();
                        if (!empty($hora_curso)) {
                               $td2= $hora_curso ;

                        }
                       
                       
                        # code...
                      }


                      if ($td2!=null) {
                              $td.='<td class="alert red">

    
                   

                           

                            <a onclick="destroyhorario('."'".$td2->idhorario."'".')" class="close red">
                                <i class="ace-icon fa fa-trash bigger-130 red"></i>
                            </a>
                        <span> <p class="text-primary"> '.$td2->info->cursoinfo->datosCurso->nombre.'</p></span>
  
                                
                              
                                  
                              
                    
                   
                        
                       </td>';
                      } else {
                        $td.='<td class="red"><div >
                        <label>
                       '.$td2.'

                        </label>
                        </div></td>';
                      }
                      
            

                    }

                } else {
                    if ($contadorHoraLibre==0) {
                         $td.='<td class="cursoseccion"><div class="center">
                    <label>
            ---
                    </label>
                    </div></td>';
                    }
                   
                }


            }



            $contadorHora++;

            $tableRow.="<tr><td> $array[$j] - 
            $array[$f]</td>".$td."</tr>";
            $f++;
        }


        return response($tableRow);


      
      
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
    public function destroy(Request $request,$id)
    {
          return $this->Horario->destroy($request->value);
    }
}
