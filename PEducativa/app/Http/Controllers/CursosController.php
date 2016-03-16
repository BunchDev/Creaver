<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Request;
use Illuminate\Support\Facades\Input;
use App\Curso;
use App\Actividad;
use App\Propuesta;
use FTP;
class CursosController extends Controller {
/* listarCursos retorna la vista del curso con los datos obtenidos y filtados de la BD */
public function listarCursos()
{
	/*Se realiza un select de la tabla Curso donde el id del catedratico es 0 */
	$cursosBD = Curso::where('idCatedratico',0)
				->get();
	
	
	

	return view('profesor/cursos')->with('datoscursos',$cursosBD);
}

/*Este metodo store guarda los datos que se pasan por post desde la vista*/
public function store(){

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
			// si el cliente eligió un avar se almacena 
			if($data['avatar'] != "") $curso->avatar = $data['avatar'];
			
			// el objeto creado se le invoca su metodo save que guarda en la base de datos dicho objeto
			$curso->save();
			return Redirect::back();
		 	
			}
	}



}

public function irCurso($id){
	//dd($id);
	$db=Curso::find($id);
	//dd($db);
	/*Obtengo todas las actividades de ese curso*/
	$actividades = Actividad::where('fk_idCurso',$id)->get();
	
	return view('profesor/irCurso')->with('DatosCurso',$db)->with('actividades',$actividades);
}


public function irCursoAprobar($id){
	//dd($id);
	$db=Curso::find($id);
	//dd($db);
	$comentarios=$db->comentarios($id);
	//dd($comentarios);
	$propuesta = Propuesta::where('fk_idCurso',$id)->get();
	//echo $propuesta;
	return view('profesor/irCursoAprobar')
	->with('DatosCurso',$db)
	->with('comentarios',$comentarios)
	->with('propuesta',$propuesta);
}


public function guardarArchivo(Request $request)
{
  //Direccion local del archivo que queremos subir
        $fileLocal = Input::file("archivo");
        $id = Input::get('id');
        /*Direccion remota donde queremos subir el archivo
        En este caso seria a la raiz del servidor*/
       
        $fileRemote = Input::file('archivo')->getClientOriginalName();
 
        $mode = 'FTP_BINARY';
 		$conexion = FTP::connection();
 		$conexion->changeDir("propuestas_curso");
 		$statusMD = $conexion->makeDir("propuesta_".$id);
 		$statusCD = $conexion->changeDir("propuesta_".$id);
        //Hacemos el upload
        $status = $conexion->uploadFile($fileLocal,$fileRemote,$mode);
 		$conexion->disconnect();

 		$propuesta = new Propuesta();
 		$propuesta->fk_idCurso = $id;
 		$propuesta->Version = 1;
 		$propuesta->save();
 		if($status == true) return "Ok";

 		else return "Failed";
      
 		
}
public function actualizarArchivo(Request $request)
{
  //Direccion local del archivo que queremos subir
        $fileLocal = Input::file("archivo");
        $id = Input::get('id');
        $propuesta = Propuesta::where('fk_idCurso',$id)->first();
        /*Direccion remota donde queremos subir el archivo
        En este caso seria a la raiz del servidor*/
       
        $fileRemote = "propuesta_v".($propuesta->Version+1).".".Input::file('archivo')->getClientOriginalExtension();;
       
 
        $mode = 'FTP_BINARY';
 		$conexion = FTP::connection();
 		$conexion->changeDir("propuestas_curso");
 		$statusCD = $conexion->changeDir("propuesta_".$id);
 		$truncar = $conexion->truncateDir(".");
        //Hacemos el upload

        $status = $conexion->uploadFile($fileLocal,$fileRemote,$mode);
 		$conexion->disconnect();

 		
 		$propuesta->Version = $propuesta->Version +1;
 		$propuesta->save();
 		if($status == true) return "Ok";

 		else return "Failed";
      
 		
}

public function descargarPropuesta()
{

$id = Input::get('id');
$mode= "FTP_BINARY";
$conexion = FTP::connection();
$conexion->changeDir("propuestas_curso");
$statusCD = $conexion->changeDir("propuesta_".$id);
$propuesta = Propuesta::where('fk_idCurso',$id)->first();
$archivo = $conexion->getDirListing("",null);
$archivoRemoto = $archivo[0];

$conexion->downloadFile($archivoRemoto,"descargado_".$archivoRemoto,$mode);

}


}
?>