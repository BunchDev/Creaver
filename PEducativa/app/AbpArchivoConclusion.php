<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbpArchivoConclusion extends Model
{
    protected $primaryKey = 'idArchivoConclusion';
	protected $table = 'abp_archivosconclusion';
    protected $fillable= [
           'fk_ideaConclusion',
           'archivo'
    ];

   
    public function ListarCategorias()
    {
     // return "hgoa";
     // return $this->hasMany('Estadia\Categorias','idTest');
   }
}
