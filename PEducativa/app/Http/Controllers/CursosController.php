<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Request;
use App\Curso;

class CursosController extends Controller {

public function listarCursos()
{
	$cursosBD = Curso::where('idCatedratico',0)
				->get();
	
	$cursos =  array();
	


foreach($cursosBD as $dato){
	array_push($cursos,array('numero' => $dato->idCurso,'nombre' => $dato->Nombre,'descripcion' =>$dato->Descripcion,'estatus' => $dato->Estatus));
}
	return view('profesor/cursos')->with('datoscursos',$cursos);
}


public function store()



	if(Request::ajax()){
		$data = Request::all();

		if(empty($data)) 
		{

			return Redirect::back();
		}
		else{
			$curso = new Curso;
			$curso->nombre = $data['nombre'];
			$curso->Descripcion = $data['descripcion'];
			$curso->Estatus = 0;

			$saved = $curso->save();
			return Redirect::back();
		 	
			}
	}

 



}






}



?>