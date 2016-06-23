<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class abpUrlConclusion extends Model
{
   
    protected $primaryKey = 'idUrlConclusion';
	protected $table = 'abp_urlconclusion';
    protected $fillable= [
           'fk_ideaConclusion',
           'url'
    ];

   
    public function ListarCategorias()
    {
     // return "hgoa";
     // return $this->hasMany('Estadia\Categorias','idTest');
   }
}
