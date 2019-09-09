<?php
namespace App\Repositories;
use App\Director; 
use App\SuperAdmin; 
use Illuminate\Http\Request;
use App\User; 
use Spatie\Permission\Models\Role;
/**
* 
*/
class DirectorRepository
{
 
	public function all()
	{
		return Director::All();
	}

	public function save(Request $request)
	{
		$Director=Director::create($request->all());
		 $nrodocumento=$request->input('nrodocumento');
				$user=User::create(
    ['user' => $nrodocumento, 'password' => $nrodocumento,"activo"=>1]
);
if (!$user->hasRole('Director')) {
		 	$user->assignRole('Director');
		 }  

	
		return response()->json(['messages' =>'Registro agregado correctamente']);

	}

	public function save2(Request $request)
	{
		Director::create($request->all());

		 $nrodocumento=$request->input('nrodocumento');
		  $user=User::firstOrCreate(["user"=>$nrodocumento],['password' => $nrodocumento,"activo"=>1]);
		if (!$user->hasRole('Director')) {
		 	$user->assignRole('Director');
		 }  

        return response()->json(['messages' =>'Registro agregado correctamente']);


	}



	public function find( $id)
	{
		return Director::findOrFail($id);
	}


	public function update(Request $request, $id)
    {
    	$Director=Director::findOrFail($id);
     


    	return $Director->update($request->all());
    }

    public function destroy($id)
    {

 
                   try {

  if ($id != '11111111') {
       Director::find($id)->delete();

	 $user=User::where("user",$id)->first();
	      
	  $user->removeRole("Director");
      $roles=$user ->hasAnyRole (Role::where("name","<>","Director")->get());


   if (!$roles) {
      	$user->delete();
      }
}

           return response()->json(['messages' =>'Registro eliminado correctamente','success'=>true ]);

      } catch (\Exception $e) {
        return response()->json(['messages' =>'No se puede  eliminar el registro'],422);
      }

    
            
    }

}