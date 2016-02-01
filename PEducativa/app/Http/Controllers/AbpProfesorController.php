<?php

namespace App\Http\Controllers;


use Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Abp;
use App\Actividad;
class AbpProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $input = Input::all();
          $inputPersonajes = Input::get('Personajes');
          $Abp= Abp::create($input);
          $Abp->AgregarPersonajes($inputPersonajes,$Abp->idABP);
          return redirect('actividad/abp');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {     
		$data = Request::all();
		
       // $actividad = Actividad::where('idActividad',$data->idActividad)->get();
        $datos = array('nombre' => 'Inteligencia Artificial','id' =>0);
                //$datos = array('nombre' => $actividad->Nombre,'id' =>$data->idActividad);

		return view('tecnicas/abp/abpProfesor')->with('datos',$datos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
