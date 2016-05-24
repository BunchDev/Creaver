var items_conceptos = 3;
var items_planteamientos = 3;
var items_ideas = 3;
var items_metas = 3;
/* ##### Es la funcion que se ejecuta cuando el index de abp se manda a llamar ##### */
function init(){

    $pasos = $('.pasos');
    $percentage = null;
    /* ----------------------------------------------   */
    /* Configura las posiciones a la izquierda de acada elemento por porcentaje y conecta con el siguiente div hermano*/
    $.each($pasos,function(key,value)
    {
        $percentage = Math.floor((Math.random() * 80) + 1);
        
        $(value).css('left', + $percentage+'%');
        
        if(key > 0)
        {

             $(value).connections(
             {
                to: $($pasos[key-1]),
                //agrega algunos estilos para el borde de las conexiones
                css:    {
                            border: 'solid 10px #44B4D5',
                            'border-radius': '30px'
                        }

             });

        }
       
    });


    /* ------------------------------------------------------*/
    /*Cambia las posiciones de los divs cuando la pantalla cambia de tamaño y actualiza las conecciones*/
   
    $(window).resize(function()
    {
        

        $.each($pasos,function(key,value){
            $percentage = Math.floor((Math.random() * 80) + 1);
            $(value).css('left', + $percentage+'%');
     
       
        });

        $pasos.connections('update');
    });
    /* ----------------------------------------------  */


}

//agrega un nuevo formulario para agregar palabra-concepto-fuente

function addDefinitionForm()
{
    
        
        formp = $(getFormPalabra());
        $("#forms_conceptos").append(formp);
        //inserta una animacion usa magic.css
        formp.addClass('magictime spaceInDown');
        $("#sec_"+items_conceptos).find("select").selectpicker();

   
	
}
function addForm(){
    addDefinitionForm();
}
//va al paso que se le indique
function goStep(step,id=1){
    switch(step)
    {
        case 1: window.location.assign("./defconceptos/"+id);
        break;
        case 2: window.location.assign("./planteamiento/"+id);
        break;
        case 3: window.location.assign("./ideas/"+id);
        break;
        case 4: window.location.assign("./categorizacion");
        break;
        case 5: window.location.assign("./metas");
        break;
        case 6: window.location.assign("./estudio");
        break;
        case 7: window.location.assign("./conclusion");
        break;
    }

	
}
//valida y llama a la funcion que envía los conceptos al servidor
function prepareConceptos()
{
 if (validateInputsForm()) return;

sendConceptos();
    
}
//envia los conceptos al servidor mediante ajax
function sendConceptos()
{

	form_data = new FormData();  
	palabras = document.getElementsByClassName('palabra'); 
	definiciones = document.getElementsByClassName('definicion'); 
	fuentes = document.getElementsByClassName('fuente'); 
            // itera las palabras,definicion y fuentes para agregarlas al form_data
          for (var i = 0; i < palabras.length; i++) { 
          	form_data.append('palabra[]',palabras.item(i).value);
          	form_data.append('definicion[]',definiciones.item(i).value);
            form_data.append('fuente[]',$(fuentes.item(i)).html());
            
          }
  
	    $.ajax({

    	
    	url:'../addConceptos',
    	data: form_data,
        processData: false,
        contentType: false,
        type: 'POST',
        dataType:'text',

    	success: function(data){
    	
    	 swal({   title: '¡Correcto!',  
        text: 'Los conceptos se enviaron correctamente y el profesor las revisará en la fecha asignada',  
         type: 'success',   
         showCancelButton: false,   
         confirmButtonColor: '#3085d6', 
          confirmButtonText: 'Ok',   
          closeOnConfirm: true },
        function() {   
            //regresa al main de los pasos abp
        	window.location.assign("../1");
         });
    	},
    	error: function(excpetion)
    	{
    		   swal({  
                  title: '<i class="fa fa-frown-o fa-4x"></i>', 
                  text: "<h2>¡Ups!,Ocurrió un error, intenta de nuevo más tarde</h2>", 
                  html: true 
                });
    	}


    	});


}
// aumenta el contador conceptos y regresa el código html del formulario.
function getFormPalabra(){
   items_conceptos+=1;
   return ' <div class="row concept-box" id="sec_'+items_conceptos+'"> '+
   '<button type="button" class="close" onClick="removeForm(this)">x</button>'+

    '<div class="col-md-7">'+
      '<div class="form-inline pform">'+
        '<label for="palabra">Palabra</label>'+
        '<input type="text" class="palabra form-control">'+
        '<textarea rows="4" style="width: 50%;" class="definicion form-control" placeholder="Escribe la definición aquí"></textarea>'+
      '</div>'+
    '</div>'+

    '<div class="col-md-4">'+

      '<div class="row">'+

       '<div class="col-md-9">'+
          '<label for="fuente">Fuente</label>'+
          '<div class="fuente form-control"></div>'+
        '</div>'+
        '<div class="col-md-3">'+
          '<div class="round-button rbfuente"><div class="round-button-circle btn-primary"><a data-toggle="modal" data-target="#modal_'+items_conceptos+'" class="round-button"><i class="fa fa-pencil"></i></a></div></div>'+
        '</div>'+
      '</div>'+
    '</div>'+

  '<div id="modal_'+items_conceptos+'" class="modal fade" role="dialog">'+
    '<input type="hidden" class="type_apa" value="">'+
    '<div class="modal-dialog">'+

      '<div class="modal-content">'+
        '<div class="modal-header">'+
          '<button type="button" class="close" data-dismiss="modal">&times;</button>'+
          '<h4 class="modal-title">FORMATO APA</h4>'+
          '<select class="selectpicker"  data-style="btn-primary" onchange="getModalBody('+items_conceptos+')" title="¿Que quieres citar?">'+
            '<option data-content="<i class=\'fa fa-book\' aria-hidden=\'true\'></i> Libro Electrónico">libro</option>'+
            '<option data-content="<i class=\'fa fa-sticky-note-o\' aria-hidden=\'true\'></i>'+
                'Revista Científica Electrónica">revista</option>'+
            '<option data-content="<i class=\'fa fa-globe\' aria-hidden=\'true\'></i> Página Web" >web</option>'+
         
          '</select>'+
        '</div>'+
     
        '<div class="modal-body">'+
         
        '</div>'+
        '<div class="modal-footer">'+
         '<button type="button" class="btn btn-success" onClick="makeFormat('+items_conceptos+')">Guardar</button>'+
          '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>'+
        '</div>'+
  
      '</div>'+

    '</div>'+
  '</div>'+

  '</div>';
  
}
//retorna codigo html para agregar una fuente de libro
function getApaLibro()
{
	
return '<div id="apa_libro"> '+
'<div class="form-group">'+
    '<label for="papellido">Primer apellido del autor</label>'+
    '<input type="text" id="papellido" class="form-control" placeholder="Primer Apellido" required>'+
'</div>'+
'<div class="form-group">'+
    '<label for="inautor">Inicial del nombre del autor</label>'+
    '<input type="text" id="inautor" class="form-control" placeholder="Inicial" required>'+
'</div>'+
'<div class="form-group">'+
    '<label for="anio">Año de publicación del libro</label>'+
    '<input type="text" id="anio" class="form-control" placeholder="Año" required>'+
'</div>'+
'<div class="form-group">'+
    '<label for="tlibro">Titulo del Libro</label>'+
    '<input type="text" id="tlibro" class="form-control" placeholder="Titulo" required>'+
'</div>'+
'<div class="form-group">'+
    '<label for="ciudad">Ciudad</label>'+
    '<input type="text" id="ciudad" class="form-control" placeholder="Ciudad" required>'+
'</div>'+
'<div class="form-group">'+
    '<label for="pais">Pais</label>'+
    '<input type="text" id="pais" class="form-control" placeholder="Pais" required>'+
'</div>'+
'<div class="form-group">'+
    '<label for="editorial">Editorial</label>'+
    '<input type="text" id="editorial" class="form-control" placeholder="Editorial" required>'+
'</div>'+

'</div>';

}

