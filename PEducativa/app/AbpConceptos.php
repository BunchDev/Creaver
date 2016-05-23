<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
class AbpConceptos extends Model
{
    protected $table = 'abp_conceptos';
    protected $primaryKey = 'idAbpConcepto';
    protected $fillable= [
		       'palabra',
           'concepto',
           'fuente',
           'fk_idAbp',
           'fk_idAlumno'
           
    ];
    /// table alumno needed for this too work
   //public function GetConceptos()
    //{
     //   return $this->hasMany('App\AbpConceptos');
   // }
    public static function GetConceptos($idAlumno,$idAbp)
    {
    	$FechaActual = Carbon::now();
    	$FechaLimite = Carbon::create(2016, 10, 10, 22, 30, 11);
		if($FechaActual->lt($FechaLimite)){
		$Conceptos = AbpConceptos::where('fk_idAlumno', '=', $idAlumno)
    					->where('fk_idAbp', '=', $idAbp)
    					->select(array('palabra', 'concepto','fuente'))
    					->get()
    					->tojson();
                $Conceptos=json_decode($Conceptos);
                return $Conceptos;
		}
		else{
			return null;
		}
    }
}
