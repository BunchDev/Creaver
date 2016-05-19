<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbpConceptos extends Model
{
    protected $table = 'abp_conceptos';
    protected $primaryKey = 'idAbpConcepto';
    protected $fillable= [
		       'palabra',
           'concepto',
           'fuente',
           'fk_idAbp',
           'fk_idAlumno'
           
    ];
}
