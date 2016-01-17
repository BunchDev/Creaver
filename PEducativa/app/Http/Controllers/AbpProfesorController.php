<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Request;
use App\Curso;


class AbpProfesorController extends Controller
{


public function show()
{
$data = Request::all();
$datos = array('nombre' => 'Inteligencia Artificial','id' =>0 );
return view('tecnicas/abp/abpProfesor')->with('datos',$datos);
}



}















?>