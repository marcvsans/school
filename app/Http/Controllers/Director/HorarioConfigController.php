<?php

namespace App\Http\Controllers\Director;
 
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Carbon\Carbon;

use App\HorarioConfig;
use App\HorasLibre;

use App\Repositories\HorarioConfigRepository;
use App\Repositories\HorasLibreRepository;


class HorarioConfigController extends Controller
{
 
     protected $horarioconfig;
     protected $horaslibre;
     protected $seccion;

    private $niveles=array("Primaria","Secundaria");
    private $dias=array("Lunes","Martes","Miercoles","Jueves","Viernes","Sabado","Domingo");
 
    public function __construct(HorarioConfigRepository $horarioconfig,HorasLibreRepository $horaslibre)
    {
        $this->horarioconfig = $horarioconfig;
        $this->horaslibre=$horaslibre;
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         

      

            return view('director.config-horario.index',['niveles'=>$this->niveles,'dias'=>$this->dias]);

       

    }


    public function getAll()
    {
        $horarioconfigs=$this->horarioconfig->all();

        $output = array('data' => array());
        foreach ($horarioconfigs as $horarioconfig ) {
       
            $actionButton = '<div class=" action-buttons">
        

            <a class="green"  href="'.route("Director.HorarioConfig.Edit",["id"=>$horarioconfig]).'">
            <i class="ace-icon fa fa-pen bigger-130"></i>
            </a>
             <a class="red" data-target="#modal-destroy" href="" data-toggle="modal"  onclick="destroy('."'".route('Director.HorarioConfig.Destroy',['id'=>$horarioconfig])."'".')">
                    <i class="ace-icon fa fa-trash bigger-130"></i>
                    </a>
            </div>
            ';


            $output['data'][] = array(
$horarioconfig->nombre,
              date("H:i a",strtotime( $horarioconfig['horainicio']))  ,           
               date("H:i a",strtotime($horarioconfig['horafin']))  ,
            $horarioconfig['nivel'],
           
                $actionButton

            );
        }


        return response()->json($output);
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
         return $this->horarioconfig->save($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $config = $this->horarioconfig->find($id);
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
                array_push($array2, date ('h:i a',strtotime($horaActual)));

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
                        $td.='<td class="cursoseccion"><div >
                        <label>
                        Hora '.( $contadorHora) .'

                        </label>
                        </div></td>';

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

      $conf_h="<option value=''></option>";
            foreach ($array2 as $opt_hora) {
               
                    $conf_h .= '<option value="'.date("H:i:s",strtotime($opt_hora)).'"  > '.date("h:i a",strtotime($opt_hora)).'</option>'; 
                
        
            }
            $conf_h= ' <select name="horainicio" class="select2" data-placeholder="Hora Inicio" >'.$conf_h.'</select>  ';  

        return response()->json(['table'=>$tableRow,'horas'=>$conf_h]);

      
      

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('director.config-horario.edit',['niveles'=>$this->niveles,'dias'=>$this->dias,'config'=>$this->horarioconfig->find($id)]);
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
       $this->horarioconfig->update($request,$id);
   
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
       return $this->horarioconfig->destroy($id);  
    }
}
