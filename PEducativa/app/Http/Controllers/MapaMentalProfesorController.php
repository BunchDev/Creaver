<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Actividad;
use App\Resumen;
use App\MaterialResumen;
use FTP;
use File;
class ResumenProfesorController extends Controller
{

    
    public function index($id){
        
        
        $actividad = Actividad::find($id);
        
        $resumen = Resumen::where('fk_idActividad',$actividad->idActividad)->get()->first();

        if($actividad->status == 0) return $this->createViewer()->with('id',$resumen->idResumen)
                                            ->with('idCurso',$actividad->fk_idCurso);
        if($actividad->status == 1) return $this->show($resumen);

        
    }

    public function show($resumen)
    {

        $materiales = MaterialResumen::where('fk_idResumen',$resumen->idResumen)->get();
        return view('tecnicas.resumen.resumenProfesorShower')
                    ->with('datos',$resumen)
                    ->with('materiales',$materiales);
    }
    public function createViewer()
    {
        return view('tecnicas.resumen.resumenProfesorCreator');
    }

    public function store(Request $request)
    {
        $files_bool = false;
        $urls_bool = false;
        
        // Se obtienen todos los datos que nos manda el cliente
        $files = Input::file('archivos');
        $urls = Input::get('urls');
        $id = Input::get('id');
        $resumen = Resumen::find($id);
        $instruccion = Input::get('instruccion');
        $actividad = Actividad::find($resumen->fk_idActividad);
        /*Se guarda la informacion del RESUMEN */
        $resumen->instruccion = $instruccion;
        $resumen->save();
        
        /*Se verifica si la informacion de links o archivos viene vacío*/
        if(is_null($files) == false) $files_bool = true;
        if($urls != "[]") $urls_bool = true;
        /*Se guardan los archivos que el cliente manda por FTP */
        if($files_bool) {
            

            // Se suben los archivos al servidor ftp ...
            $mode = 'FTP_BINARY';
            $conexion = FTP::connection();
            $conexion->changeDir('materiales_resumen');
            $statusMD = $conexion->makeDir("material_".$id);
            $statusCD = $conexion->changeDir("material_".$id);
            //Hacemos el upload recorriendo cada uno de los archivos que nos manda el cliente
            
            foreach ($files as $file) {
                $fileRemote = $file->getClientOriginalName();
                $conexion->uploadFile($file,$fileRemote,$mode);
                
            }
            /*Se obtiene la lista de archivos que se ha almacenado en su carpeta de materiales*/
            $list_files = $conexion->getDirListing("",null);
           
            $PATHTML = "../../asset/resumen/".$id."/";

            foreach ($list_files as $url) {
                $material_resumen = new MaterialResumen();
                $material_resumen->fk_idResumen = $resumen->idResumen;
                $material_resumen->url = $PATHTML.$url;
                $material_resumen->tipo = 1;
                $material_resumen->icon = $this->getIconName(File::extension($url));
                $material_resumen->save();
            }

            $conexion->disconnect();


        }

        if($urls_bool){
        /*Se crean los modelos MaterialResumen para cada url añadida por el cliente*/    
            $urls = json_decode($urls);
            foreach ($urls as $url2) {
                $material_resumen = new MaterialResumen();
                $material_resumen->fk_idResumen = $resumen->idResumen;
                $material_resumen->url = $url2;
                $material_resumen->tipo = 2;
                $material_resumen->save();
            }
        }
        
     
    $actividad->status = 1;
    $actividad->save();         

    }




public function getIconName($extension)
{
    
    switch ($extension) {
        case 'jpg':
            return "fa fa-picture-o fa-3x";
            break;
        case 'png':
            return "fa fa-picture-o fa-3x";
            break;
        case 'gif':
            return "fa fa-picture-o fa-3x";
            break;
        case 'doc':
            return "fa fa-file-word-o fa-3x";
            break;
        case 'docx':
            return "fa fa-file-word-o fa-3x";
            break;
        case 'pdf':
            return "fa fa-file-pdf-o fa-3x";
            break;
        case 'xls':
            return "fa fa-file-excel-o fa-3x";
            break;
        case 'xlsx':
            return "fa fa-file-excel-o fa-3x";
            break;
        case 'mp4':
            return "fa fa-file-video-o fa-3x";
            break;
        case 'mov':
            return "fa fa-file-video-o fa-3x";
            break;
        case 'mp3':
            return "fa fa-music fa-3x";
            break;
        case 'mp4':
            return "fa fa-file-video-o fa-3x";
            break;
        case 'sql':
            return "fa fa-database fa-3x";
            break;
        case 'java':
            return "fa fa-code fa-3x";
            break;
        case 'c':
            return "fa fa-code fa-3x";
            break;
        case 'js':
            return "fa fa-code fa-3x";
            break;
        case 'cpp':
            return "fa fa-code fa-3x";
            break;
        case 'css':
            return "fa fa-css3 fa-3x";
            break;
        case 'py':
            return "fa fa-code fa-3x";
            break;
        case 'php':
            return "fa fa-code fa-3x";
            break;
        case 'html':
            return "fa fa-html5 fa-3x";
            break;
        case 'rar':
            return "fa fa-file-archive-o fa-3x";
            break;
        case 'zip':
            return "fa fa-file-archive-o fa-3x";
            break;
        case 'tar':
            return "fa fa-file-archive-o-o fa-3x";
            break;
        default:
            return "fa fa-file-o fa-3x";
            break;
    }
}








}
