<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;

use Request;
use App\Http\Controllers\Controller;
use App\Actividad;
use App\Abp;
use App\AulaInvertida;
use App\Abi;
use App\Resumen;
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
        $actividad->vencimiento = $datos['vencimiento'];   
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

            case 2:
                $ai = new AulaInvertida();
                $ai->fk_idActividad = $actividad->idActividad;
                $ai->instruccion = $actividad->Descripcion;
                $ai->nombreVideo = $actividad->Nombre;
                $ai->save();
                $id = $ai->idAi;
                $actividad->idTecnica = $id;
                $actividad->save();
                break;
            case 3:
                $abi = new Abi();
                $abi->fk_idActividad = $actividad->idActividad;
                $abi->save();
                $id = $abi->idAbi;
                $actividad->idTecnica = $id;
                $actividad->save();
                break;
            case 4:
                $resumen = new Resumen();
                $resumen->fk_idActividad = $actividad->idActividad;
                $resumen->save();
                $id = $resumen->idResumen;
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
        
        switch ($actividad->tipo_tecnica) {
            case 1:
                return redirect('editarActividadABP/'.$actividad->idTecnica);
                break;
            case 2:
                return redirect('./actividad/ai/'.$actividad->idTecnica);
                break;
            case 3:
                return redirect('./actividad/abi/'.$actividad->idActividad);
                break;
            case 4:
                return redirect('./actividad/resumen/'.$actividad->idActividad);
                break;    
            default:
                # code...
                break;
        }

        

    }

    public function edit()
    {

    }

}
