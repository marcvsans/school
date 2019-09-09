<?php
namespace App\Repositories;
use App\HorarioConfig; 
use Illuminate\Http\Request;
use App\Http\Requests;

use Carbon\Carbon;
/** 
* 
*/
class HorarioConfigRepository
{

	public function Count()
	{
		return HorarioConfig::count();
	}
	public function all()
	{
		return HorarioConfig::all();
	}

	public function save(Request $request)
	{
		
$HorarioConfig= HorarioConfig::create($request->all());
             
 return response()->json(['messages' =>'Registro agregado correctamente']);          
         
	}


	public function find( $id)
	{
		
		return HorarioConfig::findOrFail($id);
	}

    public function findWhere(array $wheres=[])
  {
     return HorarioConfig::where( $wheres)->get();
  }
	public function update(Request $request, $id)
    {
    	$HorarioConfig=HorarioConfig::findOrFail($id);
	
		return $HorarioConfig->update([
			'nombre'=>$request->nombre,
			'horainicio' =>($request->input('horainicio')),
			'horafin' =>($request->input('horafin')),
			'lunes' =>$request->input('lunes','false'),
			'martes' =>$request->input('martes','false'),
			'miercoles' =>$request->input('miercoles','false'),
			'jueves' =>$request->input('jueves','false'),
			'viernes' =>$request->input('viernes','false'),
			'sabado' =>$request->input('sabado','false'),
			'domingo' =>$request->input('domingo','false'),
			'duracionclase'=>$request->input('duracionclase')

		]);
    }
     public function destroy($id)
    {

      try {
        HorarioConfig::find($id)->delete();
          return response()->json(['messages' =>'Registro eliminado correctamente' ]);
      } catch (\Exception $e) {
        return response()->json(['messages' =>'No se puede  eliminar el registro'],422);
      }

    }


}