<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbplluviaIdeas extends Model
{
    protected $table = 'abp_lluviaideas';
    protected $primaryKey = 'idAbplluviaIdeas';
    protected $fillable= [
		       'Ideas',
           'fk_idAbp',
           'fk_idAlumno'
           
    ];
}
