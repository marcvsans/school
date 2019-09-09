<?php

namespace App\Http\Controllers\Apoderado;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class HomeController extends Controller
{
    
    public function Data()
    {
    	 

    }

    public function index()
    {
 

    	$data= collect([

    
'alumnos'=>$alumnos=auth()->user()->persona->apoderado->alumnos,
   

    
]);
    	


    	  return view('apoderado.index',['data'=>$data]);
    }

    


}
