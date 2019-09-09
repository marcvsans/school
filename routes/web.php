<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache'); 
    $exitCode = Artisan::call('key:generate');

    
 
    return 'DONE'; //Return anything
});


 
Route::get('/', function() {
    return redirect()->route('home');
});
Route::group(['middleware' => 'auth'], function() {
 

 Route::view('home','home')->name('home');
Route::group(['prefix' => 'director','middleware' => ['role:Director'],'namespace'=>'director' ,'as'=>'Director.'], function () { 

require (__DIR__ . '/routes/director.php');


});

Route::group(['prefix' => 'secretaria','middleware' => ['role:Secretaria'],'namespace'=>'secretaria' ,'as'=>'Secretaria.'], function () { 

require (__DIR__ . '/routes/secretaria.php');


});


Route::group(['middleware' => ['role:Docente'],'prefix' => 'docente','namespace'=>'docente' ,'as'=>'Docente.'], function () {
 require (__DIR__ . '/routes/docente.php');
   
});
Route::group(['middleware' => ['role:Alumno'],'prefix' => 'alumno','namespace'=>'alumno' ,'as'=>'Alumno.'], function () {
   
require (__DIR__ . '/routes/alumno.php');
   
});

Route::group(['middleware'=>['role:Apoderado'],'prefix'=>'apoderado','namespace'=>'apoderado','as'=>'Apoderado.'], function () {
   
require (__DIR__ . '/routes/apoderado.php');

});


});
// Route::get('admin', function () {
//     return view('admin.index');
// });

// Route::get('admin/alumno', function () {
//     return view('admin.alumno');
// });

// Route::get('admin/alumno/registrar', function () {
//     return view('admin.alumno.create');
// });


// Route::post('admin/alumno/registrar', function () {
//     return view('admin.alumno.create');
// });



Auth::routes();


