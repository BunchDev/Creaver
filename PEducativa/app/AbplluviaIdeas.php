<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AbplluviaIdeas extends Model
{
    protected $table = 'abp_lluviaideas';
    protected $primaryKey = 'idAbplluviaIdeas';
    protected $fillable= [
		       'Ideas',
           'fk_idAbp',
           'fk_idAlumno'
           
    ];
    public static function GetIdeas($idAlumno,$idAbp)
    {
    	$FechaActual = Carbon::now();
    	$FechaLimite = Carbon::create(2016, 10, 10, 22, 30, 11);
		if($FechaActual->lt($FechaLimite)){
    	$Ideas = AbplluviaIdeas::where('fk_idAlumno', '=', $idAlumno)
    			->where('fk_idAbp', '=', $idAbp)
    			->select('Ideas')
    			->get()
    			->tojson();
        $Ideas=json_decode($Ideas);
        return $Ideas;
		}
		else{
			return null;
		}            
    }

}
