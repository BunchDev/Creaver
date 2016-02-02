<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;

use Request;
use App\Http\Controllers\Controller;
use App\Actividad;
use App\Abp;

class ActividadController extends Controller
{
    public function store()
    {
    	
    	$datos = Request::all();
    	switch ($datos['tecnica']) {
    		case 1:
    			$abp = new Abp();
    			$abp->save();

    			break;
    		
    		default:
    			echo "default";
    			break;
    	}

    	$actividad = new Actividad();
    	$actividad->Nombre = $datos['nombre'];
    	$actividad->Descripcion = $datos['descripcion'];
    	$actividad->fk_idCurso = $datos['idcurso'];
		$actividad->idTecnica = $abp->idABP;
		$actividad->tipo_tecnica = $datos['tecnica'];   
		$actividad->save(); 	

        return $actividad->idActividad;
    }

    public function show()
    {

        $datos = Request::all();
        $actividad = Actividad::find($datos['idActividad']);
        if($actividad->tipo_tecnica==1)
        {
            return redirect()->action('AbpProfesorController@show');
        }


    }

    public function edit()
    {
        
    }

}