//retorna codigo html para agregar formulario de revista eletrónica APA
function getApaRevistaElectronica()
{
	

str = '<div id="apa_revista">'+
'<div class="form-group">'+
'   <button type="button" id ="ayuda" class="btn btn-raised btn-info btn-xs" '+
   '       rel="popover" '+
    '      data-placement="top" data-content="autor o autores (escribiendo sólo el apellido paterno y luego las iniciales de sus nombres propios), ejemplo: Gunawardena, C., Lowe, C. y Anderson, T "> '+
    '      <i class="fa fa-question-circle fa-2x"></i> '+
'  </button>' +
    '<label for="autor">Autor o autores</label>'+
    '<input type="text" id="autor" class="form-control" placeholder="Primer apellido paterno,Inicial del nombre. Ejemplo : Gunawardena, C., Lowe, C. y Anderson, T" required>'+
'</div>'+
'<div class="form-group">'+
    '<label for="anio">Año de publicación</label>'+
    '<input type="text" id="anio" class="form-control" placeholder="Año de publicación" required>'+
'</div>'+
'<div class="form-group">'+
    '<label for="tarticulo">Título del articulo</label>'+
    '<input type="text" id="tarticulo" class="form-control" placeholder="Título del articulo" required>'+
'</div>'+
'<div class="form-group">'+
    '<label for="nrevista">Nombre de la revista</label>'+
    '<input type="text" id="nrevista" class="form-control" placeholder="Nombre de la revista" required>'+
'</div>'+
'<div class="form-group">'+
    '<label for="volumen">Volumen</label>'+
    '<input type="text" id="volumen" class="form-control" placeholder="Volumen" required>'+
'</div>'+
'<div class="form-group">'+
    '<label for="numero">Número</label>'+
    '<input type="numero" id="autor" class="form-control" placeholder="Número de la revista" required>' +
'</div>'+
'<div class="form-group">'+
    '<label for="paginas">Páginas</label>'+
    '<input type="text" id="paginas" class="form-control" placeholder="Las páginas donde se encuentre el articulo" required>'+
'</div>'+
'<div class="form-group">'+
    '<label for="url">URL</label>'+
    '<input type="text" id="url" class="form-control" placeholder="URL donde fue recuperado el artículo" required>'+
'</div>'+

'</div>';

return str;

}

