<?php
/*
|--------------------------------------------------------------------------
| Rutas Persona
|--------------------------------------------------------------------------
|
*/ 

  Route::get('profile','UserController@profile')->name('Profile');

Route::group(['prefix' => 'persona'], function () {
  Route::post('checkpersona','PersonaController@Check')->name('Persona.Check');
  
});



Route::group(['prefix' => 'user'], function () {
  Route::get('get','UserController@getAll')->name('User.Retrieve');

  Route::post('roles/{id}','UserController@roles')->name('User.Roles');
  Route::post('addrol','UserController@addRol')->name('User.Rol.Add');
  Route::post('removerol/{rol}','UserController@removeRol')->name('User.Rol.Remove');

  Route::get('searchlive','UserController@SearchLive')->name('User.Search');

});
Route::resource('user','UserController',[
'names'=>[
  'index'=>'User.Index',
  'store'=>'User.Store',
  'update'=>'User.Update',
  'destroy'=>'User.Destroy'
]]);


/*
|--------------------------------------------------------------------------
| Rutas Alumno
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'alumno'], function () {
   Route::get('get','AlumnoController@getAll')->name('Alumno.Retrieve');
   Route::post('store2','AlumnoController@store2')->name('Alumno.Store2');
   Route::get('searchliveAlumno','AlumnoController@SearchLive')->name('Alumno.Search');
   
});

Route::resource('alumno','AlumnoController',
  ['names'=>[
  'index'=>'Alumno.Index',
  'create'=>'Alumno.Create',
  'store'=>'Alumno.Store',
  'show'=>'Alumno.Show',
  'edit'=>'Alumno.Edit',
  'update'=>'Alumno.Update',
  'destroy'=>'Alumno.Destroy'
]]);


/*
|--------------------------------------------------------------------------
| Rutas Apoderado
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'apoderado'], function () {
  Route::get('get','ApoderadoController@retrieve')->name('Apoderado.Retrieve');
  Route::post('store2','ApoderadoController@store2')->name('Apoderado.Store2');
  Route::get('searchliveApoderado','ApoderadoController@SearchLive')->name('Apoderado.Search');
});  
Route::resource('apoderado','ApoderadoController',
['names'=>[
  'index'=>'Apoderado.Index',
  'create'=>'Apoderado.Create',
  'store'=>'Apoderado.Store',
  'show'=>'Apoderado.Show',
  'edit'=>'Apoderado.Edit',
  'update'=>'Apoderado.Update',
  'destroy'=>'Apoderado.Destroy'
]]);







   /*
|--------------------------------------------------------------------------
| Rutas Matricula
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'matricula'], function () {
   Route::get('get','MatriculaController@getAll')->name('Matricula.Retrieve');
   Route::post('check','MatriculaController@checkId')->name('checkmatricula');
});
  Route::resource('matricula','MatriculaController',['names'=>[
'index'=>'Matricula.Index',
'store'=>'Matricula.Store',
'destroy'=>'Matricula.Destroy'
]]);










/*
|--------------------------------------------------------------------------
| Rutas Descuentos
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'deuda'], function () {

Route::post('deudasalumno','DeudaController@alumnoDeudas')->name('Deuda.Alumno.Duedas');

   
});




/*
|--------------------------------------------------------------------------
| Rutas Caja
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'caja'], function () {
    Route::get('get','CajaController@getAll')->name('Caja.Retrieve');
        Route::get('invoice/{id}','CajaController@invoice')->name('Caja.Invoice');

 Route::post('showtable','CajaController@showTable')->name('Caja.Showtable');
  Route::get('searchlive','CajaController@SearchLive')->name('Caja.Alumno.Search');
   
});
Route::resource('caja','CajaController',['names'=>[
'index'=>'Caja.Index',
'create'=>'Caja.Create',
'store'=>'Caja.Store',
'edit'=>'Caja.Edit',
'update'=>'Caja.Update',
'destroy'=>'Caja.Destroy'
]]);


Route::get('/', 'HomeController@index')->name('Home');

Route::group(['prefix' => 'directorhome'], function () {
  Route::post('getdata','HomeController@check')->name('home.getdata'); 
 //Route::view('ic','ic')->name('ic');
});