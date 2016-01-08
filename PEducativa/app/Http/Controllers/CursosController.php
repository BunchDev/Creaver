<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Request;


class CursosController extends Controller {

public function listarCursos()
{

	return view('profesor/cursos');
}


}



?>