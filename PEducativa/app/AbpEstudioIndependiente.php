<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class AbpEstudioIndependiente extends Model
{
    protected $table = 'abp_EstudioIndependiente';
    protected $primaryKey = 'idEstudioIndependiente';
    protected $fillable= [
		       'EstudioIndependiente',
		        'Fuente',
           'fk_idAbp',
           'fk_idAlumno'
           
    ];
    public static function GetEstudio($idAlumno,$idAbp)
    {
    	$FechaActual = Carbon::now();
    	$FechaLimite = Carbon::create(2016, 10, 10, 22, 30, 11);
		if($FechaActual->lt($FechaLimite)){
    	$EstudioIndependiente = AbpEstudioIndependiente::where('fk_idAlumno', '=', $idAlumno)
    			->where('fk_idAbp', '=', $idAbp)
    			->select('EstudioIndependiente','Fuente')
    			->get()
    			->tojson();
        $EstudioIndependiente=json_decode($EstudioIndependiente);
        return $EstudioIndependiente;
		}
		else{
			return null;
		}            
    }

}