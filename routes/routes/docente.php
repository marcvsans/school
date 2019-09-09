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
Route::group(['prefix' => 'curso'], function () {
  Route::get('get','CursoController@getAll')->name('Curso.Retrieve');

});

Route::resource('curso','CursoController',['except'=>['create','store','show','edit','update','destroy'],
'names'=>[
  'index'=>'Curso.Index'
]]);


/*
|--------------------------------------------------------------------------
| Rutas Notas
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'notas'], function () {
  Route::get('get/{id}','NotasController@getAll')->name('Notas.Retrieve');
  Route::get('seccion/{id}','NotasController@index')->name('Notas.Index');
  Route::post('seccsion/{id}','NotasController@store')->name('Notas.Store');


});

/*
|--------------------------------------------------------------------------
| Rutas Grado
|--------------------------------------------------------------------------
|
*/
Route::resource('horario','HorarioController',[
'names'=>[
  'index'=>'Horario.Index'
]]);

   

  Route::get('/', 'HomeController@index')->name('Home');
