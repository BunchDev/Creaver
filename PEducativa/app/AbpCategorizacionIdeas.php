<?php

namespace App;
use App\AbpDatosCategorizacion;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class AbpCategorizacionIdeas extends Model
{
    protected $primaryKey = 'idCategorizacionIdeas';
	  protected $table = 'abp_categorizacionideas';
    protected $fillable= [
		       'fk_idAbp',
           'fk_idAlumno',
           'NombreCategoria',
           'ColorCategoria'
    ];

    public static function ObtenerDatosIdeas($idAlumno)
    {
     $Datos = new AbpCategorizacionIdeas;
            $Datos
            ->select('idCategorizacionIdeas', 'NombreCategoria','ColorCategoria','fk_idAbp')
            ->where('fk_idAlumno', '=', $idAlumno)->get();
            
    	return  $Datos;
    }
    public function RegistrarDatos($arrayDatos,$idCategorizacion)
    {
     foreach ($arrayDatos as $Datos) {
            $NuevoAbpDatosCat = new AbpDatosCategorizacion;
            $NuevoAbpDatosCat->Idea =$Datos;
            $NuevoAbpDatosCat->fk_idCategorizacionIdeas =$idCategorizacion;
            $NuevoAbpDatosCat->save();
        }
    }
    public static function GetCategorizacion($idAlumno,$idAbp)    
    {
      $FechaActual = Carbon::now();
      $FechaLimite = Carbon::create(2016, 10, 10, 22, 30, 11);
         if($FechaActual->lt($FechaLimite)){
      $Categorizacion = AbpCategorizacionIdeas::where('fk_idAlumno', '=', $idAlumno)
              ->where('fk_idAbp', '=', $idAbp)
              ->select(array('NombreCategoria', 'ColorCategoria','idCategorizacionIdeas'))
              ->get()
              ->tojson();
                $Categorizacion=json_decode($Categorizacion);
                return $Categorizacion;
          }
           else{
              return null;
              }
    }
}