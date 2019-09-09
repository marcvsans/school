<?php

namespace App\Http\Controllers\Alumno;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


use App\Deuda;

class HomeController extends Controller
{
    
    public function Data()
    {
    	 

    }

    public function index()
    {


    	$data= collect([

    

    'deudas'=>Deuda::with(['pagoInfo'])->where(['estado'=>'Pendiente','alumno'=>auth()->user()->user])->take(5)->get(),
   

    
]);
    	


    	  return view('alumno.index',['data'=>$data]);
    }

    


}
