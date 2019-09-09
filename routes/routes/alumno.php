<?php

 Route::resource('user','UserController',['except'=>['create','store','show','edit','index','destroy'],
'names'=>[  
  'update'=>'User.Update'
]]);
  Route::get('profile','UserController@profile')->name('Profile');
/*
|--------------------------------------------------------------------------
| Rutas Grado
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'grado'], function () {
  Route::get('get','GradoController@getAll')->name('Grado.Retrieve');


});

Route::resource('grado','GradoController',['except'=>['create','store','show','edit','update','destroy'],
'names'=>[  
  'index'=>'Grado.Index'
]]);


/*
|--------------------------------------------------------------------------
|Rutas  Notas
|--------------------------------------------------------------------------
|
*/

   
  
  
 Route::get('notas/{id}','NotasController@index')->name('Notas.Index');

   /*
|--------------------------------------------------------------------------
|Rutas  Horario
|--------------------------------------------------------------------------
|
*/
  
   Route::get('horario','HorarioController@index')->name('Horario.Index');


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