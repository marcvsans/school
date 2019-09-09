<?php
namespace App\Http\Controllers\Director;
 
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


use App\Pago;

use App\Repositories\PagoRepository;


class PagoController extends Controller
{


    protected $pago;
  


    public function __construct(PagoRepository $pago)
    {
        $this->pago = $pago;
     
    
    }
           public function getAll()
    {


      $pagos = Pago::all();
         $output = array('data' => array());
       foreach ($pagos as $pago ) {



               $actionButton = '<div class=" action-buttons center"  >
                   

               <a class="green" data-target="#modal-update" href="#" data-toggle="modal"  onclick="editpago('."'".route("Director.Pago.Edit",["id"=>$pago->id])."'".')">
        <i class="ace-icon fa fa-pen bigger-130"></i>
        </a>

                    <a class="red"  data-target="#modal-destroy" href="" data-toggle="modal" onclick="destroy('."'".route('Director.Pago.Destroy',['id'=>$pago->id])."'".')">
                    <i class="ace-icon fa fa-trash bigger-130"></i>
                    </a>
                    </div>
        ';



    $output['data'][] = array(
    
    $pago->descripcion ,
    $pago->cantidad,
    $pago->mora_dia,
    $pago->anio,
    $pago->fechavencimiento->format('y-m-d'),

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
       
        return view('director.pago.index');
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
         

         return $this->pago->save($request);       

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
    public function edit($id)
    {
        $Curso=Pago::findOrFail($id);
        $ruta=route("Director.Pago.Update",["id"=>$Curso["id"]]);

        return response()->json(["datos"=>$Curso,"ruta"=>$ruta]);
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
       return $this->pago->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
     return $this->pago->destroy($id);
    }
}
