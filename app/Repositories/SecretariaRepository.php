<?php
namespace App\Repositories;
use App\Secretaria; 
use App\SuperAdmin; 
use Illuminate\Http\Request;
use App\User; 
use Spatie\Permission\Models\Role;
/**
* 
*/
class SecretariaRepository
{

	public function all()
	{
		return Secretaria::All();
	}

	public function save(Request $request)
	{
		$Secretaria=Secretaria::create($request->all());
		 $nrodocumento=$request->input('nrodocumento');
				$user=User::create(
    ['user' => $nrodocumento, 'password' => $nrodocumento,"activo"=>1]
);
if (!$user->hasRole('Secretaria')) {
		 	$user->assignRole('Secretaria');
		 }  

	
		return response()->json(['messages' =>'Registro agregado correctamente']);

	}

	public function save2(Request $request)
	{
		Secretaria::create($request->all());

		 $nrodocumento=$request->input('nrodocumento');
		  $user=User::firstOrCreate(["user"=>$nrodocumento],['password' => $nrodocumento,"activo"=>1]);
		if (!$user->hasRole('Secretaria')) {
		 	$user->assignRole('Secretaria');
		 }  

        return response()->json(['messages' =>'Registro agregado correctamente' ]);


	}

	public function find( $id)
	{
		
		return Secretaria::findOrFail($id);
	}

	public function update(Request $request, $id)
    {
    	$Secretaria=Secretaria::findOrFail($id);



        


    	return $Secretaria->update($request->all());
    }

    public function destroy($id)
    {

 
                   try {


       Secretaria::find($id)->delete();
	 $user=User::where("user",$id)->first();
	  $user->removeRole("Secretaria");
      $roles=$user ->hasAnyRole (Role::where("name","<>","Secretaria")->get());


   if (!$roles) {
      	$user->delete();
      }


           return response()->json(['messages' =>'Registro eliminado correctamente','success'=>true ]);

      } catch (\Exception $e) {
        return response()->json(['messages' =>'No se puede  eliminar el registro'],422);
      }

    
            
    }

}