//retorna código html para agregar formulario de Página Web en formato APA
function getApaPaginaWeb(){

return 	'<div id="apa_pweb">'+
'<div class="form-group">'+
    '<label for="apellido">Apellido del Autor</label>'+
    '<input type="text" id="apellido" class="form-control" placeholder="Apellido del autor" required>'+
'</div>'+

'<div class="form-group">'+
    '<label for="url">Nombre del autor abreviado</label>'+
    '<input type="text" id="url" class="form-control" placeholder="Nombre del autor abreviado" required>'+
'</div>'+
'<div class="form-group">'+
    '<label for="anio">Año de publicación</label>'+
    '<input type="text" id="anio" class="form-control" placeholder="Si se desconoce el año dejar vacío" required>'+
'</div>'+
'<div class="form-group">'+
    '<label for="titulo">Titulo</label>'+
    '<input type="text" id="titulo" class="form-control" placeholder="Titulo" required>'+
'</div>'+
'<div class="form-group">'+
    '<label for="titulopw">Titulo de la página web</label>'+
    '<input type="text" id="titulopw" class="form-control" placeholder="Titulo de la página web" required>'+
'</div>'+
'<div class="form-group">'+
    '<label for="url">URL</label>'+
    '<input type="text" id="url" class="form-control" placeholder="URL donde se localiza el articulo" required>'+
'</div>'+
'</div>';



}

/*
* valida inputs usando la librería JQBvalidator.js
*@param element - elemento del DOM al cual se obtiene sus inputs y validarlos
*@param opt - contiene las reglas de validación de algún input en particular 
            estructura -> {[0]->{regla1},[1]->{regla2}}
*@return flag - booleano que se inicializa en false y cambia a true si existe algún elemento que no 
                cumple con las reglas 
*/
function settingJQB(element,opt)
{
   
    inputs = element.find("input");
    flag = false;

    $.each(inputs,function(key,value){
      JQB = undefined;
      if(key in opt)
        {
      JQB =   $(value).JQBConfig(opt[key]);

        }
    else{
      JQB =   $(value).JQBConfig({

                required : true,
                maxLen : 255,
                minLen : 1,
                messageError: "Este campo es requerido",
                messageSuccess: ""

         });
  }
      if( JQB.validateInputText() == false) flag = true;

    });

return flag;
}

function fillFormApa(id,t_apa){

    $fuente = $("#sec_"+id).find('.fuente');
    if($fuente.text() == '' || t_apa !=$fuente.find('input').val()) return;

            $body =  $("#modal_"+id).find(".modal-body");
           $body_inputs = $body.find('input');
           
           $.each( $fuente.find('.realv'),function(key,value){
                $($body_inputs[key]).val($(value).text());
            });

}


/*
* inserta en el body del modal el formulario correspondiente elegido en el form mediante el select
*@param id -  
*/
function getModalBody(id){
    var selectBox = $("#modal_"+id).find("select");
    var tipo = selectBox.val();
    console.log("TIPO = " + tipo);
    //mbody : almacena el modal body para luego modificar su contenido
    $mbody = $("#modal_"+id).find(".modal-body");


	switch(tipo){
		case 'web':{
                
                $mbody = $("#modal_"+id).find(".modal-body");
                $mbody.empty();
                $mbody.append(getApaPaginaWeb());
                $("#modal_"+id).find(".type_apa").val("web");
                    }
            break;
		case 'libro': {
                        $mbody.empty();
                        $mbody.append(getApaLibro());
                        $("#modal_"+id).find(".type_apa").val("libro");
                        }
			break;
		case 'revista':{
                    $mbody.empty();
                    $mbody.append(getApaRevistaElectronica());
                    $("#modal_"+id).find(".type_apa").val("revista");

                    $('button[rel="popover"]').popover({  offset: 50,placement: 'top'});
    
                        }
		    break;
	}

    fillFormApa(id,tipo);

}

