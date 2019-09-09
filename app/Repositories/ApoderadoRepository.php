<?php
namespace App\Repositories;
use App\Apoderado; 
use Illuminate\Http\Request;

use App\User; 
use Spatie\Permission\Models\Role;

/**  
*  
*/
class ApoderadoRepository
{

	public function all()
	{
		return Apoderado::All();
	}

	public function save(Request $request)
	{
		Apoderado::create($request->all());
		 $nrodocumento=$request->input('nrodocumento');

		 $user=User::create(
		['user' => $nrodocumento, 'password' => $nrodocumento,"activo"=>1]
		);

		if (!$user->hasRole('Apoderado')) {
		 	$user->assignRole('Apoderado');
		 }
		 
		 return response()->json(['messages' =>'Registro agregado correctamente']);
	}

	public function save2(Request $request)
	{
		Apoderado::create($request->all());
 $nrodocumento=$request->input('nrodocumento');

		 	 $user=User::firstOrCreate(["user"=>$nrodocumento],['password' => $nrodocumento]);
		if (!$user->hasRole('Apoderado')) {
		 	$user->assignRole('Apoderado');
		 }
        return response()->json(['messages' =>'Registro agregado correctamente']);


	}

	public function find( $id)
	{
		
		return Apoderado::findOrFail($id);
	}

	public function update(Request $request, $id)
    {
    	$Apoderado=Apoderado::findOrFail($id);
    	
    	return $Apoderado->update($request->all());
    }

    public function destroy($id)
    {

    

        try {

      	      Apoderado::find($id)->delete();
	 $user=User::where("user",$id)->first();
	 $user->removeRole("Apoderado");
      $roles=$user ->hasAnyRole (Role::where("name","<>","Apoderado")->get());

      if (!$roles) {
      	$user->delete();
      }
      
 
           return response()->json(['messages' =>'Registro eliminado correctamente','success'=>true  ]);
      } catch (\Exception $e) {
        return response()->json(['messages' =>'No se puede  eliminar el registro'],422);
      }
    
    	
    }

}