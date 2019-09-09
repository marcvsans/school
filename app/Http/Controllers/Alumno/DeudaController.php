<?php

namespace App\Http\Controllers\Alumno;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use  App\Deuda;
use Carbon\Carbon;
class DeudaController extends Controller
{

   public function getAll() 
    {
      $deudas = Deuda::with(['pagoInfo'])->where(['alumno'=>auth()->user()->user])->get();
         $output = array('data' => array());
       foreach ($deudas as $deuda ) {
$href="#";
  switch ($deuda->estado) {
      case 'Pendiente':
  $estado='<span class="label label-danger arrowed-in">Pendiente</span>';
          break;
      
      case 'Pagado':
     $estado='<span class="label label-sucess arrowed-in">Pagado</span>';
     $href=route('Alumno.Deuda.Invoice',['id'=>$deuda->id]);
          break;
  }

               $actionButton = '<div class=" action-buttons">
                    <a class="blue"  href="'.$href.'"  >
                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                    </a>
                    </div>
        ';



    $output['data'][] = array(
    $deuda->pagoInfo->descripcion ,
    "S/.".$deuda->pagoInfo->cantidad,
   " S/. ".$deuda->pagoInfo->mora_dia,
    $deuda->pagoInfo->fechavencimiento->format('Y/m/d h:i:s a'),
    $deuda->pagoInfo->anio,
    $estado,
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
       
        return view('alumno.pago.deuda');
    }


    public function invoice($deuda)
    {
        $deuda=Deuda::findOrFail($deuda);
        $this->authorize('owner',$deuda);

       if ($deuda->cajaInfo) {
           return view('alumno.pago.reportes.invoice',['pago'=>$deuda->cajaInfo]);
        }else{
         abort(404) ;
        }
    }


  
}
