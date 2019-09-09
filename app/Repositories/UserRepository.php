<?php
namespace App\Repositories;
use App\Alumno; 
use Illuminate\Http\Request;
use App\User; 
use Spatie\Permission\Models\Role;

/**
*  
*/
class UserRepository
{


	public function save(Request $request)
	{
		        try {
                  $user=User::create(
    ['user' => $request->persona, 'password' => bcrypt($request->persona),"activo"=>1]
);   
                    return response()->json(['messages' =>'Registro agregado correctamente','success'=>true  ]);
        } catch (\Exception $e) {
            return response()->json(['messages' =>'Registro duplicado','success'=>true  ],422);
        }
	}




	public function update(Request $request, $id)
    {
    	$user=User::findOrFail($id);
        
       $user->update($request->all()); 
         
        return response()->json(['messages' =>'Registro actualizado correctamente','success'=>true  ]);
    }

    public function destroy($id)
    {

	  try {
                User::destroy($id);
 
           return response()->json(['messages' =>'Registro agregado correctamente','success'=>true  ]);
      } catch (\Exception $e) {
        return response()->json(['messages' =>'No se puede  eliminar el registro'],422);
      }  
            
    }


    public function addRole(Request $request)
{

	 try {

	$user=User::find($request->user);
 
   $user->assignRole($request->rol);
  
	  
 
           return response()->json(['messages' =>'Registro agregado correctamente' ,"ruta"=>route("Director.User.Roles",["id"=>$user])]);
      } catch (\Exception $e) {
        return response()->json(['messages' =>'Registro  duplicado'],422);
      }
 


}

public function removeRole(Request $request,$rol)
    {
 
		     	
            # code...
         
		$user=User::find($request->user);
if ($user->user != '11111111') {
		$user->removeRole($rol);
     }

		return response()->json(['messages' =>'Registro eliminado correctamente' ,"ruta"=>route("Director.User.Roles",["id"=>$user]) ]);
      
            
    }

 
}