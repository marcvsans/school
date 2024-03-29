<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Pago; 
use Spatie\Permission\Models\Role;


/**
*  
*/
class PagoRepository
{


	public function save(Request $request)
	{
		 Pago::create($request->all());
    		return response()->json(['messages' =>'Registro agregado correctamente']);
	}


 public function findWhere(array $wheres=[])
  {
     returnPago::where( $wheres)->get();
  }
	public function update(Request $request, $id)
    {
              $Seccion=Pago::findOrFail($id);
         $Seccion->update($request->all());

         return response()->json(['messages' =>'Registro actualizado correctamente' ]);
    }

    public function destroy($id)
    {           try {

Pago::find($id)->delete();
 
           return response()->json(['messages' =>'Registro eliminado correctamente' ]);
      } catch (\Exception $e) {
        return response()->json(['messages' =>'No se puede  eliminar el registro'],422);
      }  
            
    }


/*    public function Estado($estado)
    {
		$estadoCriterio="";
        switch ($estado) {

            case 'Activo':
                $estadoCriterio= '<span class="label label-success arrowed-in arrowed-in-right">'.$estado.'</span>';
            break;

            case 'Inactivo':
                $estadoCriterio= '<span class="label label-danger arrowed-in arrowed-in-right">'.$estado.'</span>';
            break;
       
        }

            return $estadoCriterio;

}*/
}