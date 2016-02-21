<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Quotation;

class Curso extends Model
{
    
protected $table = 'curso';
protected $primaryKey = 'idCurso';



public function Comentarios($idPropuesta)
    {
     // return "hgoa";
    	$Comentarios = DB::table('comentario_propuesta')->where('fk_idPropuesta', '=', $idPropuesta)->get();

      return $Comentarios;
   }
}
