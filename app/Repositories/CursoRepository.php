<?php
namespace App\Repositories;
use App\Curso; 
use App\CursoCriterio; 
use Illuminate\Http\Request;
/**
* 
*/
class CursoRepository
{

	

	public function save(Request $request)
	{
    Curso::create($request->all());
    return response()->json(['messages' =>'Registro agregado correctamente']);
	}


	public function find( $id)
	{
		
		return Curso::findOrFail($id);
	}

  public function findWhere(array $wheres=[])
  {
     return Curso::where( $wheres)->get();
  }

	public function update(Request $request, $id)
    {

    	
           $Curso=Curso::findOrFail($id);
    	 $Curso->update($request->all());
    	 return response()->json(['messages' =>'Registro actualizado correctamente' ]);
      
          
    	
    }

    public function destroy($id)
    {

      try {
        Curso::find($id)->delete();
          return response()->json(['messages' =>'Registro eliminado correctamente' ]);
      } catch (\Exception $e) {
        return response()->json(['messages' =>'No se puede  eliminar el registro'],422);
      }

    }


        public function Estado($estado)
    {
        $estadocurso="";
        switch ($estado) {

            case 'Activo':
                $estadocurso= '<span class="label label-success arrowed-in arrowed-in-right">'.$estado.'</span>';
            break;

            case 'Inactivo':
                $estadocurso= '<span class="label label-danger arrowed-in arrowed-in-right">'.$estado.'</span>';
            break;
       
        }

            return $estadocurso;
    }

}