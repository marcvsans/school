<?php

namespace App\Http\Controllers\Apoderado;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use  App\Deuda;
use  App\Alumno;
use Carbon\Carbon;
class DeudaController extends Controller
{

   public function getAll() 
    {
 $output = array('data' => array());
$alumnos=auth()->user()->persona->apoderado->alumnos;
foreach ($alumnos as $alumno) {

      $deudas = Deuda::with(['pagoInfo'])->where(['alumno'=>$alumno->nrodocumento])->get();

        
       foreach ($deudas as $deuda ) {
$href="#";
  switch ($deuda->estado) {
      case 'Pendiente':
  $estado='<span class="label label-danger arrowed-in">Pendiente</span>';
          break;
      
      case 'Pagado':
     $estado='<span class="label label-sucess arrowed-in">Pagado</span>';
     $href=route('Apoderado.Deuda.Invoice',['id'=>$deuda->id]);
          break;
  }

               $actionButton = '<div class=" action-buttons">
                    <a class="blue"  href="'.$href.'"  >
                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                    </a>
                    </div>
        ';



    $output['data'][] = array(
      $alumno->persona->NombresApellidos,
    $deuda->pagoInfo->descripcion ,
    "S/.".$deuda->pagoInfo->cantidad,
   " S/. ".$deuda->pagoInfo->mora_dia,
    $deuda->pagoInfo->fechavencimiento->format('Y/m/d h:i:s a'),
    $deuda->pagoInfo->anio,
    $estado,
    $actionButton  
      
    );
       }
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
       
        return view('apoderado.pago.deuda');
    }


    public function invoice($deuda)
    {
        $deuda=Deuda::findOrFail($deuda);
        $this->authorize('hijo',Alumno::find($deuda->alumno));

       if ($deuda->cajaInfo) {
           return view('apoderado.pago.reportes.invoice',['pago'=>$deuda->cajaInfo]);
        }else{
         abort(404) ;
        }
    }


  
}
