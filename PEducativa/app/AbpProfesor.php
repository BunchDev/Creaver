<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbpProfesor extends Model
{
   
    protected $primaryKey = 'idABP';
	  protected $table = 'peducativa';
    protected $fillable= [
		       'Contexto',
           'problematica'
           
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
