<?php


namespace App\Http\Controllers\Docente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Seccion;

use App\Notas;

use App\SeccionDocenteCurso;




class NotasController extends Controller
{
   


    public function index(SeccionDocenteCurso $id)
    {

        $this->authorize('owner',$id);

        $this->authorize('active',$id->seccionInfo->datosAnio);
    	return  view('docente.notas',['seccion'=>$id]);
    }

    public function getAll($id)
    {
    	   

      
           
        $curso=SeccionDocenteCurso::find($id);
             $this->authorize('owner',$curso);
         $seccion=Seccion::find($curso->seccion);
        $criterios=$curso->cursoinfo->criterios; 
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
                $nfinal=round($notafinal/count($trimestres),0,PHP_ROUND_HALF_UP);
            $class=$this->color($nfinal);
            $body.="<tr>".$bodyalumno.$thnota."<th class='center ".$class."' style='background-color:#cecaa5;'>".$nfinal."</th></tr>";
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

      public function store(Request $request,$id)
    {
                     
             
              $curso=SeccionDocenteCurso::find($id);
         $seccion=Seccion::find($curso->seccion);
    
        $criterios=$curso->cursoinfo->criterios;
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
