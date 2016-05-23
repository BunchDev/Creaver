<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AbpPlanteamiento extends Model
{
   protected $table = 'abp_planteamientos';
    protected $primaryKey = 'idAbpPlanteamientos';
    protected $fillable= [
		       'Planteamiento',
           'fk_idAbp',
           'fk_idAlumno'
           
    ];
    public static function GetPlanteamientos($idAlumno,$idAbp)
    {
    	$FechaActual = Carbon::now();
    	$FechaLimite = Carbon::create(2016, 10, 10, 22, 30, 11);
		if($FechaActual->lt($FechaLimite)){
    	$planteamientos = AbpPlanteamiento::where('fk_idAlumno', '=', $idAlumno)
    						->where('fk_idAbp', '=', $idAbp)
    						->select('Planteamiento')
    						->get()
    						->tojson();
        $planteamientos=json_decode($planteamientos);
        return $planteamientos;
		}	
		else{
			return null;
		}      
    }

}
