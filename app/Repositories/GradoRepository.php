<?php
namespace App\Repositories;
use App\Grado; 
use Illuminate\Http\Request;
/**
* 
*/
class GradoRepository
{

	public function all()
	{
		return Grado::orderBy('nivel')->orderBy('numero')->get();
	}

	public function save(Request $request)
	{

    Grado::firstOrCreate($request->only('numero','nivel'),$request->only('estado'));
    return response()->json(['messages' =>'Registro agregado correctamente']); 
	} 


	public function find( $id)
	{
		
		return Grado::findOrFail($id);
	}

  public function findWhere(array $wheres=[])
  {
     return Grado::where( $wheres)->get();
  }

	public function update(Request $request, $id)
    {

    	
           $Grado=Grado::findOrFail($id);
    	 $Grado->update($request->all());
    	 return response()->json(['messages' =>'Registro actualizado correctamente' ]);
      
          
    	
    }

    public function destroy($id)
    {

      try {
        Grado::find($id)->delete();
          return response()->json(['messages' =>'Registro eliminado correctamente' ]);
      } catch (\Exception $e) {
        return response()->json(['messages' =>'No se puede  eliminar el registro'],422);
      }

    }


        public function Estado($estado)
    {
        $estadoGrado="";
        switch ($estado) {

            case 'Activo':
                $estadoGrado= '<span class="label label-success arrowed-in arrowed-in-right">'.$estado.'</span>';
            break;

            case 'Inactivo':
                $estadoGrado= '<span class="label label-danger arrowed-in arrowed-in-right">'.$estado.'</span>';
            break;
       
        }

            return $estadoGrado;
    }

    public function labelName($numero)
    {
        $nombreGrado="";
        switch ($numero) {
        case '1':
        $nombreGrado='<span class="label label-lg label-yellow arrowed-in-right">Primero</span>';
        break;
        case '2':
        $nombreGrado='<span class="label label-lg label-info  arrowed-in-right">Segundo</span>';
        break;
        case '3':
        $nombreGrado='<span class="label label-lg label-warning  arrowed-in-right">Tercero</span>';
        break;
        case '4':
        $nombreGrado='<span class="label label-lg label-purple  arrowed-in-right">Cuarto</span>';
        break;
        case'5':
        $nombreGrado='<span class="label label-lg label-success  arrowed-in-right">Quinto</span>';
        break;
        case'6':
        $nombreGrado='<span class="label label-lg label-inverse  arrowed-in-right">Sexto</span>';
        break;
        }
  return $nombreGrado;
    }

        public function onlyName($numero)
    {
        $nombreGrado="";
        switch ($numero) {
        case '1':
        $nombreGrado='Primero';
        break;
        case '2':
        $nombreGrado='Segundo';
        break;
        case '3':
        $nombreGrado='Tercero';
        break;
        case '4':
        $nombreGrado='Cuarto';
        break;
        case'5':
        $nombreGrado='Quinto';
        break;
        case'6':
        $nombreGrado='Sexto';
        break;
        }
  return $nombreGrado;
    }

    public function nivel($nivel)
    {
      
$nivelGrado="";
        switch ($nivel) {
        case 'Primaria':
        $nivelGrado='<span class="label label-lg  ">Primaria</span>';
        break;
        case 'Secundaria':
        $nivelGrado='<span class="label label-lg label-info  ">Secundaria</span>';
        break;
     
        }
        return $nivelGrado;
    }

}