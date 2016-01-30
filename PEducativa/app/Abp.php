<?php

namespace App;

use App\PersonajesABP;
use Illuminate\Database\Eloquent\Model;

class Abp extends Model
{ 
   
    protected $primaryKey = 'idABP';
	  protected $table = 'abp';
    protected $fillable= [
		       'Contexto',
           'problematica'
           
    ];

    public function Personajes()
    {
     
    	return $this->hasMany('PersonajesABP');
    }
    public function AgregarPersonajes($personajes,$idABP)
    {
     $datos['fk_idABP']=$idABP; 
     for ($i=0; $i <count($personajes) ; $i++) {
        $datos['Nombre']=$personajes[$i]; 
         PersonajesABP::create($datos);
          
     }
     // return $this->hasMany('Estadia\Categorias','idTest');
   }
}

