var circle;
var startColor = '#FC5B3F';
var endColor = '#6FD57F';
$(document).ready(function(){



  circle = new ProgressBar.Circle('#progress', {
    color: startColor,
    trailColor: '#eee',
    trailWidth: 1,
    duration: 1500,
    easing: 'bounce',
    strokeWidth: 5,
    text: {
        value: '0',
        
    },
    from: { color: startColor, width: 1 },
    to: { color: endColor, width: 10 },

    // Set default step function for all animate calls
    step: function(state, circle) {
        circle.setText((circle.value() * 100).toFixed(0));
        circle.path.setAttribute('stroke', state.color);
    }
});



});



    /**
        * Called when files are dropped on to the drop target. For each file,
        * uploads the content to Drive & displays the results when complete.
        */
       function handleFileSelect(evt) {

       	evt.stopPropagation();
        evt.preventDefault();
        var files = evt.dataTransfer.files; // FileList object.
       	var file = evt.dataTransfer.files[0];   
  		
       
		objectUrl = window.URL.createObjectURL(file);
		$("#vid").prop("src", objectUrl);
		
		$("#vid").on("loadedmetadata", function() {

			
			var seconds = $("#vid")[0].duration;
			var minutes = (seconds / 60);
			console.log("Listo: "+ minutes);
			if(minutes > 5)
			{
			   $("#drop_zone").show();
   	            
   	     $("#archivos_contenedor").show();
				 $(this).off('loadedmetadata');

			}
			else {

         $.when(getTokenVimeo()).done(function(respuestaToken){
         	uploadFile(files,respuestaToken);
         });
				
			}

    	
    	});
	}

     

       /**
        * Dragover handler to set the drop effect.
        */
       function handleDragOver(evt) {
         evt.stopPropagation();
         evt.preventDefault();
         evt.dataTransfer.dropEffect = 'copy';
       }

       /**
        * Wire up drag & drop listeners once page loads
        */
       document.addEventListener('DOMContentLoaded', function () {
           var dropZone = document.getElementById('drop_zone');
           dropZone.addEventListener('dragover', handleDragOver, false);
           dropZone.addEventListener('drop', handleFileSelect, false);
       });
;
       /**
        * Updat progress bar.
        */
       function updateProgress(progress) {

       	
          progress = Math.floor(progress * 100);
         
        
          circle.animate((progress/100));
      

       }


function subirVideo()
{

	if(validarVideo("archivo") == false) {

		alert("El video rebasa los 5 minutos");
	    $("#drop_zone").show();
   	    
		return;
	}

	$("#drop_zone").hide();
 
  	$("#archivos_contenedor").hide();
  $("#progress").show();
  
	$.when(getTokenVimeo()).done(function(respuestaToken){
         	prepareFiletoUpload(respuestaToken);
         });


	
}
function prepareFiletoUpload(accessToken)
{

	  var file_data = $('#fl').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('archivo', file_data);
      $("#progress").show();
      var uploader = new MediaUploader({
             file: file_data,
             token: accessToken,
             onError: function(data) {
                $("#progress").hide();
                 var errorResponse = JSON.parse(data);
                message = errorResponse.error;

                var element = document.createElement("div");
                element.setAttribute('class', "alert alert-danger");
                element.appendChild(document.createTextNode(message));
                document.getElementById('results').appendChild(element);

             },
             onProgress: function(data) {
                updateProgress(data.loaded / data.total);
             },
             onComplete: function(videoId) {
                 $("#progress").hide();
                 showSucessMessage();
                 $("#g_material").show();
                 $("#idVideo").attr('value',videoId);
                 console.log(videoId);
                console.log("ok2 " + $("#idVideo").val());


             }
         });
    uploader.upload();

}
var objectUrl;
$(document).ready(function(){
$('#drop_zone').bind("DOMNodeInserted DOMNodeRemoved",function(){
  alert('changed');
});



	$("#fl").change(function(e){
		
		var file = $('#fl').prop('files')[0];   
		
		objectUrl = window.URL.createObjectURL(file);
		
		$("#vid").prop("src", objectUrl);
	});

});


function validarVideo(tipo)
{
	
		if(tipo=="archivo")
		{
			var seconds = $("#vid")[0].duration;
			var minutes = (seconds / 60);
			if(minutes > 5)
				return false;
			else 
				return true;

		}

}		
function uploadFile(files,accessToken)
{

		$("#drop_zone").hide();
   	
   	$("#archivos_contenedor").hide();
    $("#progress").show();
 
         // Clear the results div
         var node = document.getElementById('results');
         while (node.hasChildNodes()) node.removeChild(node.firstChild);

         // Rest the progress bar
         updateProgress(0);

         var uploader = new MediaUploader({
             file: files[0],
             token: accessToken,
             onError: function(data) {
                  $("#progress").hide();

                var errorResponse = JSON.parse(data);
                message = errorResponse.error;

                var element = document.createElement("div");
                element.setAttribute('class', "alert alert-danger");
                element.appendChild(document.createTextNode(message));
                document.getElementById('results').appendChild(element);

             },
             onProgress: function(data) {
                updateProgress(data.loaded / data.total);
             },
             onComplete: function(videoId) {
                $("#progress").hide();

				      showSucessMessage();
              $("#idVideo").attr('value',videoId);

				        
              $("#g_material").show();



             }
         });
         uploader.upload();



}

function getTokenVimeo()
{

return $.ajax({
   type:'post',
   url :"./getToken",
   
   data: {'_token': $('input[name=_token]').val()},
   
   success: function(data) {
       	 token = data;
       	 console.log("Token: "+ token);
         }
,
   error:function(exception){swal("¡Ups!, ocurrió un error al subir el video", "Intenta de nuevo más tarde", "error")}
});


}

function getIdUrl(url)
{

var regExp = /https:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/;

var match = url.match(regExp);

if (match){
    return match[2];
}else{
    alert("not a vimeo url");
}

}

function showVideo(id)
{

$("#videoContent").append('<iframe id="player1" src="https://player.vimeo.com/video/'+id+'?api=1&player_id=player1" width="50%" height="354" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>')


}
function showSucessMessage()
{

	var element = document.createElement("div");
                element.setAttribute('class', "alert alert-dismissible alert-success");
                element.appendChild(document.createTextNode("Video subido exitosamente"));
                document.getElementById('results').appendChild(element);

}


//test

function vimeoLoadingThumb(id){    
    var url = "http://vimeo.com/api/v2/video/" + id + ".json?callback=showThumb";

    var id_img = "#vimeo-" + id;

    var script = document.createElement( 'script' );
    script.src = url;

    $(id_img).before(script);
}


function showThumb(data){
    var id_img = "#vimeo-" + data[0].id;
    $(id_img).attr('src',data[0].thumbnail_medium);
}