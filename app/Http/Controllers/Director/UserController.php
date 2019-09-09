<?php
namespace App\Http\Controllers\Director;
 
use App\Http\Controllers\Controller;


use Storage;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Persona;
use App\User;
use App\Repositories\PersonaRepository;
use App\Repositories\UserRepository;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class UserController extends Controller
{

    protected $persona;
    protected $user;

    public function __construct(PersonaRepository $persona ,UserRepository $user )
    {

        $this->persona=$persona;
        $this->user=$user;
   
    }

    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('director.usuario.index',['roles'=> Role::all ()]);
    }


    public function getAll()
    {

        $usuarios = User::with('persona')->get();

        $output = array('data' => array());
        foreach ($usuarios as $usuario ) {
            $datosuser=$usuario->persona;
            $actionButton = '<div class=" action-buttons center">
         
            <a class="red" data-target="#modal-destroy" href="" data-toggle="modal" onclick="destroy('."'".route('Director.User.Destroy',['id'=>$usuario])."'".')" >
            <i class="ace-icon fa fa-trash bigger-130"></i>
            </a>
            </div>
            ';

$activo="";
            if ($usuario->activo == 1) {
                $activo='checked="" ';
            }

            $output['data'][] = array(

                $datosuser['nrodocumento'] ,           
                $datosuser->ApellidosNombres,
            
                '<button class="btn btn-xs btn-success btn-round" onclick="editrol('."'".route("Director.User.Roles",["id"=>$usuario])."'".')" data-target="#modal-update-criterio" href="#" data-toggle="modal"><i class="ace-icon fa fa-check-square"></i>
                                       roles 

                                               
                                            </button>',
                '
                <ul class="ace-thumbnails clearfix center" onclick="colorboxthis();">
                <a href="'.url(Storage::url('sistem/photos/'.$datosuser['foto'])).'" data-rel="colorbox">
                <img height="38" id="photoss" width="40" class="thumbnail inline no-margin-bottom " src="'.url(Storage::url('sistem/photos/'.$datosuser['foto'])).'">
                </a>
                </ul>',
               '<div class="center">
													<label>
														<input name="switch-field-1" class="ace ace-switch " type="checkbox" '.$activo.' onchange="editestado('."'".route("Director.User.Update",["id"=>$usuario])."'".',(this).checked)">
														<span class="lbl" data-lbl="Activo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inactivo"></span>
													</label>
												</div>',
                $actionButton

            );
        }


        return response()->json($output);
    }

 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
 return $this->user->save($request);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      return $this->user->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
         return $this->user->destroy($id);
    }




public function roles($id)
{

    
                  $roles="";
 $user= User::find($id);
     

           $i=0;

            foreach ($user->getRoleNames() as $rol) {
                $selected="";
              
           
                
                    $i++;

                    $selected='<tr role="row" class="odd">
                                                       <td>'.$i.'</td>
                                                        <td>'.$rol.'</td>
                                                       
                                                        <td class="center">
                                                              <a class="red" data-target="#modal-destroy" href="#" data-toggle="modal" onclick="destroyrol('."'".route('Director.User.Rol.Remove',['rol'=>$rol])."'".')" >
        <i class="ace-icon fa fa-trash bigger-130"></i>
        </a>
                                                        </td>

                                                      
                                                    </tr>'; 
                    # code...
           

                $roles.=$selected;
            }
            if ($i==0) {
               $roles='<tr> <td class="center" colspan="3" >No hay roles de Evaluacion asignados</td></tr>';
            }
$roles='
<table  class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="sample-table-2_info">
                                                <thead>
                                             <th>#</th>  <th>Rol</th>  <th>Eliminar</th>
                                                </thead>

                                                <tbody>
                                                    <input type="hidden" name="user" id="user" value="'.$user->id.'">


                                              '. $roles.'</tbody>
                                            </table>';

                                              
                                                                return response()->json(['roles'=>$roles]);
}


public function addRol(Request $request)
{
   return $this->user->addRole($request);
}

public function removeRol(Request $request,$rol)
{
  return $this->user->removeRole($request,$rol);
}


public function SearchLive(Request $request)
{
  return $this->persona->SearchLive($request);   
}

public function profile()
{
    
   return view('director.profile',['Persona'=>auth()->user()->persona]);
}

}