function makeFormat (id) {
	$div = $("#sec_"+id).find(".fuente");
    format = $("#modal_"+id).find(".type_apa").val();
    configs = {};
  
    if(format  == "web"){
       
        configs[2] = {

                required : false,
                maxLen : 255,
                minLen : 0,
                messageError: "Este campo es requerido",
                messageSuccess: ""

         };

    }

    if( settingJQB($("#modal_"+id).find(".modal-body") , configs )) return;
    
    
    switch(format){
        case 'web':{
                        $("#sec_"+id).find(".fuente").empty();
                        inputs = $("#modal_"+id).find(".modal-body").find('input');
                        $("#sec_"+id).find(".fuente").append(getFormatWP(inputs));
                        $("#sec_"+id).find(".fuente").find('input').val('web');
                        console.log( $("#sec_"+id).find(".fuente").find('input').val() );
                    }
            break;
        case 'libro': {
                        $("#sec_"+id).find(".fuente").empty();
                        inputs = $("#modal_"+id).find(".modal-body").find('input');
                        $("#sec_"+id).find(".fuente").append(getFormatEB(inputs));
                        $("#sec_"+id).find(".fuente").find('input').val('libro');
                        
                        }
            break;
        case 'revista':{
                        $("#sec_"+id).find(".fuente").empty();
                        inputs = $("#modal_"+id).find(".modal-body").find('input');
                        $("#sec_"+id).find(".fuente").append(getFormatEM(inputs));
                        $("#sec_"+id).find(".fuente").find('input').val('revista');
                        }
        break;

        default : {
            console.log("DEFAULT = " + format);
        }
    }


	
}
/*get format of ELECTRONIC BOOK*/
function getFormatEB(inputs)
{
    str = "<input type='hidden' value=''>";
    //primer apellido del autor
    str+= '<div class="realv">' +filterxss($(inputs[0]).val() ) +'</div>';
    str+='<div>,</div>';
        //inicial del nombre del autor
    str+= '<div class="realv">' +filterxss($(inputs[1]).val() ) +'</div>';
    str+= '<div>.(</div>';
    //año e publicación
   
    str+='<div class="realv">' +filterxss( $(inputs[2]).val() ) +'</div>';
    str+='<div>).</div>';
   
    //titulo del libro en italicas
    str+= '<div class="realv">' +'<i>'+filterxss( $(inputs[3]).val() ) + '</i>'+'</div>';
    str+='<div>.</div>';
    
    //ciudad
    str+= '<div class="realv">'+ filterxss( $(inputs[4]).val() ) +'</div>';
    str+='<div>,</div>';
    
    //pais
    str+='<div class="realv">'+ filterxss( $(inputs[5]).val() )+'</div>';
    str+='<div>:</div>';
    
    //editorial
    str+= '<div class="realv">'+filterxss( $(inputs[6]).val() )+'</div>';

  return str;
}
/*get format of ELECTRONIC MAGAZINE*/
function getFormatEM(inputs)
{
    str= "<input type='hidden' value=''>";
    //autor o autores
    str+= '<div class="realv">' +filterxss($(inputs[0]).val() ) +'<div>,</div></div>';
   
    //año de la publicacion
    str+='<div class="realv">' +'(' +filterxss( $(inputs[1]).val() ) + '<div>),</div>' +'</div>';
   
    //titulo del articulo
    str+= '<div class="realv">' +filterxss($(inputs[2]).val()) +'<div>,</div></div>';
    
    //nombre de la revista
    str+='<div class="realv">' +'<i>' + filterxss( $(inputs[3]).val() )  + '<div>,</div></i>'+'</div>';
  
    //volumen
    str+='<div class="realv">'+'<i>' + filterxss( $(inputs[4]).val() )+'</i>'+'</div>';
    //numero de la revista
    str+='<div class="realv">'+'<i>(' +filterxss( $(inputs[5]).val() )+ '<div>),</div></i>'+'</div>';
   
    //paginas 
    str+= '<div class="realv">'+'<i>' +filterxss( $(inputs[6]).val() ) + '<div>.</div></i>'+'</div>';
   
    str+= '<div>' +'<i>Recuperado de: </i>' +'</div>';
    str+='<div class="realv">'+'<a>' + filterxss($(inputs[7]).val() ) +  '</a>' +'</div>';


return str;
}
/*get format of WEB PAGE*/
function getFormatWP(inputs)
{

    str = "<input type='hidden' value=''>";
    //apellido del autor
    str+= '<div class="realv">'+filterxss( $(inputs[0]).val() ) + '</div>';
    str+='<div>,</div>';

    
    //Inicial del nombre
    str+= '<div class="realv">' +filterxss($(inputs[1]).val())+'</div>';
    str+='<div>.</div>';
  
    //año de publicación
    str+='<div>(</div>';
    str+= '<div class="realv">'+ ( ($(inputs[2]).val() == undefined) ? 's.f.':  filterxss( $(inputs[2]).val() ) ) + '</div>';
    str+='<div>).</div>';
    //titulo
    str+= '<div class="realv">'+filterxss( $(inputs[3]).val() )+'</div>';
    str+='<div>.</div>';
    //titulo de la página web
    str+='<div class="realv">'+ '<i>' + filterxss( $(inputs[4]).val() )+ '</i>'+'</div>';
    str+='<div>.Recuperado de: </div>';
    //recuperdado de 
    str+= '<div class="realv">'+ filterxss( $(inputs[5]).val() ) +'</div>';

    return str;

}


function removeForm(element,opt=2){

    switch(opt){
        case 1:{
           
            if($(element).parent().find('ol').find('li').children().length > 0){
                $(element).parent().popover({
                
                    animation: true,
                    content: "No se puede eliminar una categoría con elementos",
                    html: false
                                    
                                    });

                

                break;
            }
           else{
            $(element).parent().popover('destroy');
           }
        }
        case 2: {
            swal({   title: "¿Estás seguro de eliminar esta categoría?",  
            text: "",  
            type: "warning",   
            showCancelButton: true, 
            cancelButtonText: "Cancelar",  
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Si,quiero borrarlo",  
            closeOnConfirm: false }, 
            function(){
            //$(element).parent().siblings('.popover').remove(); 
            $(element).parent().remove();
            if(opt == 1) $grid.masonry('layout');

            swal({
                title: "<i class='fa fa-trash fa-4x fa-vertical' aria-hidden='true'></i>",
                text : "Eliminado",
                html : true,
                timer: 1000,
                showConfirmButton: false
            }); 
        });
        }
        break;
    }


    

}
/*
*@param nftext texto sin filtrar del <div class="fuente"/>
*/
function filterxss(nftext){
    fakediv = $("<div></div>");
    fakediv.append("<a></a>");
    fakediv.find('a').append(nftext);
    return fakediv.text();
}

function validateInputsForm()
{

flag = false;

$palabras       =   $(".palabra");
$definiciones   =   $(".definicion");
$fuentes        =   $(".fuente"); 
console.log("entro" + $palabras);
config = {

                required : true,
                maxLen : 255,
                minLen : 1,
                messageError: "Este campo es requerido",
                messageSuccess: ""

         }

$.each($palabras,function(key,value)
{
    console.log("valor: "+value);

    jqbpalabra      =   $($palabras[key]).JQBConfig(config); 
    jqbdefinicion   =   $($definiciones[key]).JQBConfig(config);
    jqbfuente       =   $($fuentes[key]).JQBConfig(config);
        

   
    if( jqbpalabra.validateInputText() == false) flag = true;
    if( jqbdefinicion.validateInputText() == false) flag = true;
    if( jqbfuente.validateDivText() == false) flag = true;


});

return flag;
}


