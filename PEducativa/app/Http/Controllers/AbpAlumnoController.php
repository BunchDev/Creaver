<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\AbpConceptos;

class AbpAlumnoController extends Controller
{
    
    public function show($id){

    	return view('tecnicas.abp.abpAlumnoShow');
    }
    public function conceptosShow($id){
    	return view('tecnicas.abp.abpAlumnoDefinicionConceptos');
    }

    public function conceptosStore(){
    	$palabras =Input::get('palabra');
    	$definiciones =Input::get('definicion');
    	$fuentes = Input::get('fuente');


    for ($i=0; $i < count($palabras) ; $i++) { 
   			echo "PALABRA : ".$palabras[$i];
   			echo "DEFINICION: ".$definiciones[$i];
            echo "FUENTE: ".$fuentes[$i];


    }
    //		AbpConceptos::create($palabra);
    	//	$abpConcepto->fk_idAbp = $id;
    	//	$abpConcepto->fk_idAlumno = 0;
    	//	$abpConcepto->palabra = $concepto->palabra;
    	//	$abpConcepto->concepto = $concepto->concepto;
    	//	$abpConcepto->fuente = $concepto->fuente;

   // }

    }

    public function planteamientoCreate($id){


       return view('tecnicas.abp.planteamiento.abpAlumnoPlanteamientoCreator');
    }

    public function planteamientoStore(){
        //$id= Input::get('id');
        $planteamientos = Input::get('planteamientos');
       // $planteamientos = json_encode($planteamientos);
        foreach ($planteamientos as $planteamiento) {
            echo "Planteamiento: ".$planteamiento;
        }


    }

    public function lluviaIdeasCreate()
    {
        return view('tecnicas.abp.lluvia_ideas.abpAlumnoLluviaCreator');
    }

    public function lluviaIdeasStore(){
        //$id= Input::get('id');
        $ideas = Input::get('ideas');
       // $planteamientos = json_encode($planteamientos);
        foreach ($ideas as $idea) {
            echo "Idea: ".$idea;
        }


    }

    public function categorizacionCreate()
    {
        return view('tecnicas.abp.categorizacion_ideas.abpAlumnoCategorizacionCreator');
    }

    public function metasCreate()
    {
        return view('tecnicas.abp.metas.abpAlumnoMetasCreator');
    }
    public function metasStore()
    {
         //$id= Input::get('id');
        $metas = Input::get('metas');
       // $planteamientos = json_encode($planteamientos);
        foreach ($metas as $meta) {
            echo "Meta: ".$meta."<br>";
        }

    }



    public function estudioCreate()
    {
        return view('tecnicas.abp.estudio_independiente.AbpAlumnoEstudioIndependienteCreator');
    }
    public function estudioStore()
    {
       


    }

    public function conclusionCreate()
    {
        return view('tecnicas.abp.conclusion.AbpAlumnoConclusionCreator');
    }
    public function conclusionStore()
    {
        echo "OK ";

        
    }


}
