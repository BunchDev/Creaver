/* ===================================================
 *  JQEditable.js v0.1.0
 *  https://github.com/CrisDev93/JQEditable/
 * ===================================================
 *  Copyright (c) 2016 Cristian Michel Pérez Zárate
 *  All rights reserved.
 */


(function( $ ) {
 
    $.fn.editable = function() {

    	$(this).dblclick(function(){


    		$elementMain = $(this);
    		$value = $(this).text();
    		$input = $("<input type='text'>").val($value);
    		$elementMain.replaceWith($input);


    		$($input).keypress(function(e) {
    			if(e.which == 13) {
    				if(!$input.val() == ''){
    				$elementMain.val('');
    				$elementMain.text($input.val());
    				$elementMain.editable();
    				$input.replaceWith($elementMain);
    				$(document).off('click');

    				}
    				else{
    					
    					$input.replaceWith($elementMain);
    					$(document).off('click');
    				}
    				
    				
        		
    			}
			});

    		$(document).on('click',function(event) { 
    			if(!$(event.target).closest($input).length &&
       				!$(event.target).is($input)) {
        			
        			if(!$input.val() == ''){
    				$elementMain.val('');
    				$elementMain.text($input.val());
    				$elementMain.editable();
    				$input.replaceWith($elementMain);
    				$(document).off('click');
    				

    				}
    				else{
    					
    					$input.replaceWith($elementMain);
    					console.log("nop");
    					$(document).off('click');
    				}
    }        
})


    		



    	});




 
       
        return this;
 
    };
 
}( jQuery ));