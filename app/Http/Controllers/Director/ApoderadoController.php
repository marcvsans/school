<?php

namespace App\Http\Controllers\Director;
 
use App\Http\Controllers\Controller;
use Storage;
use Illuminate\Http\Request;

use App\Http\Response;

use App\Apoderado;
use App\Repositories\ApoderadoRepository;
use App\Repositories\PersonaRepository;

class ApoderadoController extends Controller
{

    protected $apoderado;
    protected $persona; 

    public function __construct(ApoderadoRepository $apoderado,PersonaRepository $persona)
    {
        $this->apoderado = $apoderado;
        $this->persona=$persona;
    }
 

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('Director.Apoderado.Index');
    }



    public function Retrieve()
    {

        $apoderados = Apoderado::with('persona')->get();
        $output = array('data' => array());
        foreach ($apoderados as $apoderado ) {
            $datosapoderado=$apoderado->persona;

                $actionButton = '<div class=" action-buttons">
                    <a class="blue"  href="'.route("Director.Apoderado.Show",["apoderado"=>$datosapoderado["nrodocumento"]]).'" >
                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                    </a>

                    <a class="green" href="'.route("Director.Apoderado.Edit",["apoderado"=>$datosapoderado["nrodocumento"]]).'" >
                    <i class="ace-icon fa fa-pen bigger-130"></i>
                    </a>

                    <a class="red" data-target="#modal-destroy" href="" data-toggle="modal"  onclick="destroy('."'".route('Director.Apoderado.Destroy',['id'=>$datosapoderado["nrodocumento"]])."'".')">
                    <i class="ace-icon fa fa-trash bigger-130"></i>
                    </a>
                    </div>
            ';

            $output['data'][] = array(

                $datosapoderado['nrodocumento'] ,           
                $datosapoderado->ApellidosNombres,
                $datosapoderado['direccion'],
                '<ul class="ace-thumbnails clearfix" onclick="colorboxthis();" >
                <a href="'.url(Storage::url('sistem/photos/'.$datosapoderado['foto'])).'" data-rel="colorbox">
                <img id="photoss" height="50" width="50" class="thumbnail inline no-margin-bottom "  src="'.url(Storage::url('sistem/photos/'.$datosapoderado['foto'])).'">
                </a>
                </ul>',
                $this->persona->Estado($apoderado->estado),
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
       return view('Director.Apoderado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
       $this->persona->save($request);
       return $this->apoderado->save($request);     
     
    }

       public function store2(Request $request)
    {
       
       return $this->apoderado->save2($request);     
    
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('Director.Apoderado.show',['Persona'=>$this->persona->find($id),'Apoderado'=>$this->apoderado->find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apoderado $apoderado)
    {
       return view('Director.Apoderado.edit',['Persona'=>$apoderado->persona,'Apoderado'=>$apoderado]);
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
        
         $this->persona->update($request,$id);
         $this->apoderado->update($request,$id);

         return response()->json(['messages' =>'Registro actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->apoderado->destroy($id);           
      
    }



public function SearchLive(Request $request)
{
   


        $tags = Apoderado::where('nrodocumento','like','%'.$request->q."%")->where('estado','Activo')->limit(5)->get();

        $formatted_tags = [];

        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->persona->nrodocumento, 'text' => $tag->persona->nombres .' '.$tag->persona->apellidos,'img'=>$tag->persona->foto];
        }

        $arrayName = array('data' => $formatted_tags,'pagination' =>array("more"=> 'true') );

        return response()->json($arrayName);
    
    
}



}