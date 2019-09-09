<?php
namespace App\Http\Controllers\Director;
 
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Illuminate\Http\Response;


use App\Trimestre; 
use App\Repositories\TrimestreRepository;
use App\Repositories\AnioAcademicoRepository;

class TrimestreController extends Controller
{

     protected $trimestre;
     protected $AnioAcademico;

     private $numeros=array(1,2,3,4,5);

    public function __construct(TrimestreRepository $trimestre,AnioAcademicoRepository $AnioAcademico)
    {
        $this->trimestre=$trimestre;
        $this->AnioAcademico=$AnioAcademico;
       
    }

         public function getAll()
    {
          $trimestres = Trimestre::with('datosAnio')->get();
        $output = array('data' => array());

        foreach ($trimestres as $trimestre ) {
        $actionButton = '<div class=" action-buttons">
     
        <a class="green" data-target="#modal-update" href="#" data-toggle="modal"  onclick="edittrimestre('."'".route("Director.Trimestre.Edit",["id"=>$trimestre])."'".')">
        <i class="ace-icon fa fa-pen bigger-130"></i>
        </a>

        <a class="red" data-target="#modal-destroy" href="#" data-toggle="modal" onclick="destroy('."'".route('Director.Trimestre.Destroy',['id'=>$trimestre])."'".')" >
        <i class="ace-icon fa fa-trash bigger-130"></i>
        </a>
        </div>
        ';


        $output['data'][] = array(

                 
                 
             $this->AnioAcademico->nivel($trimestre->datosAnio->nivel) ,   
             $trimestre->numero.'°',
             $trimestre->fechainicio,
             $trimestre->fechafin,
             $trimestre->datosAnio->descripcion.' - s'.$trimestre->datosAnio->anio,
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
       return view('director.trimestre.index',["numeros"=>$this->numeros,'anios'=>$this->AnioAcademico->findwhere(['estado'=>'Activo'])->get()]); 
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
       return  $this->trimestre->save($request);
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
            $trimestre= Trimestre::find($id);
         

            $ruta=route("Director.Trimestre.Update",["id"=>$trimestre->id]);


            return response()->json(['fechainicio'=>$trimestre->fechainicio,'fechafin'=>$trimestre->fechafin,'ruta'=>$ruta]);
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
                 $Curso=Trimestre::findOrFail($id);
         $Curso->update($request->all());
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
              try {
        Trimestre::find($id)->delete();
          return response()->json(['messages' =>'Registro eliminado correctamente','success'=>true  ]);
      } catch (\Exception $e) {
        return response()->json(['messages' =>'No se puede  eliminar el registro'],422);
      }

    }
}
