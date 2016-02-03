<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComentarioPropuesta extends Model
{
    protected $primaryKey = 'idComentarioPropuesta';
	  protected $table = 'comentario_propuesta';
    protected $fillable= [
		       'Contenido',
           'fk_idPropuesta',
           'idUsuario'
           
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
