<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class AbpMetas extends Model
{
 protected $table = 'Abp_Metas';
    protected $primaryKey = 'idMetas';
    protected $fillable= [
		       'Metas',
           'fk_idAbp',
           'fk_idAlumno'
           
    ];
    public static function GetMetas($idAlumno,$idAbp)
    {
    	$FechaActual = Carbon::now();
    	$FechaLimite = Carbon::create(2016, 10, 10, 22, 30, 11);
		if($FechaActual->lt($FechaLimite)){
    	$Metas = AbpMetas::where('fk_idAlumno', '=', $idAlumno)
    			->where('fk_idAbp', '=', $idAbp)
    			->select('Metas')
    			->get()
    			->tojson();
        $Metas=json_decode($Metas);
        return $Metas;
		}
		else{
			return null;
		}            
    }

}