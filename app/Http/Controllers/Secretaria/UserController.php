<?php
namespace App\Http\Controllers\Secretaria;
 
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

public function profile()
{
    
   return view('secretaria.profile',['Persona'=>auth()->user()->persona]);
}

}
