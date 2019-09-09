<?php

namespace App\Http\Controllers\Apoderado;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\alumno;
use App\Seccion;
use App\Trimestre;
use App\Notas;
use App\SeccionDocenteCurso;
use App\HorarioConfig;
use App\Horario;
use  App\HorasLibre;
use App\Apoderado;
use App\Matricula;

use App\Repositories\HorasLibreRepository; 

use Carbon\Carbon;
class ProfileApoderadoController extends Controller
{

	 protected $horaslibre;

         private $dias=array("Lunes","Martes","Miercoles","Jueves","Viernes","Sabado","Domingo");

	    public function __construct(HorasLibreRepository $horaslibre)
    {
      
              $this->horaslibre=$horaslibre;
              

    }
      public function getAlumnos(Request $request)
    {
    	 $alumnos=Apoderado::find($request->user()->user)->alumnos;

    	         $output = array('data' => array());
        foreach ($alumnos as $alumno ) {
        

            $output['data'][] = array(
  $alumno ->persona->nrodocumento,
                $alumno->persona->nombres ." ".  $alumno->persona->apellidos ,           
       
                '<a class="btn btn-xs btn-success" href="'.route('apoderado.alumnogrados',['id'=>$alumno ->persona->nrodocumento]).'"   >ver <i class="ace-icon fa fa-eye align-top bigger-125 icon-on-right"></i></a>', 
          
                '<a class="btn btn-xs btn-success" href="'.route('apoderado.horario',['id'=>$alumno ->persona->nrodocumento]).'"   >ver <i class="ace-icon fa fa-eye align-top bigger-125 icon-on-right"></i></a>',      
               
               

            );
        }


    	return response()->json($output);
    }


    public function grados($id)
    {
    	return view("apoderado.grados",["id"=>$id]);
    }

    public function getGrados($id)
    {
    	 $matriculas=Matricula::where(["alumno"=>$id])->with(["datosseccion"])->get();

    	         $output = array('data' => array());
        foreach ($matriculas as $matricula ) {
                        switch ($matricula->datosseccion->grado) {
        case '1':
        $grado='<span class="label label-lg label-yellow arrowed-in-right">Primero</span>';
        break;
        case '2':
        $grado='<span class="label label-lg label-info  arrowed-in-right">Segundo</span>';
        break;
        case '3':
        $grado='<span class="label label-lg label-warning  arrowed-in-right">Tercero</span>';
        break;
        case '4':
        $grado='<span class="label label-lg label-purple  arrowed-in-right">Cuarto</span>';
        break;
        default:
        $grado='<span class="label label-lg label-inverse  arrowed-in-right">Quinto</span>';
        break;
        }
        switch ($matricula->datosseccion->letra) {
        case 'A':
        $letra='<span class="label label-lg label-yellow arrowed">A</span>';
        break;
        case 'B':
        $letra='<span class="label label-lg label-info  arrowed">B</span>';
        break;
        case 'C':
        $letra='<span class="label label-lg label-warning  arrowed">C</span>';
        break;
        case 'D':
        $letra='<span class="label label-lg label-purple  arrowed">D</span>';
        break;
        default:
        $letra='<span class="label label-lg label-inverse  arrowed">E</span>';
        break;
        }

            $output['data'][] = array(

               // $matricula->matriculainfo->nombre ,           
                $grado ,
             $letra,
                $matricula->datosseccion->nivel,
              $matricula->anio,
           
          
                '<a class="btn btn-xs btn-success" href="'.route('apoderado.getnotas',['id'=>$matricula->idmatricula]).'"   >ver <i class="ace-icon fa fa-eye align-top bigger-125 icon-on-right"></i></a>',      
               
               

            );
        }


    	return response()->json($output);
    }

