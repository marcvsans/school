<?php
namespace App\Http\Controllers\Director;
 
use App\Http\Controllers\Controller;

use Storage;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Persona;
use App\Director;
use App\Repositories\DirectorRepository;
use App\Repositories\PersonaRepository;



class DirectorController extends Controller
{
   

   
    protected $persona;
    protected $Director;


 


    public function __construct(PersonaRepository $persona,DirectorRepository $Director)
    {

        $this->persona=$persona;
        $this->Director=$Director;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Director.Director.index');
    }

  
    public function getAll()
    {

        $Directors = Director::with('persona')->get();

        $output = array('data' => array());
        foreach ($Directors as $Director ) {
            $datosDirector=$Director->persona;
            $actionButton = '<div class=" action-buttons">
            <a class="blue"  href="'.route("Director.Director.Show",["id"=>$datosDirector["nrodocumento"]]).'">
            <i class="ace-icon fa fa-search-plus bigger-130"></i>
            </a>

            <a class="green"  href="'.route("Director.Director.Edit",["id"=>$datosDirector["nrodocumento"]]).'" onclick="editproduct('."'".$Director[0]."'".')">
            <i class="ace-icon fa fa-pen bigger-130"></i>
            </a>

            <a class="red" data-target="#modal-destroy" href="" data-toggle="modal" onclick="destroy('."'".route('Director.Director.Destroy',['id'=>$datosDirector["nrodocumento"]])."'".')" >
            <i class="ace-icon fa fa-trash bigger-130"></i>
            </a>
            </div>
            ';


            $output['data'][] = array(

                $datosDirector['nrodocumento'] ,           
                $datosDirector->ApellidosNombres,
                $datosDirector->fechanacimiento->toDateString(),
                '
                <ul class="ace-thumbnails clearfix" onclick="colorboxthis();">
                <a href="'.url(Storage::url('sistem/photos/'.$datosDirector['foto'])).'" data-rel="colorbox">
                <img height="50" id="photoss" width="50" class="thumbnail inline no-margin-bottom " src="'.url(Storage::url('sistem/photos/'.$datosDirector['foto'])).'">
                </a>
                </ul>',
               $this->persona->Estado($Director->estado),
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
          
       return view('Director.Director.create');
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
        return $this->Director->save($request);  
       
    }

       public function store2(Request $request)
    {
       
       return $this->Director->save2($request);     
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $Persona=Persona::findOrFail($id);
$Director=Director::findOrFail($id);

       return view('Director.Director.show',['Persona'=>$Persona,'director'=>$Director]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

       return view('Director.Director.edit',['Persona'=>$this->persona->find($id),'director'=>$this->Director->find($id)]);
         
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
      $this->Director->update($request,$id);
       


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
        return $this->Director->destroy($id);       
    }


}
