<?php


namespace App\Http\Controllers\Docente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\AnioAcademico; 
use App\SeccionDocenteCurso;

use App\Horario;


use App\Repositories\HorasLibreRepository;


use Carbon\Carbon;

class HorarioController extends Controller
{
    protected $horaslibre;
  
         private $dias=array("Lunes","Martes","Miercoles","Jueves","Viernes","Sabado","Domingo");

	    public function __construct(HorasLibreRepository $horaslibre)
    {
      
              $this->horaslibre=$horaslibre;
                
      

    }




    public function index(Request $request)
    {
    	        
$anio=AnioAcademico::where(['estado'=>'Activo','nivel'=>auth()->user()->persona->docente->nivel])->first();

       $tableRow="";
if ($anio) {

    $config = $anio->datosHorarioConfig;
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

                      $seccion_docente_cursos=SeccionDocenteCurso::where(["docente"=>$request->user()->user])->get();
                      $td2=null;
                      foreach ($seccion_docente_cursos as $seccion_docente_curso) {
                        if ($seccion_docente_curso->seccionInfo->anio_acad == $anio->id) {
                           $hora_curso=Horario::where(["seccion_docente_curso"=>$seccion_docente_curso->id,"horainicio"=>date ('H:i:s',strtotime( $array[$j])),"dia"=>$dia])->first();
                        if (!empty($hora_curso)) {
                               $td2= $hora_curso ;
                        }
                        }

                       
                       
                       
                      }


                      if ($td2!=null) {
                              $td.='<td class="alert red">

    
                   

                           

                         
                        <span> <p class="text-primary"> '.$td2->info->cursoinfo->datosCurso->nombre.'</p> <p class="text-success"> '.$td2->info->seccioninfo->datosGrado->numero.'° '.$td2->info->seccioninfo->letra.'</p></span>
  
                                
                              
                                  
                              
                    
                   
                        
                       </td>';
                      } else {
                        $td.='<td class="red"><div >
                        <label>
                       

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
 
}



       return  view('docente.horario',['tabla'=>$tableRow]);
    }



}
