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
Route::post('crearActividad', 'ActividadController@store');
Route::get('irCurso/{id}', 'CursosController@irCurso');
Route::post('irActividad','ActividadController@show');
Route::get('irCursoAprobar/{id}', 'CursosController@irCursoAprobar');
Route::post('subirArchivo', 'CursosController@guardarArchivo');
Route::post('actualizarArchivo', 'CursosController@actualizarArchivo');
Route::post('descargarPropuesta', 'CursosController@descargarPropuesta');
/* ----------------- PERFIL  ------------------*/

Route::get('perfil',function(){

	return view('profesor/perfil');
});

/* --------------------  ABP ----------------- */
//Profesores
Route::get('actividad/abp/{id}','AbpProfesorController@index');
Route::post('actividad/abp/update','AbpProfesorController@update');
Route::get('editarActividadABP/{id}', 'AbpProfesorController@edit');
Route::post('eliminarActividadABP/{id}', 'AbpProfesorController@delete');


/*------------------- AULA INVERTIDA -----------*/

Route::get('actividad/ai/{id}','AiProfesorController@show');
Route::post('actividad/ai/getToken','AiProfesorController@getToken');
Route::post('actividad/ai/guardarAi','AiProfesorController@store');

/* -------Comentario Propuesta------------*/
Route::post('nuevoComentario', 'ComentarioController@store');



/* ------------------- ABI ----------------------------- */
Route::get('actividad/abi/{id}','AbiProfesorController@index');
Route::post('actividad/abi/subirMaterial','AbiProfesorController@store');

//la siguiente ruta se ocupa para protejer la ruta donde se alojan los archivos y retornar los
//binarios del archivo desde el servidor 

Route::get('asset/abi/{id}/{filename}', function ($id,$filename)
{
    $path = storage_path() . '/app/acreaver/materiales_abi/material_' . $id . "/".$filename;

    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});



//




//Alumnos

/* -----------------------------------------------*

//


Route::post('crearActividad', 'ActividadController@store');







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
