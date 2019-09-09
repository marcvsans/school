<?php

namespace App\Http\Controllers\Director;
 
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Seccion;
use App\Alumno;
use App\Deuda;
use App\Descuento;
use App\DeudaDescuento;
use App\Pago;
use App\Caja;
use App\Matricula;


use App\Repositories\SeccionRepository;

use App\lib\tcpdf\TCPDF;
use App\lib\fpdf\FPDF;
use App\Repositories\AlumnoRepository;
use App\Repositories\MatriculaRepository;
use DB;
use Excel; 
use PDFN;
use PDF;
use PDFv;
use SnappyImage;
use Carbon\Carbon; 
use Anam\PhantomMagick\Converter;
 use Mpdf\Mpdf;
//use Knp\Snappy\Pdf;
class CajaController extends Controller
{
public function getAll()
    {

          $deudas =Caja::with(['deudaInfo'])->orderBy('fecha','desc')->get();
         $output = array('data' => array());

       
       foreach ($deudas as $deuda ) {


               $actionButton = '<div class=" action-buttons center">
               <a class="blue"  href="'.route('Director.Caja.Invoice',['id'=>$deuda]).'">
                    <i class="ace-icon fa fa-search-plus bigger-110 blue"></i>
                    </a>
                    <a class="blue"  onclick="invoice('."'".route('Director.Caja.Invoice',['id'=>$deuda,'print'=>1])."'".')">
                    <i class="ace-icon fas fa-print bigger-110 red"></i>
                    </a>
                    </div>
        ';



    $output['data'][] = array(

   
     $deuda->deudaInfo->alumnoInfo->persona->apellidos ." ". $deuda->deudaInfo->alumnoInfo->persona->nombres ,
  $deuda->deudaInfo->pagoInfo->descripcion ,
   date("Y/m/d h:i:s a ",strtotime($deuda->fecha)),
   
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
             return view('director.pago.caja',['alumnos'=>Alumno::all(),'descuentos'=>Descuento::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }


    public function showTable(Request $request)
    {
        $deuda=Deuda::find($request->deuda)->pagoInfo;
       
       $cantidad=$deuda->cantidad;
$fechavencimiento = Carbon::parse($deuda->fechavencimiento)->lessThanOrEqualTo(new Carbon());

$mora="";
if ($fechavencimiento==false) {
    $mora="";
    # code...
} else {
    $diasmora=Carbon::parse($deuda->fechavencimiento)->diffInDays(new Carbon());
    $totaldiasmora=$diasmora*$deuda->mora_dia;
    $cantidad += $totaldiasmora;
$dias= ($diasmora==1) ? "dia de pago atrasado" : "dias de pago atrasados";

   $mora=    ' <tr role="row" >
                                                       <td class="align-left">Mora por '.$diasmora." ".$dias.'  </td>
                                                       <td>'.$totaldiasmora.'</td>

                                                      
                                                    </tr>';
}



        $tr='<tr role="row" >
                                                       <td class="align-left">'.$deuda->descripcion.'</td>
                                                       <td>'.$deuda->cantidad.'</td>

                                                      
                                                    </tr>
                                               
                                                    '.$mora;

                                        if ($request->has('descuento')) {
    //
     

                   $descuentos=Descuento::find($request->descuento);
               
                   foreach ($descuentos as $descuento) {
                                                      $tr.='<tr >
                                                       <td class="align-left">'.$descuento->descripcion.'</td>
                                                       <td class="center"> -'.$descuento->cantidad.'</td>


                                                      
                                                    </tr>';
                                                 

                                                    $cantidad-=$descuento->cantidad;
                                                    }                                 
}    
$table='<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">Deuda</th>
                                                            <th>Cantidad</th>
                                                           
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                      '.$tr.'

                                                      
                                                    </tbody>
                                                <tfoot>    <tr>
                                                            <th class="align-right">Total</th>
                                                            <th class="center">S/. '.$cantidad.'</th>
                                                           
                                                        </tr></tfoot></table>';

         return response()->json(['tabla'=>$table,$fechavencimiento]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $caja = Caja::insertGetId([
    'fecha' => Carbon::now(),
    'operacion' => 'Pago',
    'deuda'=>$request->deuda,
    'cajero'=>$request->user()->user,
]);
    

        $deuda=Deuda::find($request->deuda);
        $deuda->estado="Pagado";
        $deuda->save();
       
                                        if ($request->has('descuento')) {
            foreach($request->descuento as $descuento) {
                $obj = new DeudaDescuento;

                $obj->deuda = $request->deuda;
                $obj->descuento=$descuento;
                $obj->caja=$caja;

                  $obj->save();
            }
}






          return response()->json(['messages' =>'Registro agregado correctamente','success'=>true]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function pdfg()
    {
//return view('admin.pago.reportes.pdf');

//return SnappyImage::loadView('admin.pago.reportes.pdf')->setOption('quality', 100)->inline();


$pdf = PDFv::loadView('director.pago.reportes.pdf1');
     ///return $pdf->stream('document.pdf');


       $data = [
        'foo' => 'bar'
    ];



header('Set-Cookie: fileDownload=true; path=/');
header('Cache-Control: max-age=60, must-revalidate');



    return PDFv::loadView('director.pago.reportes.invoice')->setPaper('a4')->setOption('margin-bottom', 0)->download('github.pdf');
    }

public function invoice(Request $request,$id)
{
   $data = [
        'foo' => 'bar'
    ];
  
return view('director.pago.reportes.invoice',['pago'=>Caja::find($id)]);



     


}

    public function SearchLive(Request $request)
{
   


        $tags = Deuda::where('alumno','like','%'.$request->q."%")->where("estado",'Pendiente')->limit(10)->get();

        $formatted_tags = [];

        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->alumnoInfo->persona->nrodocumento, 'text' => $tag->alumnoInfo->persona->nombres .' '.$tag->alumnoInfo->persona->apellidos,'img'=>$tag->alumnoInfo->persona->foto];
        }

        $arrayName = array('data' => $formatted_tags,'pagination' =>array("more"=> 'true') );

        return response()->json($arrayName);
    
    
}
}
