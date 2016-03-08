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
        $datos = AulaInvertida::find($id);
        $actividad = Actividad::find($datos->fk_idActividad);
        $videos_url = AulaInvertida::getUrls($USER_ID);
        
    	return view('aInvertida/aInvertidaProfesor')
                ->with('datos',$datos)
                ->with('idCurso',$actividad->fk_idCurso)
                ->with('urls',$videos_url);
        

    }

    public function getToken()
    {
    	return "58b71769d7ee3c482ff5f4315509996c";
    }

    public function store(Request $request)
    {
    	$datos = Input::all();
        
    	$idAi = $datos['id'];
    	$Ai = AulaInvertida::find($idAi);
    	$Ai->url = $datos['url'];
    	$Ai->instruccion = $datos['instruccion'];
    	$Ai->save();


    }



}
