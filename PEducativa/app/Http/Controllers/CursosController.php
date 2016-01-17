<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Request;
use App\Curso;

class CursosController extends Controller {
/* listarCursos retorna la vista del curso con los datos obtenidos y filtados de la BD */
public function listarCursos()
{
	/*Se realiza un select de la tabla Curso donde el id del catedratico es 0 */
	$cursosBD = Curso::where('idCatedratico',0)
				->get();
	
	$cursos =  array();
	

/* Recorro todos los datos obtenidos de la consulta y lo paso a un array de arrays asocitativos*/ 
foreach($cursosBD as $dato){
	array_push($cursos,array('numero' => $dato->idCurso,'nombre' => $dato->Nombre,'descripcion' =>$dato->Descripcion,'estatus' => $dato->Estatus));
}
	return view('profesor/cursos')->with('datoscursos',$cursos);
}

/*Este metodo store guarda los datos que se pasan por post desde la vista*/
public function store()
{

	// si la peticion viene de un ajax ... 

	if(Request::ajax()) 
	{
		// obtengo todos los datos que se pasan por post mediante el formulario
		$data = Request::all();
		// si lo que viene de post está vacío ... 
		if(empty($data)) 
		{
			// retorno la pagina anterior
			return Redirect::back();
		}

		else{
			// creo un nuevo objeto curso no se pone como tal un Insert, se considera Insert 
			//el hecho de crear un nuevo objeto, ese objeto se crea y se le designan sus atributos
			//  $data['nombre'] -> se esta accediendo a la etiqueta que tiene como nombre 'nombre' 
			// en esa etiqueta es donde se pone el nombre del curso y como lo pase por POST el dato de ese
			// input, acá obtengo dicho valor. 
			$curso = new Curso;
			$curso->nombre = $data['nombre'];
			$curso->Descripcion = $data['descripcion'];
			$curso->Estatus = 0;
			// el objeto creado se le invoca su metodo save que guarda en la base de datos dicho objeto
			$curso->save();
			return Redirect::back();
		 	
			}
	}

 



}






}



?>