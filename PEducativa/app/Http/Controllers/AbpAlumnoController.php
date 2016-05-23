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
        
         $ConceptosAbp=AbpConceptos::GetConceptos(1,1);
         
        if($ConceptosAbp === NULL) {
            return view('tecnicas.abp.abpAlumnoDefinicionConceptos');
        }
        else{
             //Forma de recorrer la variable <- comentado
           // foreach ($ConceptosAbp as $key) {
           // echo($key->palabra);
            //echo($key->concepto);
            // echo($key->fuente);
           
            //} 
         return view('tecnicas.abp.abpAlumnoDefinicionConceptos')->with('ConceptosAbp',$ConceptosAbp); 
        }	
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
    
    

    }

    public function planteamientoCreate($id){
        $PlanteamientosAbp=AbpPlanteamiento::GetPlanteamientos(1,1);
        
        if($PlanteamientosAbp === NULL) {
            return view('tecnicas.abp.planteamiento.abpAlumnoPlanteamientoCreator');
        }
        else{
        //Forma de recorrer la variable <- comentado
         //foreach ($PlanteamientosAbp as $key) {
           // echo($key->Planteamiento);
           //}
           return view('tecnicas.abp.planteamiento.abpAlumnoPlanteamientoCreator')->with('PlanteamientosAbp',$PlanteamientosAbp);
        } 
           
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
        $IdeasAbp=AbplluviaIdeas::GetIdeas(1,1);
        
         if($IdeasAbp === NULL) {
            return view('tecnicas.abp.lluvia_ideas.abpAlumnoLluviaCreator');
        }
        else{
        //Forma de recorrer la variable <- comentado
            //foreach ($IdeasAbp as $key) {
            //echo($key->Ideas);
           // }
      return view('tecnicas.abp.lluvia_ideas.abpAlumnoLluviaCreator')->with('IdeasAbp',$IdeasAbp);  
        }
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
$IdeasAbp=AbplluviaIdeas::GetIdeas(1,1);
        
         if($IdeasAbp === NULL) {
             return view('tecnicas.abp.categorizacion_ideas.abpAlumnoCategorizacionCreator');
        }
        else{
        //Forma de recorrer la variable <- comentado
            //foreach ($IdeasAbp as $key) {
            //echo($key->Ideas);
           // }
       return view('tecnicas.abp.categorizacion_ideas.abpAlumnoCategorizacionCreator')->with('IdeasAbp',$IdeasAbp);  
        }
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
