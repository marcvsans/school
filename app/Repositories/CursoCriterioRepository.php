<?php
namespace App\Repositories;
use App\CursoCriterio; 
use Illuminate\Http\Request;
/**
* 
*/
class CursoCriterioRepository
{

	public function all()
	{
		return CursoCriterio::All();
	}

	public function save(Request $request)
	{
    CursoCriterio::firstOrCreate($request->only('criterio','curso'));
    return response()->json(['messages' =>'Registro agregado correctamente']);
	}


	public function find( $id)
	{
		
		return CursoCriterio::findOrFail($id);
	}

 

    public function destroy($id)
    {

      try {
        CursoCriterio::find($id)->delete();
          return response()->json(['messages' =>'Registro eliminado correctamente' ]);
      } catch (\Exception $e) {
        return response()->json(['messages' =>'No se puede  eliminar el registro'],422);
      }

    }



}