<?php
namespace App\Repositories;
use App\PlanAcademico; 
use Illuminate\Http\Request;
/**
* 
*/
class PlanAcademicoRepository
{

	public function all()
	{
		return PlanAcademico::All();
	}

	public function save(Request $request)
	{
    PlanAcademico::create($request->all());
    return response()->json(['messages' =>'Registro agregado correctamente']);
	}


	public function find( $id)
	{
		
		return PlanAcademico::findOrFail($id);
	}

    public function findWhere(array $wheres=[])
  {
     return PLanAcademico::where( $wheres)->get();
  }


	public function update(Request $request, $id)
    {

    	
           $PlanAcademico=PlanAcademico::findOrFail($id);
    	 $PlanAcademico->update($request->all());
    	 return response()->json(['messages' =>'Registro actualizado correctamente' ]);
      
          
    	
    }

    public function destroy($id)
    {

      try {
        PlanAcademico::find($id)->delete();
          return response()->json(['messages' =>'Registro eliminado correctamente' ]);
      } catch (\Exception $e) {
        return response()->json(['messages' =>'No se puede  eliminar el registro'],422);
      }

    }


        public function Estado($estado)
    {
        $estadoPlanAcademico="";
        switch ($estado) {

            case 'Activo':
                $estadoPlanAcademico= '<span class="label label-success arrowed-in arrowed-in-right">'.$estado.'</span>';
            break;

            case 'Inactivo':
                $estadoPlanAcademico= '<span class="label label-danger arrowed-in arrowed-in-right">'.$estado.'</span>';
            break;
       
        }

            return $estadoPlanAcademico;
    }

        public function nivel($nivel)
    {
      
$nivelPlan="";
        switch ($nivel) {
        case 'Primaria':
        $nivelPlan='<span class="label label-lg  ">Primaria</span>';
        break;
        case 'Secundaria':
        $nivelPlan='<span class="label label-lg label-info  ">Secundaria</span>';
        break;
     
        }
        return $nivelPlan;
    }

}