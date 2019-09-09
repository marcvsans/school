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
| Rutas Docente
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'docente'], function () {
  Route::get('get','DocenteController@getAll')->name('Docente.Retrieve');
  Route::post('create2','DocenteController@store2')->name('Docente.Store2');
});
  Route::resource('docente','DocenteController',
  ['names'=>[
  'index'=>'Docente.Index',
  'create'=>'Docente.Create',
  'store'=>'Docente.Store',
  'show'=>'Docente.Show',
  'edit'=>'Docente.Edit',
  'update'=>'Docente.Update',
  'destroy'=>'Docente.Destroy'
  ]]
);


/*
|--------------------------------------------------------------------------
| Rutas Director
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'director'], function () {
  Route::get('get','DirectorController@getAll')->name('Director.Retrieve');
  Route::post('create2','DirectorController@store2')->name('Director.Store2');
});
  Route::resource('director','DirectorController',['names'=>[
  'index'=>'Director.Index',
  'create'=>'Director.Create',
  'store'=>'Director.Store',
  'show'=>'Director.Show',
  'edit'=>'Director.Edit',
  'update'=>'Director.Update',
  'destroy'=>'Director.Destroy'
  ]]
);


/*
|--------------------------------------------------------------------------
| Rutas Director
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'secretaria'], function () {
  Route::get('get','SecretariaController@getAll')->name('Secretaria.Retrieve');
  Route::post('create2','SecretariaController@store2')->name('Secretaria.Store2');
});
  Route::resource('secretaria','SecretariaController',
 ['names'=>[
  'index'=>'Secretaria.Index',
  'create'=>'Secretaria.Create',
  'store'=>'Secretaria.Store',
  'show'=>'Secretaria.Show',
  'edit'=>'Secretaria.Edit',
  'update'=>'Secretaria.Update',
  'destroy'=>'Secretaria.Destroy'
  ]]);


    /*
|--------------------------------------------------------------------------
| Rutas Criterios Evaluacion
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'criterio-evaluacion'], function () {
   Route::get('get','CriterioEvaluacionController@getAll')->name('CriterioEvaluacion.Retrieve');
  
}); 
  Route::resource('criterio-evaluacion','CriterioEvaluacionController',
    ['names' => [
    'index' =>'CriterioEvaluacion.Index',
    'store'=>'CriterioEvaluacion.Store',
    'edit'=>'CriterioEvaluacion.Edit',
    'update'=>'CriterioEvaluacion.Update',
    'destroy'=>'CriterioEvaluacion.Destroy'
]]);


  /*
|--------------------------------------------------------------------------
| Rutas Curso
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'curso'], function () {
   Route::get('get','CursoController@getAll')->name('Curso.Retrieve');

});

  Route::resource('curso','CursoController', ['names' => [
    'index' =>'Curso.Index',
    'store'=>'Curso.Store',
    'edit'=>'Curso.Edit',
    'update'=>'Curso.Update',
    'destroy'=>'Curso.Destroy'
]]);


  /*
|--------------------------------------------------------------------------
| Rutas Grado
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'grado'], function () {
   Route::get('get','GradoController@getAll')->name('Grado.Retrieve');
});

  Route::resource('grado','GradoController', ['names' => [
    'index' =>'Grado.Index',
    'store'=>'Grado.Store',
    'edit'=>'Grado.Edit',
    'update'=>'Grado.Update',
    'destroy'=>'Grado.Destroy'
]]);

  /*
|--------------------------------------------------------------------------
| Rutas Plan academico
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'plan-academico'], function () {
  Route::get('get','PlanAcademicoController@getAll')->name('PlanAcademico.Retrieve');
  Route::get('{plan}/grado','PlanAcademicoController@grado')->name('PlanAcademico.Grado');
  Route::get('grado/{grado}/curso','PlanAcademicoController@gradoCurso')->name('PlanAcademico.GradoCurso');
  Route::get('curso/{curso}/criterio-de-evaluacion','PlanAcademicoController@gradoCursoCriterio')->name('PlanAcademico.CursoCriterio');
});

  Route::resource('plan-academico','PlanAcademicoController', ['names' => [
    'index' =>'PlanAcademico.Index',
    'store'=>'PlanAcademico.Store',
    'show'=>'PlanAcademico.Show',
    'edit'=>'PlanAcademico.Edit',
    'update'=>'PlanAcademico.Update',
    'destroy'=>'PlanAcademico.Destroy'
]]);


  /*
|--------------------------------------------------------------------------
| Rutas Plan academico - Grado
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'plan-academico-grado'], function () {
   Route::get('get/{plan}','PlanAcademicoGradoController@getAll')->name('PlanAcademicoGrado.Retrieve');
});

  Route::resource('plan-academico-grado','PlanAcademicoGradoController', ['names' => [
    'store'=>'PlanAcademicoGrado.Store',
    'destroy'=>'PlanAcademicoGrado.Destroy'
]]);

  /*
|--------------------------------------------------------------------------
| Rutas Plan academico - Grado - Curso
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'plan-academico-grado-curso'], function () {
   Route::get('get/{grado_curso}','PlanAcademicoGradoCursoController@getAll')->name('PlanAcademicoGradoCurso.Retrieve');
});

  Route::resource('plan-academico-grado-curso','PlanAcademicoGradoCursoController', ['names' => [
    'store'=>'PlanAcademicoGradoCurso.Store',
    'destroy'=>'PlanAcademicoGradoCurso.Destroy'
]]);


  /*
|--------------------------------------------------------------------------
| Rutas Plan academico - Grado - Curso -Criterio
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'plan-academico-curso-criterio'], function () {
   Route::get('get/{grado_curso}','CursoCriterioController@getAll')->name('PlanAcademicoCursoCriterio.Retrieve');
});

  Route::resource('plan-academico-curso-criterio','CursoCriterioController', ['names' => [
    'store'=>'CursoCriterio.Store',
    'destroy'=>'CursoCriterio.Destroy'
]]);


  /*
|--------------------------------------------------------------------------
| Rutas Configuracion de Horario 
|--------------------------------------------------------------------------
|
*/

