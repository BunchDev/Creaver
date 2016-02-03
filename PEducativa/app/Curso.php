<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    
protected $table = 'curso';
protected $primaryKey = 'idCurso';



public function Comentarios()
    {
     // return "hgoa";
      return $this->hasMany('App\ComentarioPropuesta','fk_idPropuesta');
   }
}