/*----------- PASO 2.- PLANTEAMIENTOS --------------*/

function getPlanteamientoForm(){
    items_planteamientos++;
   return  '<div class="planteamiento_form form-group">' +
   '<button type="button" class="close" onClick="removeForm(this)">x</button>'+
    '<div class="row">'+
        '<div class="col-xs-3 col-sm-1">'+
            '<div class="counter magictime tinUpIn">'+items_planteamientos+'</div>'+
        '</div>'+

        '<div class="col-md-6">'+
            '<textarea row="6" placeholder="Escribe aquí tu planteamiento" class="planteamiento form-control"></textarea>'+
        '</div>'+
    '</div>'+
'</div>';
}

function addPlanteamientoForm()
{
    formp = $(getPlanteamientoForm());
    $("#planteamiento_container").append(formp);
    formp.addClass("magictime tinUpIn");
}

function sendPlanteamientos()
{
    if(validateInputsFormPlanteamiento()) return;
    form_data = new FormData();  
    $planteamientos = $(".planteamiento");
    
    $.each($planteamientos,function(key,$planteamiento){
        form_data.append('planteamientos[]',$($planteamiento).val());
    });
        
           
  
    $.ajax({

        
        url:'../addPlanteamientos',
        data: form_data,
        processData: false,
        contentType: false,
        type: 'POST',
        dataType:'text',

        success: function(data){
        
         swal({   title: '¡Correcto!',  
        text: 'Los planteamientos se enviaron correctamente y el profesor las revisará en la fecha asignada',  
         type: 'success',   
         showCancelButton: false,   
         confirmButtonColor: '#3085d6', 
          confirmButtonText: 'Ok',   
          closeOnConfirm: true },
        function() {   

            window.location.assign("../1");
         });
        },
        error: function(excpetion)
        {
               swal({  
                  title: '<i class="fa fa-frown-o fa-4x"></i>', 
                  text: "<h2>¡Ups!,Ocurrió un error, intenta de nuevo más tarde</h2>", 
                  html: true 
                });
        }


        });



}

function validateInputsFormPlanteamiento()
{

flag = false;

$planteamientos  =   $(".planteamiento");

config = {

                required : true,
                maxLen : 255,
                minLen : 1,
                messageError: "No has escrito un planteamiento",
                messageSuccess: ""

         }

$.each($planteamientos,function(key,$planteamiento)
{

    jqbplanteamiento      =   $($planteamiento).JQBConfig(config); 
    
    if( jqbplanteamiento.validateInputText() == false) flag = true;
  
});

return flag;
}

/*----------- PASO 3.- LLUVIA DE IDEAS --------------*/

function getIdeaForm(){
    items_ideas++;
   return  '<div class="lluvia_form form-group">' +
   '<button type="button" class="close" onClick="removeForm(this)">x</button>'+
    '<div class="row">'+
        '<div class="col-xs-3 col-sm-1">'+
            '<div class="counter magictime tinUpIn">'+items_ideas+'</div>'+
        '</div>'+

        '<div class="col-md-6">'+
            '<textarea row="6" placeholder="Escribe aquí la idea" class="idea form-control"></textarea>'+
        '</div>'+
    '</div>'+
'</div>';
}

function addIdeaForm()
{
    formp = $(getIdeaForm());
    $("#lluvia_container").append(formp);
    formp.addClass("magictime tinUpIn");
}

function sendIdeas()
{
    if(validateInputsFormIdeas()) return;
    form_data = new FormData();  
    $ideas = $(".idea");
    
    $.each($ideas,function(key,$idea){
        form_data.append('ideas[]',$($idea).val());
    });
        
           
  
    $.ajax({

        
        url:'../addIdeas',
        data: form_data,
        processData: false,
        contentType: false,
        type: 'POST',
        dataType:'text',

        success: function(data){
        
         swal({   title: '¡Correcto!',  
        text: 'La lluvia de idea se envió correctamente y el profesor las revisará en la fecha asignada',  
         type: 'success',   
         showCancelButton: false,   
         confirmButtonColor: '#3085d6', 
          confirmButtonText: 'Ok',   
          closeOnConfirm: true },
        function() {   

            window.location.assign("../1");
         });
        },
        error: function(excpetion)
        {
               swal({  
                  title: '<i class="fa fa-frown-o fa-4x"></i>', 
                  text: "<h2>¡Ups!,Ocurrió un error, intenta de nuevo más tarde</h2>", 
                  html: true 
                });
        }


        });



}

function validateInputsFormIdeas()
{

flag = false;

$ideas  =   $(".idea");

config = {

                required : true,
                maxLen : 255,
                minLen : 1,
                messageError: "No has escrito la idea",
                messageSuccess: ""

         }

$.each($ideas,function(key,$idea)
{

    jqbidea     =   $($idea).JQBConfig(config); 
    
    if( jqbidea.validateInputText() == false) flag = true;
  
});

return flag;
}


/*----------------- PASO 4 .- CATEGORIZACIÓN DE IDEAS -------------------*/

function hexc(colorval) {
    var parts = colorval.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    delete(parts[0]);
    for (var i = 1; i <= 3; ++i) {
        parts[i] = parseInt(parts[i]).toString(16);
        if (parts[i].length == 1) parts[i] = '0' + parts[i];
    }
    return '#' + parts.join('');
}