Route::group(['prefix' => 'horario-configuracion'], function () {
   Route::get('get','HorarioConfigController@getAll')->name('HorarioConfig.Retrieve');
});
Route::resource('horario-configuracion','HorarioConfigController',
['names'=>[
'index'=>'HorarioConfig.Index',
'store'=>'HorarioConfig.Store',
  'show'=>'HorarioConfig.Show',
    'edit'=>'HorarioConfig.Edit',
    'update'=>'HorarioConfig.Update',
    'destroy'=>'HorarioConfig.Destroy'

]]);

  /*
|--------------------------------------------------------------------------
| Rutas Horas Libre
|--------------------------------------------------------------------------
|
*/

Route::group(['prefix' => 'horas-libre'], function () {
   Route::get('get','HorarioConfigController@getAll')->name('HorarioConfig.Retrieve');
    Route::get('gethoralibre/{id}','HorasLibreController@getAll')->name('HorasLibre.Retrieve');
});
 Route::resource('horas-libre','HorasLibreController',
  ['names'=>[
  'store'=>'HorasLibre.Store',
  'edit'=>'HorasLibre.Edit',
  'update'=>'HorasLibre.Update',
  'destroy'=>'HorasLibre.Destroy'
]]);



  /*
|--------------------------------------------------------------------------
| Rutas Año academico
|--------------------------------------------------------------------------
|
*/

Route::group(['prefix' => 'anio-academico'], function () {
   Route::get('get','AnioAcademicoController@getAll')->name('AnioAcademico.Retrieve');
   Route::get('activar','AnioAcademicoController@activar')->name('AnioAcademico.Activar');
     Route::post('change-estado','AnioAcademicoController@updateEstado')->name('AnioAcademico.Estado.Update');
    
});
 Route::resource('anio-academico','AnioAcademicoController',
  ['names'=>[
  'index'=>'AnioAcademico.Index'  ,
  'create'=>'AnioAcademico.Create',
  'store'=>'AnioAcademico.Store',
  'edit'=>'AnioAcademico.Edit',
  'update'=>'AnioAcademico.Update',
  'destroy'=>'AnioAcademico.Destroy'
]]);




