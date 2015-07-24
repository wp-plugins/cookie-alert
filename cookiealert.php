<?php

/*
Plugin Name: Cookie Alert
Plugin URI: http://rickymignanego.com/cookie-alert/
Description: Show a cookie info on bottom of the page.
Version: 0.1
Author: Ricky Mignanego
Author URI: https://rickymignanego.com/
*/

defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly motherfuckas!' );


    if ( ! class_exists( 'CookieAlert' ) ) {
	class CookieAlert {
        
         /**
         * Tag identifier used by file includes and selector attributes.
         * @var string
         */
        protected $tag = 'cookiealert';

        /**
         * User friendly name used to identify the plugin.
         * @var string
         */
        protected $name = 'Cookie Alert';

        /**
         * Current version of the plugin.
         * @var string
         */
        protected $version = '0.1';
       
        
        // Construct 
		public function __construct() {
			
            // Initialize Settings
			require_once(sprintf("%s/setup.php", dirname(__FILE__)));
			$cookie_alert_settings = new cookie_alert_settings_page();
            
            //Aggiungi CSS JS
            add_action( 'init', array(&$this,'cookiealert_css_js'), 25);
            
            //Hook the footer
            add_action('wp_footer', array(&$this,'cookiealert_stampa_messaggio'), 20);
           
		}
        
        
        //Aggiunge CSS e JS
        public function cookiealert_css_js() {
            wp_register_style('cookiealert_css', plugins_url('cssjs/cookiealert.css',__FILE__ ));
            wp_enqueue_style('cookiealert_css', 'false', array('style') );
            wp_register_script( 'cookiealert_js', plugins_url('cssjs/cookiealert.js',__FILE__ ));
            wp_enqueue_script('cookiealert_js','false', array(), 'false', true);
            }

        
        
        //Funzione stampa Markup
        public function cookiealert_stampa_messaggio() {
                   
                   $attivo = get_option('cookiealert_attivo');
                   $testo_messaggio = get_option('cookiealert_testo');
                   $link_informativa = trim(get_option('cookiealert_informativa'));
                   $testo_link = get_option('cookiealert_link');
             
            if($attivo == 'active') {
            
        echo '<div class="cookie-alert-wrap" style="display:none;">
        <p class="cookie-alert-text">' . $testo_messaggio . ' <a href="' . $link_informativa . '" title="' . $testo_link . '" class="cookie-alert-link" target="_blank" >'. $testo_link .'</a></p>
        <a href="#" class="cookie-alert-chiudi">Chiudi</a>
        </div>';
                 
                  }
            
	     }

     //Fine Cookie Alert 
     }
     }
        //Run del plugin
        if(class_exists('CookieAlert')) {

            $cookie_alert = new CookieAlert();
        }


?>