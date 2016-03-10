<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Abp;
use App\Actividad;
use App\PersonajesABP;
class AbpProfesorController extends Controller
{
    /**
     * Index get the value of the id Activity and return an edit view or complete view show
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $actividad = Actividad::find($id);
        if($actividad->status == 0) return $this->edit($actividad->idTecnica);
        if($actividad->status == 1) return $this->show($actividad->idTecnica);  
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
    public function show($id)
    {     
    $abp = Abp::find($id);
    $personajes = PersonajesABP::where('fk_idABP',$id)->get();
   	return view('tecnicas.abp.abpProfesorShow')->with('abp',$abp)->with('personajes',$personajes);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function edit($id)
    {
        /*Busco el objeto ABP relacionado a la actividad*/
        $abp = Abp::find($id);
        /*Obtengo todos los personajes relacionado a la actividad ABP*/
        $personajes = PersonajesABP::where('fk_idABP',$abp->idABP)->get();
        $actividad = Actividad::where('tipo_tecnica',1)
                        ->where('idTecnica',$abp->idABP)
                        ->get();
              
        $datos = array('nombre' => $actividad->first()->Nombre,'id' => $actividad->first()->idActividad);
        /*Mando a la vista todos los datos obtenidos para mostrarlos y realizar las modificaciones necesarias respeco al DOM*/
        return view('tecnicas/abp/abpProfesor')
                ->with('abp',$abp)
                ->with('datos',$datos)
                ->with('personajes',$personajes)
                ->with('cursoid',$actividad->first()->fk_idCurso);

    }

    /**
     * Update Actualiza los cambios ocurridos en la actividad.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request)
    {
          $input = Input::all();
          /* $inputPersonajes,$inputPersonajesEliminados : Obtengo todos los personajes tal y como quedaron en la vista y tambien los que se eliminaron
            para poder hacer las modificaciones en la BD 
          */
          $inputPersonajes = Input::get('Personajes');
          $inputPersonajesEliminados = Input::get('Eliminados');
          /*Recorro cada uno de los datos que obtengo de la vista por post*/
         if(isset($inputPersonajes)){ 
            foreach ($inputPersonajes as $personaje) {
                    /*Verifico si el personaje actual ya existe en caso que no crea un nuevo registro*/
                    $personajeabp = PersonajesABP::firstOrNew(array('Nombre' => $personaje,'fk_idABP' => $input['idAbp']));
                    $personajeabp->Nombre = $personaje;
                    $personajeabp->fk_idABP = $input['idAbp'];
                    $personajeabp->save();
                    }
         }
        /*Verifico si se han eliminado personajes en la actualizacion (vista), si sí se procede a 
          a la eliminación del registro mediante el id 
        */
        if(isset($inputPersonajesEliminados))
            foreach ($inputPersonajesEliminados as $id) 
                PersonajesABP::destroy($id);
                
         /*Actualizo los registros*/
         $abp = Abp::find($input['idAbp']);
         $abp->Contexto = $input['Contexto'];
         $abp->Problematica = $input['problematica'];
         $abp->save();
         /*Obtengo la actividad asociada al objeto ABP que se está trabajando y cambio el estatus de la misma*/
         $actividad = Actividad::where('tipo_tecnica',1)
                        ->where('idTecnica',$input['idAbp'])
                        ->select(array('idActividad', 'status','fk_idCurso'))
                        ->get();
         if(isset($input['Contexto']) && isset($input['problematica']) && isset($inputPersonajes) )  $actividad->first()->status = 1;
         else $actividad->first()->status = 0;

         $actividad->first()->save();
         return redirect('./irCurso/'.$actividad->first()->fk_idCurso);
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
