<?php
namespace App\Repositories;
use App\SeccionDocenteCurso; 
use Illuminate\Http\Request;
/**
* 
*/
class SeccionDocenteCursoRepository
{

	public function all()
	{
		return SeccionDocenteCurso::orderBy('nivel', 'asc')->orderBy('grado','asc')->orderBy('letra','asc')->get();
	}

	public function save(Request $request)
	{
	  $validacion= SeccionDocenteCurso::where($request->except(['_token','capacidad']))->count();
 
          if ($validacion==0) { 
              SeccionDocenteCurso::create($request->all());
             return response()->json(['messages' =>'SeccionDocenteCurso Registrada Correctamente','success'=>true  ]);
          } else {
              return response()->json(['messages' =>'SeccionDocenteCurso Duplicada '],422);
         }
           
	}


	public function find( $id)
	{
		
		return SeccionDocenteCurso::findOrFail($id);
	}

	public function update(Request $request, $id)
    {

    	 $validacion= SeccionDocenteCurso::where($request->only(['grado','letra','nivel']))->where('idSeccionDocenteCurso','<>',$id)->count();
 
          if ($validacion==0) {
           $SeccionDocenteCurso=SeccionDocenteCurso::findOrFail($id);
    	 $SeccionDocenteCurso->update($request->all());
    	 return response()->json(['messages' =>'SeccionDocenteCurso Actualizada Correctamente','success'=>true  ]);
          } else {
              return response()->json(['messages' =>'SeccionDocenteCurso Duplicada '],422);
         }
          
    	
    }

    public function destroy($id)
    {

    	if (SeccionDocenteCurso::find($id)->delete()) {
           return response()->json(['messages' =>'SeccionDocenteCurso eliminada correctamente','success'=>true  ]);
        } else {
            return response()->json(['messages' =>'No se puede  eliminar el registro'],422);
        }
            
    }

}