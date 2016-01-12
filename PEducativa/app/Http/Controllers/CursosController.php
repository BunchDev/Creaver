<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Request;


class CursosController extends Controller {

public function listarCursos()
{
	$cursos =  array();
	
for($i=0;$i<10;$i++){
	array_push($cursos,array('numero' => $i,'nombre' => 'Curso','descripcion' =>'Descripcion del curso'));

}
	return view('profesor/cursos')->with('datoscursos',$cursos);
}


}



?>