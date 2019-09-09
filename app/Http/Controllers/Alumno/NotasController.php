<?php

namespace App\Http\Controllers\Alumno;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Matricula;
use App\Notas;
use App\SeccionDocenteCurso;

class NotasController extends Controller
{
     
    public function index(Request $request,$id)
    {
      $matricula=Matricula::findOrFail($id);
      
       $this->authorize('owner',$matricula);

      $seccion=$matricula->seccion;
      $cursos=SeccionDocenteCurso::where(["seccion"=>$seccion ,[ "docente" ,"<>",null],])->get();

      $trimestres=$matricula->datosSeccion->datosAnio->trimestres;

      $thead2="";
      $body="";

      foreach ($cursos as $curso) {

        $criterios=$curso->cursoInfo->criterios;
        $thcriterio="";
        $i=1;

        foreach ($criterios as $criterio) {
          $thnota="";
          $promtrim=[]; 

          foreach ($trimestres as $trimestre) {


            $notatrimestre=0;

            foreach ($criterios as $criterio2) {
              $existsnota=Notas::where(["alumno"=>$matricula->alumno,"criterio"=>$criterio2->id,"trimestre"=>$trimestre->id,"curso"=>$curso->id])->first();

              if ($existsnota) {
                $class=$this->color($existsnota->nota);
                $notatrimestre=$notatrimestre+$existsnota->nota;

              }

            }

            $promtrim[]=  round($notatrimestre/count($criterios),0,PHP_ROUND_HALF_UP);

            $existsnota=Notas::where(["alumno"=>$matricula->alumno,"criterio"=>$criterio->id,"trimestre"=>$trimestre->id,"curso"=>$curso->id])->first();
            if ($existsnota) {
              $class=$this->color($existsnota->nota);
              $thnota.='<td class="center '.$class.'">
              '.$existsnota->nota.'</td>' ;
            }
            else{
              $thnota.='<td class="center red ">0</td>' ;
            }


          }
          // nota y promedio de trimestre

          $thpromfin=0;
          $thprom="";
          foreach ($promtrim as $ptrim) {
          $class=$this->color($ptrim);
          $thprom.="<td class='center ".$class."' style='background-color:#99b8c7'><b>".$ptrim."</b></td >";
          $thpromfin=$thpromfin+ $ptrim;
          }




          if ($i==1) {
          $notafinal=round($thpromfin/count($trimestres),0,PHP_ROUND_HALF_UP);

          $class=$this->color($notafinal);
          $thcriterio.='<tr><td rowspan="'.(count($criterios)+1).'">'.$curso->cursoinfo->datosCurso->nombre.'</td><td>'.$criterio->datoscriterio->nombre.'</td>'.$thnota.'<td rowspan="'.(count($criterios)+1).'" style="background-color:#cecaa5;font-weight:bold;" class="center bigger-110 '.$class.'"><b>'.$notafinal.'</b></td></tr>';
          if ($i==(count($criterios))) {
           $thcriterio.='<tr><td class="white" style="background-color:#748c98;">Promedio</td><b>'.$thprom.'</b></tr>';
          }



          } else {

          if ($i==(count($criterios))) {

          $thcriterio.='<tr><td>'.$criterio->datoscriterio->nombre.'</td>'.$thnota.'</tr><tr><td class="white" style="background-color:#748c98;">Promedio</td>'.$thprom.'</tr>';
          } else {
          $thcriterio.='<tr><td>'.$criterio->datoscriterio->nombre.'</td>'.$thnota.'</tr>';
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

      return  view('alumno.notas',['tabla'=>$table,"seccion"=>$matricula]);
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
