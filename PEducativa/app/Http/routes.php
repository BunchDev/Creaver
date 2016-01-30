<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Rutas para el profesor
|--------------------------------------------------------------------------
|
| Se añaden las rutas que hacen referencia al profesor
|
*/

 /* ----------------   CURSOS  ----------------*/
Route::get('cursos', 'CursosController@listarCursos');
Route::post('crearCurso', 'CursosController@store');
Route::post('irCurso/{id}', 'CursosController@irCurso');
Route::post('irCursoAprobar/{id}', 'CursosController@irCursoAprobar');
/* ----------------- PERFIL  ------------------*/

Route::get('perfil',function(){

	return view('profesor/perfil');
});

/* --------------------  ABP  ----------------- */
Route::get('actividad/abp','AbpProfesorController@show');
Route::post('actividad/abp/store','AbpProfesorController@store');











/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
