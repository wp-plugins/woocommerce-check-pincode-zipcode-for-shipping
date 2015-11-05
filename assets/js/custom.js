jQuery(document).ready(function(){

if(usejs == 1)
{
		jQuery("#delivery_help_a").click( function(e){
		  
          e.stopPropagation();

			jQuery('.delivery_help_text_main').show();

		

		});




		jQuery("#delivery_help_x").click( function(e){
		  
            e.stopPropagation();

			jQuery('.delivery_help_text_main').hide();

		});

		



		

		jQuery(".delivery_help_text_main").click( function(e){
		  
            e.stopPropagation();

		});
        
        

        

		jQuery("#change_pin").click(function(){
	
			jQuery('#my_custom_checkout_field2').show();

			jQuery('#avlpin').hide();


		});



		jQuery("#checkpin").click(function(){

			var pin_code = jQuery('#pincode_field_id').val();


			if( pin_code != '' )
			{

				   jQuery('#error_pin').hide();

				   jQuery('#chkpin_loader').show();

				   	jQuery.ajax({
                            url : MyAjax.ajaxurl,
                            type : 'post',
                            data : {
                            action : 'picodecheck_ajax_submit',
                            pin_code : pin_code
                            },
                            success : function( response ) {
                           // alert(response)
                             if(response == 1)
    						 {
    
    							 location.reload(); 
    
    						 }
    						 else
    						 {
    							 jQuery('#chkpin_loader').hide();
    
    							 jQuery('#error_pin').show();
                                 
                                 jQuery('#pincode_field_id').val('');                                                                                       
    
    						 }
                            }
                            }); 

			}
			else
			{

                jQuery('#error_pin').show();
                jQuery('#pincode_field_id').val('');                

			}


		});	


            
            jQuery('body').bind('click',function(e){
 
                jQuery('.delivery_help_text_main').hide();
                
                
             });

}

});