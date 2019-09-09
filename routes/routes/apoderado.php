<?php

 Route::resource('user','UserController',['except'=>['create','store','show','edit','index','destroy'],
'names'=>[  
  'update'=>'User.Update'
]]);
  Route::get('profile','UserController@profile')->name('Profile');

/*
|--------------------------------------------------------------------------
| Rutas Alumno
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'alumno'], function () {
  Route::get('get','AlumnoController@getAll')->name('Alumno.Retrieve');


});

Route::resource('alumno','AlumnoController',['except'=>['create','store','show','edit','update','destroy'],
'names'=>[  
  'index'=>'Alumno.Index'
]]);


/*
|--------------------------------------------------------------------------
| Rutas Grado
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'alumno/grado'], function () {
 Route::get('/{id}','GradoController@index')->name('Grado.Index');	
  Route::get('get/{id}','GradoController@getAll')->name('Grado.Retrieve');


});




/*
|--------------------------------------------------------------------------
|Rutas  Notas
|--------------------------------------------------------------------------
|
*/

   
  
  
 Route::get('notas/{matricula}','NotasController@index')->name('Notas.Index');

   /*
|--------------------------------------------------------------------------
|Rutas  Horario
|--------------------------------------------------------------------------
|
*/
  
  Route::get('alumno/horario/{id}','HorarioController@index')->name('Horario.Index');


   /*
|--------------------------------------------------------------------------
| Rutas Deudas
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'deuda'], function () {
  Route::get('get','DeudaController@getAll')->name('Deuda.Retrieve');
  Route::get('boleta/{id}','DeudaController@invoice' )->name('Deuda.Invoice');


});

Route::resource('deuda','DeudaController',['except'=>['create','store','show','edit','update','destroy'],
'names'=>[  
  'index'=>'Deuda.Index',
]]);



  Route::get('/', 'HomeController@index')->name('Home');


    // Route::view('/', 'apoderado.index')->name('apoderado.home');
    
