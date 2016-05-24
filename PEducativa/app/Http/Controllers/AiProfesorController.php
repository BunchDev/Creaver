<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AulaInvertida;
use App\Actividad;
use App\Curso;

class AiProfesorController extends Controller
{
    
    public function show($id)
    {
        $USER_ID = 0;
        
        $actividad = Actividad::find($id);
        $datos = AulaInvertida::find($actividad->idTecnica);
      
        if($actividad->status == 1 )
        {
            return view('aInvertida.aInvertidaProfesorPreview')->with('aula',$datos)->with('curso',$actividad->fk_idCurso);
        }
        else{
        $videos_url = AulaInvertida::getUrls($USER_ID);
        
    	return view('aInvertida/aInvertidaProfesor')
                ->with('datos',$datos)
                ->with('idCurso',$actividad->fk_idCurso)
                ->with('urls',$videos_url);
        
        }
    }

    public function getToken()
    {
    	return "58b71769d7ee3c482ff5f4315509996c";
    }

    public function store(Request $request)
    {
        //lo siguiente comentado es como anteriormente se guardaban los datos
        /*
    	$datos = Input::all();
        
    	$idAi = $datos['id'];
    	$Ai = AulaInvertida::find($idAi);
        $actividad = Actividad::find($Ai->fk_idActividad);
    	$Ai->url = $datos['url'];
    	$Ai->instruccion = $datos['instruccion'];
        $actividad->status = 1; 
    	$Ai->save();
        $actividad->save();
        */

        try{
        $idAi = Input::get('id');
        $instruccion = Input::get('instruccion');
        $retos = Input::get('retos');
        $retos = json_decode($retos);
        $media = Input::get('media');
        $media = json_decode($media);
        if($media->uploadVideo)
        {
            $video = Input::file('video');
            $nombre = Input::get('nombre');
            $thumbnail = Input::file('thumbnail');
            echo "Se anexó un vídeo<br>";
        }
        if($media->urls)
        {
            $urls = Input::get('urls');
            $urls = json_decode($urls);
            echo "Se anexaron las siguientes urls : ".json_encode($urls)."<br>";
        }
        if($media->videoUploaded)
        {
            $urlsVU = Input::get('urlsVU');
            $urlsVU = json_decode($urlsVU);
            echo "Se anexaron los siguientes videos subidos anteriormente : ".json_encode($urlsVU)."<br>";

        }

        return "EXITOSO ! ";

    }

    catch(Exception $e){

        return $e;

    }


            





    }



}
