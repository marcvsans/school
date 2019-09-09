<?php
namespace App\Repositories;
use App\Docente; 
use Illuminate\Http\Request;
use App\User; 
use Spatie\Permission\Models\Role;
/**
*  
*/
class DocenteRepository
{

	public function all()
	{
		return Docente::All(); 
	}

	public function save(Request $request)
	{
		$Docente=Docente::create($request->all());
			 $nrodocumento=$request->input('nrodocumento');
		$user=User::create(
    ['user' => $nrodocumento, 'password' => $nrodocumento,"activo"=>1]
);

if (!$user->hasRole('Docente')) {
		 	$user->assignRole('Docente');
		 }	
	
		return response()->json(['messages' =>'Registro agregado correctamente']);
	}

	public function save2(Request $request)
	{
		Docente::create($request->all());
 $nrodocumento=$request->input('nrodocumento');

	 	  $user=User::firstOrCreate(["user"=>$nrodocumento],['password' => $nrodocumento]);
	if (!$user->hasRole('Docente')) {
		 	$user->assignRole('Docente');
		 }

        return response()->json(['messages' =>'Registro agregado correctamente']);


	}

	public function find( $id)
	{
		
		return Docente::findOrFail($id);
	}

	public function update(Request $request, $id)
    {
    	$Docente=Docente::findOrFail($id);
    	
    	return $Docente->update($request->all());
    }

    public function destroy($id)
    {

    

           try {

      	     	Docente::find($id)->delete();
	 $user=User::where("user",$id)->first();
	 $user->removeRole("Docente");
      $roles=$user ->hasAnyRole (Role::where("name","<>","Docente")->get());

      if (!$roles) {
      	$user->delete();
      }
      
 
           return response()->json(['messages' =>'Registro eliminado correctamente','success'=>true  ]);
      } catch (\Exception $e) {
        return response()->json(['messages' =>'No se puede  eliminar el registro'],422);
      }
    
            
    }

}