/*
|--------------------------------------------------------------------------
| Rutas Seccion
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'seccion'], function () {
   Route::get('get','SeccionController@Retrieve')->name('Seccion.Retrieve');
  // Route::post('check','SeccionController@checkId')->name('checkseccion');
}); 
  Route::resource('seccion','SeccionController',['names' => [
    'index'=>'Seccion.Index'  ,
    'create'=>'Seccion.Create',
  'store'=>'Seccion.Store',
  'show'=>'Seccion.Show',
  'edit'=>'Seccion.Edit',
  'update'=>'Seccion.Update',
  'destroy'=>'Seccion.Destroy' 
]]);



  /*
|--------------------------------------------------------------------------
| Rutas Seccion Docente Curso 
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'seccion-docente-curso'], function () {
   Route::get('get','SeccionDocenteCursoController@getAll')->name('SeccionDocenteCurso.Retrieve');
  }); 
  Route::resource('seccion-docente-curso','SeccionDocenteCursoController',['names' => [
    'index'=>'SeccionDocenteCurso.Index'  ,
    'create'=>'SeccionDocenteCurso.Create',
  'store'=>'SeccionDocenteCurso.Store',
  'show'=>'SeccionDocenteCurso.Show',
  'edit'=>'SeccionDocenteCurso.Edit',
  'update'=>'SeccionDocenteCurso.Update',
  'destroy'=>'SeccionDocenteCurso.Destroy' 
]]);


/*
|--------------------------------------------------------------------------
| Rutas Trimestre
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'trimestre'], function () {
   Route::get('get','TrimestreController@getAll')->name('Trimestre.Retrieve');
   
});
Route::resource('trimestre','TrimestreController',['names'=>[
'index'=>'Trimestre.Index',
'store'=>'Trimestre.Store',
'edit'=>'Trimestre.Edit',
'update'=>'Trimestre.Update',
'destroy'=>'Trimestre.Destroy'
]]);


/*
|--------------------------------------------------------------------------
| Rutas Horario
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'horario'], function () {
    Route::get('get','HorarioController@getAll')->name('Horario.Retrieve');

   Route::get('asignar/{seccion}','HorarioController@create')->name('Horario.Create');
    
    Route::get('horario','HorarioController@getAll')->name('retrievehorario');
   // Route::post('updateconfig','HorarioController@updateconfig')->name('updateconfighorario');
    Route::post('savehoralibre','HorarioController@savehoralibre')->name('savehoralibre');
   

});

 
   //Route::resource('horaslibre','HorasLibreController');
   Route::resource('horario','HorarioController',['names'=>[
    'index'=>'Horario.Index',
 'store'=>'Horario.Store',
 'show'=>'Horario.Show',
 'destroy'=>'Horario.Destroy'

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
| Rutas Notas
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'notas'], function () {
  Route::get('get','NotasController@Retrieve')->name('Notas.Retrieve');
  Route::get('asignar/{seccion}','NotasController@create')->name('Notas.Create');
}); 
  Route::resource('notas','NotasController',['names'=>[
'index'=>'Notas.Index',
'store'=>'Notas.Store',
'edit'=>'Notas.Edit'
  ]]);



/*
|--------------------------------------------------------------------------
| Rutas Pagos
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'pago'], function () {
   Route::get('get','PagoController@getAll')->name('Pago.Retrieve');
   
});
Route::resource('pago','PagoController',['names'=>[
'index'=>'Pago.Index',
'store'=>'Pago.Store',
'edit'=>'Pago.Edit',
'update'=>'Pago.Update',
'destroy'=>'Pago.Destroy'
]]);


/*
|--------------------------------------------------------------------------
| Rutas Descuentos
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'descuento'], function () {
   Route::get('get','DescuentoController@getAll')->name('Descuento.Retrieve');
   
});
Route::resource('descuento','DescuentoController',['names'=>[
'index'=>'Descuento.Index',
'store'=>'Descuento.Store',
'edit'=>'Descuento.Edit',
'update'=>'Descuento.Update',
'destroy'=>'Descuento.Destroy'
]]);


/*
|--------------------------------------------------------------------------
| Rutas Descuentos
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'deuda'], function () {
   Route::get('get','DeudaController@getAll')->name('Deuda.Retrieve');
   Route::get('getalumnos','DeudaController@getAlumno')->name('Deuda.Alumnos');
   Route::get('getsecciones','DeudaController@getSeccion')->name('Deuda.Secciones');
   Route::post('store2','DeudaController@store2')->name('Deuda.Store2');

Route::post('deudasalumno','DeudaController@alumnoDeudas')->name('Deuda.Alumno.Duedas');

   
});
Route::resource('deuda','DeudaController',['names'=>[
'index'=>'Deuda.Index',
'store'=>'Deuda.Store',
'edit'=>'Deuda.Edit',
'update'=>'Deuda.Update',
'destroy'=>'Deuda.Destroy'
]]);



/*
|--------------------------------------------------------------------------
| Rutas Caja
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'caja'], function () {
    Route::get('get','CajaController@getAll')->name('Caja.Retrieve');
        Route::get('invoice/{id}','CajaController@invoice')->name('Caja.Invoice');
Route::get('df','CajaController@fun')->name('fun');
  /* Route::get('get','DeudaController@getAll')->name('retrievedeuda');
   Route::get('getalumnos','DeudaController@getAlumno')->name('deuda.alumnos');
   Route::get('getsecciones','DeudaController@getSeccion')->name('deuda.secciones');
  

Route::post('deudasalumno','DeudaController@alumnoDeudas')->name('deuda.alumnoDuedas');
Route::post('cajashow','DeudaController@cajaShow')->name('deuda.cajaShow');
*/
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
 Route::view('ic','ic')->name('ic');
});