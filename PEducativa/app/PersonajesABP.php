<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonajesABP extends Model
{
   
    protected $primaryKey = 'idPersonajesABP';
	  protected $table = 'personajes_abp';
    protected $fillable= [
		       'Nombre',
               'fk_idABP'

           
    ];

    public function Categorias()
    {
     // por alguna razon esto no funciona
    	//return $this->hasMany('Categorias');
    }
    public function ListarCategorias()
    {
     // return "hgoa";
     // return $this->hasMany('Estadia\Categorias','idTest');
   }
}