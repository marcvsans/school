<?php
namespace App\Http\Controllers\Director;
 
use App\Http\Controllers\Controller;



use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Response;
use App\HorasLibre;
use App\HorarioConfig;
use App\Repositories\HorasLibreRepository;
use App\Repositories\HorarioConfigRepository;




class HorasLibreController extends Controller
{

   
    protected $horaslibre;

    public function __construct(HorasLibreRepository $horaslibre,HorarioConfigRepository $horarioconfig)
    {
        $this->horaslibre = $horaslibre;
        $this->horarioconfig = $horarioconfig;
    }



    public function getAll($id)
    {


        $horaslibre = HorarioConfig::findOrFail($id)->HorasLibre;


        $output = array('data' => array());
       foreach ($horaslibre as $horalibre) {

                $actionButton = '<div class=" action-buttons">
              
                    <a class="green" data-target="#modal-update" href="#" data-toggle="modal"   onclick="edithoralibre('."'".route("Director.HorasLibre.Edit",["id"=>$horalibre["id"]])."'".')">
                    <i class="ace-icon fa fa-pen bigger-130"></i>
                    </a>

                      <a class="red" data-target="#modal-destroy" href="#" data-toggle="modal" onclick="destroyhlibre('."'".route('Director.HorasLibre.Destroy',['id'=>$horalibre["id"]])."'".')" >
        <i class="ace-icon fa fa-trash bigger-130"></i>
        </a>
                    </div>
        ';


    $output['data'][] = array(
      $horalibre->descripcion,   
   date("h:i a",strtotime($horalibre->horainicio)),           

     $horalibre->duracion,   

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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       return $this->horaslibre->save($request);
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
          if ($request->ajax()) {
            $horalibre= $this->horaslibre->find($id);
        
         

            $ruta=route("Director.HorasLibre.Update",["id"=>$horalibre["id"]]);


            return response()->json(['horalibre'=>$horalibre,'ruta'=>$ruta]);
        }else{
        abort(404);
        }
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
        $this->horaslibre->update($request,$id);
   
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
        return $this->horaslibre->destroy($id);    
    }
}
