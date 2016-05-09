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

Route::get('zip/abi/{id}','AbiProfesorController@downloadZip');

/*----------------- RESUMEN ------------------------------*/
Route::get('actividad/resumen/{id}','ResumenProfesorController@index');
Route::post('actividad/resumen/subirMaterial','ResumenProfesorController@store');

//la siguiente ruta se ocupa para protejer la ruta donde se alojan los archivos y retornar los
//binarios del archivo desde el servidor 

Route::get('asset/resumen/{id}/{filename}', function ($id,$filename)
{
    $path = storage_path() . '/app/acreaver/materiales_resumen/material_' . $id . "/".$filename;

    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
//

/* ------------------------MAPA MENTAL ---------------------------------------------*/
Route::get('actividad/mapamental/{id}','MapaMentalProfesorController@index');
Route::post('actividad/mapamental/subirMaterial','MapaMentalProfesorController@store');

//la siguiente ruta se ocupa para protejer la ruta donde se alojan los archivos y retornar los
//binarios del archivo desde el servidor 

Route::get('asset/mapamental/{id}/{filename}', function ($id,$filename)
{
    $path = storage_path() . '/app/acreaver/materiales_mapamental/material_' . $id . "/".$filename;

    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
//

/* ------------------------MAPA CONCEPTUAL ---------------------------------------------*/
Route::get('actividad/mapaconceptual/{id}','MapaConceptualProfesorController@index');
Route::post('actividad/mapaconceptual/subirMaterial','MapaConceptualProfesorController@store');

//la siguiente ruta se ocupa para protejer la ruta donde se alojan los archivos y retornar los
//binarios del archivo desde el servidor 

Route::get('asset/mapaconceptual/{id}/{filename}', function ($id,$filename)
{
    $path = storage_path() . '/app/acreaver/materiales_mapaconceptual/material_' . $id . "/".$filename;

    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
//

//Alumnos

/* -----------------------------------------------*

/*-----------------------ABP ALUMNO ---------------*/


Route::get('Alumno/abp/defconceptos/{id}','AbpAlumnoController@conceptosShow');
Route::post('Alumno/abp/addConceptos','AbpAlumnoController@conceptosStore');
Route::get('Alumno/abp/planteamiento/{id}','AbpAlumnoController@planteamientoCreate');
Route::post('Alumno/abp/addPlanteamientos','AbpAlumnoController@planteamientoStore');
Route::get('Alumno/abp/ideas/{id}','AbpAlumnoController@lluviaIdeasCreate');
Route::post('Alumno/abp/addIdeas','AbpAlumnoController@lluviaIdeasStore');
Route::get('Alumno/abp/categorizacion','AbpAlumnoController@categorizacionCreate');
Route::get('Alumno/abp/metas','AbpAlumnoController@metasCreate');
Route::post('Alumno/abp/metas','AbpAlumnoController@metasStore');
Route::get('Alumno/abp/estudio','AbpAlumnoController@estudioCreate');
Route::post('Alumno/abp/estudio','AbpAlumnoController@estudioStore');
Route::get('Alumno/abp/conclusion','AbpAlumnoController@conclusionCreate');
Route::post('Alumno/abp/conclusion','AbpAlumnoController@conclusionStore');




Route::get('Alumno/abp/{id}','AbpAlumnoController@show');


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
