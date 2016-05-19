<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbpPlanteamiento extends Model
{
   protected $table = 'abp_planteamientos';
    protected $primaryKey = 'idAbpPlanteamientos';
    protected $fillable= [
		       'Planteamiento',
           'fk_idAbp',
           'fk_idAlumno'
           
    ];
}
