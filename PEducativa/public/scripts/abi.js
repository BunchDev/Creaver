
/*$urls se usa en abiProfesorCreator para controlar que las urls no se repitan al agregarse 
y en abiProfesorShower para agregar todas las urls en tiempo de ejecución y después 
iterar cuando todo la página haya terminado de cargar para mandar a llamar a urlive :) 
*/
var $urls = new Array();

 var fn = function(){
      if( $urls.length > 0 ){
        var element = $urls.pop();
        appendUrlShow(element);
      }
        
   
    }

$('#generadora').on('change', function(){
   opcion =  $('select[id=generadora]').val()
   if(opcion == 1){
   	crearInputPregunta();
   }
   if(opcion == 2)
   {
   	crearInputCaso();
   }
});

// de manera dinamica creo el campo, limpiando los elementos del div primero y luego añandiendo
function crearInputPregunta(){
$("#formGenerador").empty();
label = $("<label>Pregunta Generadora: </label>");
br = $("<br>");
input = $("<input type='text' id='text_generadora'>");
$("#formGenerador").append(label);
$("#formGenerador").append(br);
$("#formGenerador").append(input);


}
function crearInputCaso()
{
$("#formGenerador").empty();
label = $("<label>Caso: </label>");
br = $("<br>");
input = $("<textarea id='text_generadora'>");
$("#formGenerador").append(label);
$("#formGenerador").append(br);
$("#formGenerador").append(input);


}

function enviarMateriales()
{

//MAX_MB = 5;


	var file_data = $('input[name=archivos_client]').prop('files');   

    var form_data = new FormData();        
   for (var i = 0; i<file_data.length ; i++) {
   	   console.log("bomre" +file_data[i].name);
      form_data.append('archivos[]',file_data[i],file_data[i].name);
          };          

  
    form_data.append('generadora', $("#text_generadora").val() );
    form_data.append('urls', JSON.stringify($urls) );
    form_data.append('tipo', $('select[id=generadora]').val() );
    form_data.append('id', $('#id').val() );
    form_data.append('instruccion', $('#instruccion').val() );
    form_data.append('_token', $('input[name=_token]').val() );
   

    /*
'archivos': form_data,'generadora':$("#text_generadora").val(),
            			'urls':$("urls").val(), 'id': $("#id").val(), 
            			'tipo' :  $('select[id=generadora]').val(),
            			'_token': $('input[name=_token]').val()
    */
    
  

   	//var size = ($('#a_propuesta').prop('files')[0].size/1024/1024).toFixed(2);
  // 	$("#anuncios").empty();
//	if(size > MAX_MB) 
//	{

//		$("#anuncios").append("El archivo rebasa los 5 MB");
//		return;
//	}

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
                url: './subirMaterial', // point to server-side PHP script 
                data: form_data,
              	processData: false,
              	contentType: false,
              	type: 'POST',
              	dataType:'text',
                success: function(data){
               
                	window.location.assign("../../irCurso/"+$('#idCurso').val());
            
               

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
  var $items = $('<div class="grid-item"></div>');
  $missing = $('<button type="button" class="close" data-dismiss="alert" onClick="closeUrl(this)">×</button>');
  $iconAnimation = $('<i class="fa fa-spinner fa-spin fa-3x"></i>');
  $items.append($iconAnimation);
  var $a = $('<a href="'+link+'"></a>');
  
  $items.append($a)
  // append items to grid
  $grid.append( $items )
    // add and lay out newly appended items
    .masonry( 'appended', $items );



// I call urilive plugin, this plugin read the content of href into <a> and show a thumbnail
$a.urlive({
  container: $items, 
  callbacks: {
    onLoadEnd: function(){
      console.log("LLEGO ACA");
      $iconAnimation.remove();
      $grid.masonry('layout');
      $items.append($missing);
      $urls.push(link);
      console.log("FINALIZO ACA");

      

    }
    ,
    noData: function(response){
      $iconAnimation.remove();
      $items.find('a').remove();
      $atag = ("<a href='"+link+"' class='a-fixed' target = '_blank'><strong id='gStrong'>"+link+"</strong></a>");
      $items.append($atag);
      $items.append($missing);
      $urls.push(link);
     
    }
    ,
    imgError: function(error){
      console.log("EERROR  " + error);
       $iconAnimation.remove();
      $grid.masonry('layout');
      $items.append($missing);
      $urls.push(link);
    }
  }
});




}

       
function closeUrl(element)
{
  $linka = $(element).parent().find('a').attr('href');
  $(element).parent().remove();
  $grid.masonry('layout');
  console.log("Va a borrar "+ $linka);
  $urls.splice($urls.indexOf($linka),1);
  console.log("ARRAY : " + $urls);
}
function verifyLink(urlNew){
  if($.inArray(urlNew,$urls) > -1)
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
  var items = $('<div class="grid-item"></div>');
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



