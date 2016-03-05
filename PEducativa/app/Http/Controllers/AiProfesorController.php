<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AulaInvertida;
use App\Actividad;

class AiProfesorController extends Controller
{
    
    public function show($id)
    {
        $datos = AulaInvertida::find($id);
        $actividad = Actividad::find($datos->fk_idActividad);

    	return view('aInvertida/aInvertidaProfesor')
                ->with('datos',$datos)
                ->with('idCurso',$actividad->fk_idCurso);
        ;

    }

    public function getToken()
    {
    	return "303ccae191efd4785ad16b77db9b11f3";
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
