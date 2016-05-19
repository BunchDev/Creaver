<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\AbpConceptos;
use App\AbpPlanteamiento;
use App\AbplluviaIdeas;
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
            $NuevoAbpConcepto = new AbpConceptos;
            $NuevoAbpConcepto->palabra =$palabras[$i];
            $NuevoAbpConcepto->concepto =$definiciones[$i];;
            $NuevoAbpConcepto->fuente =$fuentes[$i];;
            $NuevoAbpConcepto->fk_idAbp =1;
            $NuevoAbpConcepto->fk_idAlumno =1;
            $NuevoAbpConcepto->save();
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
            $NuevoAbpPlanteamiento = new AbpPlanteamiento;
            $NuevoAbpPlanteamiento->Planteamiento =$planteamiento;
            $NuevoAbpPlanteamiento->fk_idAbp =1;
            $NuevoAbpPlanteamiento->fk_idAlumno =1;
            $NuevoAbpPlanteamiento->save();
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
            $NuevoAbpIdea = new AbplluviaIdeas;
            $NuevoAbpIdea->Ideas =$idea;
            $NuevoAbpIdea->fk_idAbp =1;
            $NuevoAbpIdea->fk_idAlumno =1;
            $NuevoAbpIdea->save();
        }


    }

    public function categorizacionCreate()
    {
        return view('tecnicas.abp.categorizacion_ideas.abpAlumnoCategorizacionCreator');
    }

       public function categorizacionStore()
    {
       /*
       el JSON llegará con una estructura igual al siguiente y con informacion similar
        "categorias" : {
                {'name' : 'categoria_x' , 'color' : '#fgr553', 'datas' : ['a','b','c'] },
                {'name' : 'categoria_y' , 'color' : '#h76544d', datas' : ['d','e','a'] }
            
            } 
        */
       
       $categorias = json_encode(Input::get('categorias'));
       echo $categorias;
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
       $estudio = Input::get('estudio');
       $fuente = Input::get('fuente');

       echo "Estudio : ".$estudio;
       echo "Fuente : ".$fuente;


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