     public function getNotas($id)
    {
    	   
        $matricula=Matricula::find($id);

        $seccion=$matricula->seccion;
        $cursos=SeccionDocenteCurso::where(["seccion"=>$seccion])->get();
        $trimestres=Trimestre::where(["nivel"=>$matricula->datosseccion->nivel])->get();

        $thead2="";

        $body="";
        foreach ($cursos as $curso) {

        $criterios=$curso->cursoinfo->Criterios;
        $thcriterio="";
        $i=1;
        
        foreach ($criterios as $criterio) {
        $thnota="";
      $promtrim=[]; 
        foreach ($trimestres as $trimestre) {
  $notatrimestre=0;
 
          foreach ($criterios as $criterio2) {
                    $existsnota=Notas::where(["alumno"=>$matricula->alumno,"criterio"=>$criterio2->id,"trimestre"=>$trimestre->idtrimestre,"curso"=>$curso->id])->first();
                    if ($existsnota) {
                        $class=$this->color($existsnota->nota);
                

                        $notatrimestre=$notatrimestre+$existsnota->nota;

                    }

                  
            }
$promtrim[]=  round($notatrimestre/count($criterios),0,PHP_ROUND_HALF_UP);
                    $existsnota=Notas::where(["alumno"=>$matricula->alumno,"criterio"=>$criterio->id,"trimestre"=>$trimestre->idtrimestre,"curso"=>$curso->id])->first();
                    if ($existsnota) {
                        $class=$this->color($existsnota->nota);
                

                      

                        $thnota.='<th class="center '.$class.'">
                          '.$existsnota->nota.'</th>' ;
                    }
                    else{
                        $thnota.='<th class="center red ">
                 0</th>' ;

                    }


        }

$thpromfin=0;
$thprom="";
foreach ($promtrim as $ptrim) {
    $class=$this->color($ptrim);
  $thprom.="<td class='center ".$class."' style='background-color:#99b8c7'>".$ptrim."</td >";
  $thpromfin=$thpromfin+ $ptrim;
}


        if ($i==1) {
            $notafinal=round($thpromfin/count($trimestres),0,PHP_ROUND_HALF_UP);

             $class=$this->color($notafinal);
        $thcriterio.='<tr><td rowspan="'.(count($criterios)+1).'">'.$curso->cursoinfo->nombre.'</td><td>'.$criterio->datoscriterio->nombre.'</td>'.$thnota.'<td rowspan="'.(count($criterios)+1).'" style="background-color:#cecaa5;" class="center '.$class.'">'.$notafinal.'</td></tr>';



        } else {

        if ($i==(count($criterios))) {

        $thcriterio.='<tr><td>'.$criterio->datoscriterio->nombre.'</td></td>'.$thnota.'</tr><tr><td class="white" style="background-color:#748c98;">Promedio</td>'.$thprom.'</tr>';
        } else {
        $thcriterio.='<tr><td>'.$criterio->datoscriterio->nombre.'</td></td>'.$thnota.'</tr>';
        }


        }
        $i++;


        }
        

        $body.=$thcriterio;

        }
        foreach ($trimestres as $trimestre) {
     
        $thead2.="<th class='center' >".$trimestre->numero."</th>";
        }

     
      

        $thead2="<tr class='blue'>".$thead2."</tr>";  


        $table='<thead ><tr class="blue" ><th rowspan="2" class="blue" width="18%">Curso</th><th class="blue" rowspan="2" >Criterios de Evaluacion</th><th class="center" colspan="'.count($trimestres).'">Bimestre</th> <th rowspan="2" class="center white" style="background-color:#748c98;">Prom <br>Final</th></tr>' .$thead2.'
         </thead>

 <tbody  >'.$body.'


        </tbody>
        '        ; 

       return  view('apoderado.notas',['tabla'=>$table,"seccion"=>$matricula]);
    }

     public function horario($id)
    {
    	        
         $matricula=Matricula::where(["alumno"=>$id,"anio"=>date("Y")])->first()    ;   

         if (!empty($matricula)) {
             $config = HorarioConfig::where(['nivel'=>$matricula->datosseccion->nivel,'anio'=>date("Y")])->first();
     

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

                if ( $horalibre =  $this->horaslibre->findwhere($horaActual)) {
                    $horaActual =Carbon::parse($horalibre->horafin);

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
                $hlibre= $this->horaslibre->findwhere(date ('H:i:s',strtotime( $array[$j])));
                if ($config[strtolower($dia)]=='true') {

                    if ($hlibre) {
                        $td='<td class="matriculaseccion" colspan="7">

                        <div class="center">
                        <h5 class="blue">'.$hlibre->descripcion .'</h5>
                        </div>
                        </td>'; 
                        if ($j==$i) {
                            $contadorHora--;
                        } 
 $contadorHoraLibre=1;

                    } else {

                      $seccion_docente_matriculas=SeccionDocenteCurso::where(["seccion"=>$matricula->seccion,"anio"=>date("Y")])->get();
                      $td2=null;
                      foreach ($seccion_docente_matriculas as $seccion_docente_matricula) {
$hora_matricula=Horario::where(["seccion_docente_curso"=>$seccion_docente_matricula->id,"horainicio"=>date ('H:i:s',strtotime( $array[$j])),"dia"=>$dia])->first();

                        if (!empty($hora_matricula)) {
                               $td2= $hora_matricula ;
                        }
                       
                       
                        # code...
                      }


                      if ($td2!=null) {
                              $td.='<td class="alert red">

    
                   

                           

                         
                        <span> <p class="text-primary"> '.$td2->info->cursoinfo->nombre.'</p> <p class="text-success"> '.$td2->info->docenteinfo->persona->nombres.' '.$td2->info->docenteinfo->persona->apellidos.'</p></span>
  
                                
                              
                                  
                              
                    
                   
                        
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
                         $td.='<td class="matriculaseccion"><div class="center">
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
         }else{
            $tableRow="<tr><td colspan='8'>  
           </td></tr>";
         }
    
       


       return  view('apoderado.horario',['tabla'=>$tableRow]);
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
