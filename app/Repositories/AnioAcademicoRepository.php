<?php
namespace App\Repositories;

use App\AnioAcademico; 
use Illuminate\Http\Request;
/**
* 
*/
class AnioAcademicoRepository
{

	public function all()
	{
		return AnioAcademico::All();
	}

	public function save(Request $request)
	{
    AnioAcademico::firstOrCreate($request->only('anio','nivel'),$request->only('descripcion','planacad','estado','conf_horario'));
    return response()->json(['messages' =>'Registro agregado correctamente']);
	}


	public function find( $id)
	{
		
		return AnioAcademico::findOrFail($id);
	}

   public function findWhere(array $wheres=[])
  {
     return AnioAcademico::where( $wheres);
  }

    public function destroy($id)
    {

      try {
        AnioAcademico::find($id)->delete();
          return response()->json(['messages' =>'Registro eliminado correctamente' ]);
      } catch (\Exception $e) {
        return response()->json(['messages' =>'No se puede  eliminar el registro'],422);
      }

    }


    public function nivel($nivel)
    {
      
$nivelAnio="";
        switch ($nivel) {
        case 'Primaria':
        $nivelAnio='<span class="label label-lg  ">Primaria</span>';
        break;
        case 'Secundaria':
        $nivelAnio='<span class="label label-lg label-info  ">Secundaria</span>';
        break;
     
        }
        return $nivelAnio;
    }

}