<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AbpDatosCategorizacion extends Model
{
      protected $primaryKey = 'idDatosIdea';
	  protected $table = 'abp_datosidea';
    protected $fillable= [
           'fk_idCategorizacionIdeas',
           'Idea'
    ];

   
    public function ListarCategorias()
    {
     // return "hgoa";
     // return $this->hasMany('Estadia\Categorias','idTest');
   }

       public static function GetDatosCat($id)    
    {
      $FechaActual = Carbon::now();
      $FechaLimite = Carbon::create(2016, 10, 10, 22, 30, 11);
         if($FechaActual->lt($FechaLimite)){
      $Ideas = AbpDatosCategorizacion::where('fk_idCategorizacionIdeas', '=', $id)
              ->select(array('Idea'))
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