var $grid;
$(function  () {

  configDragable();
//masonry
    $grid = $('.grid').masonry({
   itemSelector: '.grid-item',
        isFitWidth: true,
        columnWidth: 60,
        containerStyle: { position: 'relative' }
});
//sortable


});
function configDragable()
{
    var adjustment;
    $("ol.ideas-dragger").sortable({
  group: 'ideas-dragger',
  pullPlaceholder: true,
  // animation on drop
  onDrop: function  ($item, container, _super) {

    var $clonedItem = $('<li/>').css({height: 0});
    $item.before($clonedItem);
    $clonedItem.animate({'height': $item.height()});
    // cuando la transición se termine de hacer se re-acomodan los elementos grid-item del DOM
    $.when($item.animate($clonedItem.position(), function  () {
      $clonedItem.detach();
      _super($item, container);
    })).done(function(){
        $grid.masonry('layout');
    });
    
  },

  // set $item relative to cursor position
  onDragStart: function ($item, container, _super) {
    var offset = $item.offset(),
        pointer = container.rootGroup.pointer;

    adjustment = {
      left: pointer.left - offset.left,
      top: pointer.top - offset.top
    };

    _super($item, container);
    $grid.masonry('layout');
  },
  onDrag: function ($item, position) {
    $item.css({
      left: position.left - adjustment.left,
      top: position.top - adjustment.top
    });
    $grid.masonry('layout');
  }
});

}
function requestNewCategory()
{
    swal({  
     title: "Nueva Categoría",   
     text: "Escribe el nombre de la categoría:",  
     type: "input",   
     showCancelButton: true,   
     closeOnConfirm: false,   
     animation: "slide-from-top",   
     inputPlaceholder: "Nombre de la categoría"

      }, 
      function(inputValue){   
        if (inputValue === false) return false;      
        if (inputValue === "") {    
         swal.showInputError("¡Necesitas escribir el nombre!");     
         return false   
         }     
     swal("¡Bien!", "Se agregó la categoría : " + inputValue, "success"); 
     addCategory(inputValue);

        });

}

//agrega un field para categorizar las ideas
var categories = 0;
function setCategoriesCounter()
{
    items = $('.grid-item');
    $.each(items,function(key,value){

        categories++;
    });
}
function addCategory(name)
{


griditem   =   $("<div id='"+categories+"'></div>").addClass('grid-item');
$close      =   $('<button type="button" class="close close_box" onClick="removeForm(this,1)">x</button>');
$color      =   $('<div class="colorSelector"><div style="background-color: #0000ff"></div></div>');
$name       =   $('<h4>'+name+'</h4>');
$header     =   $("<div class='header'></div>")


ol          =   $("<ol class='ideas-dragger' ></ol>");
griditem.append($close);



/*Appends elements into $griditem for show in DOM*/

$header.append($name);
griditem.append($color);
griditem.append($header);
griditem.append(ol);

$grid.append( this.griditem )
    // add and lay out newly appended items
    .masonry( 'appended', this.griditem );

$grid.masonry('layout');


/* Setups of elemts using own and external plugins*/
$name.editable();


configColorPicker($color,griditem);
configDragable();


}

function configColorPicker(color,griditem)
{
    color.ColorPicker({
    color: '#0000ff',
    onShow: function (colpkr) {
        $(colpkr).fadeIn(500);
        return false;
    },
    onHide: function (colpkr) {
        $(colpkr).fadeOut(500);
        return false;
    },
    onChange: function (hsb, hex, rgb) {
        /*when picker has change of color the $color element finds him child element for change
        * him color and also change the $gridelement color
        */
        color.find('div').css('backgroundColor', '#' + hex);
        griditem.css('backgroundColor', '#' + hex);
    }
});
}

function sendCategorizaciones()
{


    $items = $('.grid-item');
    //crea el json que se va enviar al server
    $categorias = {'categorias' : [] };
    //recorre cada una de las categorias
    $.each($items,function(key,value){

        $nombre = $(value).find('h4').text();
        //convierte el balor del background a hexadecimal
        $color = hexc($(value).css('backgroundColor'));
        $categoria = {'name' : $nombre ,'color' : $color,  'datas' : [] };
        $tags = $(value).find('ol').children();
        //recorre las etiquetas de cada categoría y las agrega al json
        $.each($tags,function(keyol,valueol){
            $categoria.datas.push($(valueol).text());
        });

        $categorias.categorias.push($categoria);
    });

    $.ajax({

        type : 'post',
        data: $categorias,

        success: function(response){
            window.location.assign('./1');
        },
        error : function(exception){
            swal({
                title : 'error',
                text : 'Ocurrió un error al enviar los datos intenta de nuevo',
                type : 'error',
                closeOnConfirm : true
            });
            console.log(exception);
        }


    });

}




/* ------------- PASO 5 .- METAS DE APRENDIZAJE -------------------*/

function sendMetas()
{
    if(validateInputsFormMetas()) return;
    form_data = new FormData();  
    $metas = $(".meta");
    
    $.each($metas,function(key,$idea){
        form_data.append('metas[]',$($metas).val());
    });
        
           
  
    $.ajax({

        
        url:'metas',
        data: form_data,
        processData: false,
        contentType: false,
        type: 'POST',
        dataType:'text',

        success: function(data){
        
         swal({   title: '¡Correcto!',  
        text: 'Las metas de aprendizaje se enviaron correctamente y el profesor las revisará en la fecha asignada',  
         type: 'success',   
         showCancelButton: false,   
         confirmButtonColor: '#3085d6', 
          confirmButtonText: 'Ok',   
          closeOnConfirm: true },
        function() {   

            window.location.assign("./1");
         });
        },
        error: function(excpetion)
        {
               swal({  
                  title: '<i class="fa fa-frown-o fa-4x"></i>', 
                  text: "<h2>¡Ups!,Ocurrió un error, intenta de nuevo más tarde</h2>", 
                  html: true 
                });
        }


        });



}

