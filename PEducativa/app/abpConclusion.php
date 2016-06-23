<?php

namespace App;
use App\AbpUrlConclusion;
use App\AbpArchivoConclusion;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class AbpConclusion extends Model
{
    protected $primaryKey = 'idConclusion';
	protected $table = 'abp_conclusion';
    protected $fillable= [
		       'conclusion',
           'fk_idAbp',
           'fk_idAlumno'
    ];

    public function ObtenerUrl()
    {
     
    	return $this->hasMany('AbpUrlConclusion');
    }
    public static function RegistrarUrl($arrayUrl,$idCategorizacion)
    {
     foreach ($arrayUrl as $Datos) {
            $NuevoAbpUrl = new AbpUrlConclusion;
            $NuevoAbpUrl->Url =$Datos;
            $NuevoAbpUrl->fk_idConclusion=$idCategorizacion;
            $NuevoAbpUrl->save();
        }
    }
    public static function RegistrarArchivo($arrayArchivos,$idCategorizacion)
    {
     foreach ($arrayArchivos as $Datos) {
            $NuevoAbpArchivo = new AbpArchivoConclusion;
            $NuevoAbpArchivo->archivos =$Datos;
            $NuevoAbpArchivo->fk_idConclusion=$idCategorizacion;
            $NuevoAbpArchivo->save();
        }
    }
    public static function GetConclusion($idAlumno,$idAbp)    
    {
      $FechaActual = Carbon::now();
      $FechaLimite = Carbon::create(2016, 10, 10, 22, 30, 11);
         if($FechaActual->lt($FechaLimite)){
      $Conclusion = AbpUrlConclusion::where('fk_idAlumno', '=', $idAlumno)
              ->where('fk_idAbp', '=', $idAbp)
              ->select(array('conclusion'))
              ->get()
              ->tojson();
                $Conclusion=json_decode($Conclusion);
                return $Conclusion;
          }
           else{
              return null;
              }
    }
}