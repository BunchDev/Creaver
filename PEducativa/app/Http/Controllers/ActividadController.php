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
        $id = 0;

    	$actividad = new Actividad();
    	$actividad->Nombre = $datos['nombre'];
    	$actividad->Descripcion = $datos['descripcion'];
    	$actividad->fk_idCurso = $datos['idcurso'];
		$actividad->tipo_tecnica = $datos['tecnica'];   
		$actividad->save(); 

        
        switch ($datos['tecnica']) {
            case 1:
                $abp = new Abp();
                $abp->fk_idActividad = $actividad->idActividad;
                $abp->save();
                $id = $abp->idABP;
                $actividad->idTecnica = $id;
                $actividad->save();

                break;
            
            default:
                echo "default";
                break;
        }	

        return $actividad->idActividad;
    }

    public function show()
    {

        $datos = Request::all();
        $actividad = Actividad::find($datos['idActividad']);
        if($actividad->tipo_tecnica==1)
        {
            return redirect('editarActividadABP/'.$actividad->idTecnica);
        }


    }

    public function edit()
    {

    }

}
