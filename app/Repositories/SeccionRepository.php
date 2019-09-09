<?php
namespace App\Repositories;
use App\Seccion; 
use Illuminate\Http\Request;
/**
* 
*/
class SeccionRepository
{

	public function all()
	{
		return Seccion::orderBy('grado','asc')->orderBy('letra','asc')->get();
	}

	public function save(Request $request)
	{
	 

     Seccion::firstOrCreate($request->only('anio_acad','grado','letra'),$request->only('capacidad'));
 

             return response()->json(['messages' =>'Seccion Registrada Correctamente','success'=>true  ]);
          
           
	}


	public function find( $id)
	{
		
		return Seccion::findOrFail($id);
	}

	public function update(Request $request, $id)
    {

      $seccion=Seccion::find($id);

    	 $validacion= Seccion::where(['grado'=>$seccion->grado,'letra'=>$request->letra,'anio_acad'=>$seccion->anio_acad])->whereKeyNot($id)->count();
 
          if ($validacion==0) {
           $Seccion=Seccion::findOrFail($id);

           $matriculas=$Seccion->Alumnos->count();
           $capacidad=$request->capacidad;
           if ($capacidad < $matriculas) {
             return response()->json(['messages' =>'La capacidad  debe ser mayor ó igual a '. $matriculas ],422);
           }

    	 $Seccion->update($request->all());
    	 return response()->json(['messages' =>'Seccion Actualizada Correctamente','success'=>true]);
          } else {
              return response()->json(['messages' =>'Seccion Duplicada '],422);
         }
          
    	
    }

    public function destroy($id)
    {

       

      try {
        Seccion::find($id)->delete();
          return response()->json(['messages' =>'Registro eliminado correctamente','success'=>true  ]);
      } catch (\Exception $e) {
        return response()->json(['messages' =>'No se puede  eliminar el registro'],422);
      }
    }

    public function letra($sLetra)
    {


      $letra="";
      switch ($sLetra) {
      
        case 'A':
        $letra='<span class="label label-lg label-yellow arrowed">A</span>';
        break;
        case 'B':
        $letra='<span class="label label-lg label-info  arrowed">B</span>';
        break;
        case 'C':
        $letra='<span class="label label-lg label-warning  arrowed">C</span>';
        break;
        case 'D':
        $letra='<span class="label label-lg label-purple  arrowed">D</span>';
        break;
        case 'E':
        $letra='<span class="label label-lg label-inverse  arrowed">E</span>';
        break;
 }
        return $letra;
    }

}