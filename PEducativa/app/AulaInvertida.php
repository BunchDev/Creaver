<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Actividad; 
use App\Curso; 
class AulaInvertida extends Model
{
   protected $primaryKey = "idAi";
   protected $table = "aulainvertida";


   public static function getUrls($idUser)
   {
   $curso = Curso::where('idCatedratico',$idUser)
   					 ->select('idCurso')
   					 ->first();
  
   $actividades = Actividad::where('fk_idCurso',$curso->idCurso)
   							 ->select('idActividad')
   							 ->get();
   
   $urls = AulaInvertida::whereIn('fk_idActividad',$actividades)
   						  ->where('url',"<>","")
   						  ->select('url')
                       ->distinct('url')
   						  ->get();
   		  
   return $urls;
   }
  
}
