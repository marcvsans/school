<?php
namespace App\Repositories;
use App\Alumno; 
use Illuminate\Http\Request;
use App\User; 
use Spatie\Permission\Models\Role;

/**
*  
*/
class AlumnoRepository
{


	public function save(Request $request)
	{
		$Alumno=Alumno::create($request->all());
		$nrodocumento=$request->input('nrodocumento');

		$user=User::create(
			['user' => $nrodocumento, 'password' => $nrodocumento,"activo"=>1]
		); 

		if (!$user->hasRole('Alumno')) {
			$user->assignRole('Alumno');
		}

		return response()->json(['messages' =>'Registro agregado correctamente']);
	}


	public function save2(Request $request)
	{
		Alumno::create($request->all());
		$nrodocumento=$request->input('nrodocumento');

		$user=User::firstOrCreate(["user"=>$nrodocumento],['password' => $nrodocumento]);

		if (!$user->hasRole('Alumno')) {
			$user->assignRole('Alumno');
		}

		return response()->json(['messages' =>'Registro agregado correctamente']);
		
	}


	public function find( $id)
	{
		return Alumno::findOrFail($id);
	}


	public function update(Request $request, $id)
    {
    	$Alumno=Alumno::findOrFail($id);
    	return $Alumno->update($request->all());
    }

    public function destroy($id)
    {

		try {

			Alumno::find($id)->delete();
			$user=User::where("user",$id)->first();
			$user->removeRole("Alumno");
			$roles=$user ->hasAnyRole (Role::where("name","<>","Alumno")->get());

			if (!$roles) {
				$user->delete();
			}

			return response()->json(['messages' =>'Registro eliminado correctamente','success'=>true  ]);

		} catch (\Exception $e) {

			return response()->json(['messages' =>'No se puede  eliminar el registro'],422);
		}     
            
    }


    public function EstadoAcademico($estado)
    {
		$estadoacademico="";
		switch ($estado) {

			case 'Estudiando':
				$estadoacademico= '<span class="label label-success arrowed-in arrowed-in-right">'.$estado.'</span>';
			break;

			case 'Egresado':
				$estadoacademico= '<span class="label label-info arrowed-in arrowed-in-right">'.$estado.'</span>';
			break;

			case 'Suspendido':
				$estadoacademico= '<span class="label label-danger arrowed-in arrowed-in-right">'.$estado.'</span>';
			break;

			case 'Retirado':
				 $estadoacademico= '<span class="label label-warning arrowed-in arrowed-in-right">'.$estado.'</span>';
			break;

		}

			return $estadoacademico;
    }

}