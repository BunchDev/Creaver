<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Actividad;
use App\Abi;
use App\MaterialAbi;
use FTP;
class AbiProfesorController extends Controller
{
    public function index($id){
    	$abi = Abi::find($id);
    	
    	$actividad = Actividad::find($abi->fk_idActividad);

        if($actividad->status == 0) return $this->createViewer($actividad->idTecnica)->with('id',$abi->idAbi)->with('idCurso',$actividad->fk_idCurso);
         

    	
    }

    public function show($id)
    {
    	
    }
    public function createViewer()
    {
    	return view('tecnicas.abi.abiProfesorCreator');
    }

    public function store(Request $request)
    {
    	$files_bool = false;
    	$urls_bool = false;
    	
    	// Se obtienen todos los datos que nos manda el cliente
    	$files = Input::file('archivos');
    	$urls = Input::get('urls');
    	$id = Input::get('id');
    	$generadora = Input::get('generadora');
    	$abi = Abi::find($id);
    	$tipo = Input::get('tipo');
    	/*Se guarda la informacion del ABI */
    	//echo "GENERADORA: ".Input::get('generadora');
    	$abi->generador = $generadora;
    	$abi->tipo = $tipo;
    	$abi->save();

    	/*Se guardan los archivos que el cliente manda por FTP */
    	if($files != 'undefined') $files_bool = true;
    	if($urls != 'undefined') $urls_bool = true;
    	
    	if($files_bool) {
    		

    		// Se suben los archivos al servidor ftp ...
    		 $mode = 'FTP_BINARY';
 			$conexion = FTP::connection();
 			$conexion->changeDir('materiales_abi');
 			$statusMD = $conexion->makeDir("material_".$id);
 			$statusCD = $conexion->changeDir("material_".$id);
        	//Hacemos el upload recorriendo cada uno de los archivos que nos manda el cliente
        	
        	foreach ($files as $file) {
        		$fileRemote = $file->getClientOriginalName();
        		$conexion->uploadFile($file,$fileRemote,$mode);
        		//if($materiales) $materiales_abi->url = "http://localhost/"
        	}
        	 
        	$list_files = $conexion->getDirListing("",null);
        	foreach ($list_files as $url) {
        		$material_abi = new MaterialAbi();
    			$material_abi->fk_idAbi = $abi->idAbi;
        		$material_abi->url = $url;
        		$material_abi->tipo = 1;
        		$material_abi->save();
        	}

 			$conexion->disconnect();


    	}

    	if($urls_bool){

    		foreach ($urls as $url2) {
    			$material_abi = new MaterialAbi();
    			$material_abi->fk_idAbi = $abi->idAbi;
    			$material_abi->url = $url2;
    			$material_abi->tipo = 2;
    			$material_abi->save();
    		}
    	}
    	
     
      

    }





}
