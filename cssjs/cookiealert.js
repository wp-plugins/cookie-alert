// JS Cookie Alert Wordpress Plugin

jQuery(document).ready(function() {
    

    
    //Apertura tramite cookie
    if (document.cookie.indexOf('visited=true') === -1) {
    
    
    //document.cookie = "visited=true; expires="+expires.toUTCString();
    
    //Mostra messaggio 
    jQuery('.cookie-alert-wrap').show();
    
    //Al click del tasto chiudi
    jQuery('.cookie-alert-chiudi').click( function(e){
        
        e.preventDefault();
        
      //Setta il cookie
      var expires = new Date();
      expires.setDate(expires.getDate()+1);
      document.cookie = "visited=true; expires="+expires.toUTCString()+" path=/";
        
      //Fa scomparire il messaggio
      jQuery('.cookie-alert-wrap').animate({
          
            height: 0,
            padding: 0,
           
          }, 500, function() {
          
          jQuery('.cookie-alert-wrap').css('z-index','-1');
          
          });
        
    });
    
    

  }
    
    


                    
//End doc ready                    
});