function validateInputsFormMetas()
{

flag = false;

$metas  =   $(".meta");

config = {

                required : true,
                maxLen : 255,
                minLen : 1,
                messageError: "No has escrito una meta de aprendizaje",
                messageSuccess: ""

         }

$.each($metas,function(key,$meta)
{

    jqbmeta     =   $($meta).JQBConfig(config); 
    
    if( jqbmeta.validateInputText() == false) flag = true;
  
});

return flag;
}

function addMetaForm()
{
    formp = $(getMetaForm());
    $("#metas_container").append(formp);
    formp.addClass("magictime tinUpIn");
}

function getMetaForm(){
    items_metas++;
   return  '<div class="metas_form form-group">' +
   '<button type="button" class="close" onClick="removeForm(this)">x</button>'+
    '<div class="row">'+
        '<div class="col-xs-3 col-sm-1">'+
            '<div class="counter magictime tinUpIn">'+items_metas+'</div>'+
        '</div>'+

        '<div class="col-md-6">'+
            '<textarea row="6" placeholder="Escribe aquí la meta de aprendizaje" class="meta form-control"></textarea>'+
        '</div>'+
    '</div>'+
'</div>';
}


function show(idCk,pasostr)
{
     var texto = CKEDITOR.instances[idCk].getData();

    $("#shower").empty();
    $("#shower").append(texto);
    checkEiContent(pasostr);

}

function checkEiContent(pasostr){
 
     if($("#shower").text() != '')
        $("#display").text('Editar '+pasostr);
    else 
        $("#display").text('Redactar '+pasostr);

}

/* ---------------- PASO 6 .- ESTUDIO INDEPENDIENTE --------------*/

 function sendEstudioIndependiente(){
 $estudio = $('#shower');
 $fuente = $('.fuente');

 $form_data = new FormData();

 $form_data.append('estudio', $estudio.html());
 $form_data.append('fuente',$fuente.html()); 

 $.ajax({
    type: 'post',
    data: $form_data,
    processData: false,
    contentType: false,
    dataType:'text',
    success: function(){
      window.location.assign('./1');
    },
    error: function(exception){
        console.log("Error: " + exception);
    }

 });

 }





/* ---------------- PASO 7.-  CONCLUSIONES ----------------------*/


/*$urls se usa en abiProfesorCreator para controlar que las urls no se repitan al agregarse 
y en abiProfesorShower para agregar todas las urls en tiempo de ejecución y después 
iterar cuando todo la página haya terminado de cargar para mandar a llamar a urlive :) 
*/
var urls = new Array();

 var fn = function(){
      if( urls.length > 0 ){
        var element = urls.pop();
        appendUrlShow(element);
      }
        
   
    }




function enviarConclusion()
{

//MAX_MB = 5;


    var file_data = $('input[name=archivos_client]').prop('files');   

    var form_data = new FormData();        
   for (var i = 0; i<file_data.length ; i++) {
       console.log("bomre" +file_data[i].name);
      form_data.append('archivos[]',file_data[i],file_data[i].name);
          };          

  
    
    form_data.append('urls', JSON.stringify(urls) );
    form_data.append('conclusion', $('#shower').html() );
    form_data.append('_token', $('input[name=_token]').val() );
   


    $.ajax({
            xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (evt) {
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    console.log(percentComplete);
                    $('.progress').css({
                        width: percentComplete * 100 + '%'
                    });
                    if (percentComplete === 1) {
                        $('.progress').addClass('hide');
                    }
                }
            }, false);
            xhr.addEventListener("progress", function (evt) {
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    console.log(percentComplete);
                    $('.progress').css({
                        width: percentComplete * 100 + '%'
                    });
                }
                }, false);
                return xhr;
                },
                url: './conclusion', // point to server-side PHP script 
                data: form_data,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType:'text',
                success: function(data){
               
                    window.location.assign('./1');
            
               

                }
                ,

             error:function(exception){swal("Error",":(", "error");}

          
     });


}

function completeUrlHttpMissing(url)
{
  if (url.indexOf("http://") !== 0 & url.indexOf("https://") !== 0) {
            url = "http://" + url;
        }
  return url;
}


