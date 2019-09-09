<?php
namespace App\Repositories;
use App\HorasLibre; 
use Illuminate\Http\Request;
/**
* 
*/
class HorasLibreRepository
{

	public function Count()
	{
		return HorasLibre::All()->count();
	}
	public function all()
	{
		return HorasLibre::All();
	}

	public function save(Request $request)
	{
		
		 HorasLibre::firstOrCreate($request->only('idconfig','horainicio'),$request->only('descripcion','duracion'));
	
		return response()->json(['messages' =>'Registro agregado correctamente']);
	}



	public function find( $id)
	{
		
		return HorasLibre::findOrFail($id);
	}

	public function findWhere(array $wheres=[])
  {
     return HorasLibre::where( $wheres);
  }

	public function update(Request $request, $id)
    {
    	$HorasLibre=HorasLibre::findOrFail($id);
    	
    	return $HorasLibre->update($request->all());
    }

    public function destroy($id)
    {

    	if (HorasLibre::find($id)->delete()) {
           return response()->json(['messages' =>'Registro eliminado correctamente','success'=>true  ]);
        } else {
            return response()->json(['messages' =>'No se puede  eliminar el registro'],422);
        }
            
    }

}