<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Request;
use App\Curso;

class CursosController extends Controller {

public function listarCursos()
{

	$cursos =  array();
	

for($i=1;$i<=40;$i++){
	array_push($cursos,array('numero' => $i,'nombre' => 'Curso','descripcion' =>'Descripcion del curso'));

}
	return view('profesor/cursos')->with('datoscursos',$cursos);
}


public function store()
{
$datos = Request::all();
if(empty($datos)) 
{
	return Redirect::back();
}

else
{
	$curso = new Curso;
	$curso->nombre = $datos['nombre'];
	$curso->descripcion = $datos['descripcion'];

	$curso->save();

	return Redirect::back();
}

}






}



?>