function appendUrl()
{
 
  link = completeUrlHttpMissing($("#link").val());
  
  if (verifyLink(link)) return;
  $("#link").val('');
   // create new item elements
  var $items = $('<div class="grid-item-conclution"></div>');
  $missing = $('<button type="button" class="close" data-dismiss="alert" onClick="closeUrl(this)">×</button>');
  $iconAnimation = $('<i class="fa fa-refresh fa-spin fa-3x fa-fw" aria-hidden="true"></i>');
  $iconAnimation.insertAfter("#linkDisplay");
  //$items.append($iconAnimation);
  var $a = $('<a href="'+link+'"></a>');
  
  $items.append($a);
  $grid.append( $items ).masonry( 'appended', $items );
   $items.css('display','none');

  // append items to grid
 



// I call urilive plugin, this plugin read the content of href into <a> and show a thumbnail
$a.urlive({
  container: $items, 
  callbacks: {
    onStart : function(){
        $("#addLink").prop( "disabled", true );
        $("#linkDisplay").text('Validando link ...');
        $("#linkDisplay").parent().removeClass('alert-info alert-danger');
        $("#linkDisplay").parent().removeClass('alert-info alert-success');
        $("#linkDisplay").parent().addClass('alert-warning'); 

    },
    onLoadEnd: function(){
        console.log("LOAD END");
     $iconAnimation.remove();
      
     // $grid.append( $items )
    // add and lay out newly appended items
    //.masonry( 'appended', $items );
   
    //  urls.push(link);
    $items.css('display','block');
    $("#addLink").prop( "disabled", false );
    $grid.masonry('layout');

      

      

    }
    ,
    noData: function(response){
        console.log("No data");
         swal({   title: "Aviso: ",  
            text: "El link que ingresaste parece ser incorrecto, con poca información para mostrar o los datos son privados, sin embargo si confías en la fuente puedes conservarlo, ¿Añadir de todas formas?",  
            type: "warning",
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Si",  
            cancelButtonText: "Cancelar",  
            closeOnConfirm: true,  
            closeOnCancel: true }, 
            function(isConfirm){
                if (isConfirm) {
                $("#linkDisplay").text('Success: Link añadido correctamente');
                $("#linkDisplay").parent().removeClass('alert-info alert-danger');
                $("#linkDisplay").parent().removeClass('alert-info alert-warning');
                $("#linkDisplay").parent().addClass('alert-success');  
                $iconAnimation.remove();
                $items.find('a').remove();
                $atag = ("<a href='"+link+"' class='a-fixed' target = '_blank'><strong id='gStrong'>"+link+"</strong></a>");
                $items.append($atag);
                urls.push(link);
                $iconAnimation.remove();
                $items.css('display','block');
                $grid.masonry('layout');

            }
            else{
                $("#linkDisplay").text('');
                $("#linkDisplay").parent().removeClass('alert-info alert-warning');
                $items.remove();
                $iconAnimation.remove();
            }

        });
        
        $("#addLink").prop( "disabled", false );
     
     
    }
    ,
    imgError: function(error){
      console.log("IMG ERROR");
      $("#linkDisplay").text('Success: Link añadido correctamente');
      $("#linkDisplay").parent().removeClass('alert-info alert-danger');
      $("#linkDisplay").parent().removeClass('alert-info alert-warning');
      $("#linkDisplay").parent().addClass('alert-success');  
      $iconAnimation.remove();
      $grid.masonry('layout');
      $items.css('display','block');
      urls.push(link);
      $grid.masonry('layout');
      $("#addLink").prop( "disabled", false );
    },
  
    onSuccess: function() {
      console.log("ON SUCESS");
      $("#linkDisplay").text('Success: Link añadido correctamente');
      $("#linkDisplay").parent().removeClass('alert-info alert-danger');
      $("#linkDisplay").parent().removeClass('alert-info alert-warning');
      $("#linkDisplay").parent().addClass('alert-success');  
      $iconAnimation.remove();
      $grid.masonry('layout');
      
      urls.push(link);
      $items.css('display','block');
      $grid.masonry('layout');
      $("#addLink").prop( "disabled", false );
    },
    onFail: function() {
        $("#linkDisplay").text('Error: Ocurrió un error al agregar este link');
        $("#linkDisplay").parent().removeClass('alert-info alert-success');
        $("#linkDisplay").parent().removeClass('alert-info alert-warning');
        $("#linkDisplay").parent().addClass('alert-danger');
        $items.remove();
        $("#addLink").prop( "disabled", false );
    },
  }
});

$items.append($missing);
}

       
function closeUrl(element)
{
  $linka = $(element).parent().find('a').attr('href');
  $(element).parent().remove();
  $grid.masonry('layout');
  console.log("Va a borrar "+ $linka);
  urls.splice(urls.indexOf($linka) );
  console.log("ARRAY : " + urls);
}
function verifyLink(urlNew){
  if($.inArray(urlNew,urls) > -1)
      {
       alert("Esta url ya se encuentra agregada");
       return true; 
      }
  return false;
}

function downloadFile(url)
{
  window.open(url);
}
function namePath(url,idm)
{
  arr = url.split('/');
  console.log("ID: "+idm);
$("#sid_"+idm).append(arr[arr.length -1]);
  console.log("arr "+arr[arr.length -1]);
  return arr[arr.length -1];
}


function appendUrlShow(urlval)
{
 
   // create new item elements
  var items = $('<div class="grid-item-conclution"></div>');
  var iconAnimation = $('<i class="fa fa-spinner fa-spin fa-3x"></i>');
  items.append(iconAnimation);
  var a = $('<a href="'+urlval+'"></a>');
  
  items.append(a);
  // append items to grid
  $gridUrl.append( items )
    // add and lay out newly appended items
    .masonry( 'appended', items );



// I call urilive plugin, this plugin read the content of href into <a> and show a thumbnail
try{
a.urlive({
  container: items, 
  callbacks: {
    onLoadEnd: function(){
    iconAnimation.remove();
      $gridUrl.masonry('layout'); 
      fn();
    
    }
    ,
    noData: function(response){
    
      iconAnimation.remove();
      items.find('a').remove();
      atag = ("<a href='"+urlval+"' class='a-fixed' target = '_blank'><strong id='gStrong'>"+urlval+"</strong></a>");
      items.append(atag);
      $gridUrl.masonry('layout');
      fn();
    }
    ,
    imgError: function(error){
       iconAnimation.remove();
       gridUrl.masonry('layout');
       fn();

    }
   
  }
});
}
catch(err)
{
  console.log("Error : " + err);
}



}



