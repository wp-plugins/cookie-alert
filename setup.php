<?php

    if(!class_exists('cookie_alert_settings_page')) {
	class cookie_alert_settings_page {
        
		// Construct the plugin object
		public function __construct() {

            add_action('admin_init', array(&$this, 'admin_init'));
        	add_action('admin_menu', array(&$this, 'add_menu'));
		} 
		
        
        // hook into WP's admin_init action hook
        public function admin_init() {
            
        	// Registra opzioni
        	register_setting('cookie_alert_template-group', 'cookiealert_attivo');
        	register_setting('cookie_alert_template-group', 'cookiealert_testo');
        	register_setting('cookie_alert_template-group', 'cookiealert_informativa');
        	register_setting('cookie_alert_template-group', 'cookiealert_link');

        	// Sezione di Setup
        	add_settings_section(
        	    'cookie_alert_template-section', 
        	    'Opzioni Cookie Alert', 
        	    array(&$this, 'cookie_alert_plugin_template'), 
        	    'cookie_alert_template'
        	);
        	
        	// Opzione 1
            add_settings_field(
                'cookie_alert_template-cookiealert_attivo', 
                'Attivo', 
                array(&$this, 'settings_field_input_radio'), 
                'cookie_alert_template', 
                'cookie_alert_template-section',
                array(
                    'fieldradio' => 'cookiealert_attivo'
                )
            );
            
            //Opzione 2
            add_settings_field(
                'cookie_alert_template-cookiealert_testo', 
                'Testo del Messaggio', 
                array(&$this, 'settings_field_input_textarea'), 
                'cookie_alert_template', 
                'cookie_alert_template-section',
                array(
                    'fieldarea' => 'cookiealert_testo'
                )
            );
            
            //Opzione 3
            add_settings_field(
                'cookie_alert_template-cookiealert_informativa', 
                'Url informativa', 
                array(&$this, 'settings_field_input_text'), 
                'cookie_alert_template', 
                'cookie_alert_template-section',
                array(
                    'field' => 'cookiealert_informativa'
                )
            );
            
            //Opzione 4
            add_settings_field(
                'cookie_alert_template-cookiealert_link', 
                'Testo Link', 
                array(&$this, 'settings_field_input_text'), 
                'cookie_alert_template', 
                'cookie_alert_template-section',
                array(
                    'field' => 'cookiealert_link'
                )
            );
            
            // Possibly do additional admin_init tasks
        } 
        
        public function cookie_alert_plugin_template() {
            // Think of this as help text for the section.
            echo 'Personalizza in tuo messaggio.';
        }
        
        
        //Stampa gli input radio 
        public function settings_field_input_radio($args) {
            // Get the field name from the $args array
            $fieldradio = $args['fieldradio'];
            // Get the value of this setting
            $value = get_option($fieldradio);
            // echo a proper input type="text"
            
            if($value == 'active') {
            
            echo '
            
            <input type="radio" name="cookiealert_attivo" value="active" checked> Active 
            <br />
            <input type="radio" name="cookiealert_attivo" value="disabled"> Disabled
            
            ';
                
            } else {
            
            echo '
            
            <input type="radio" name="cookiealert_attivo" value="active"> Active 
            <br />
            <input type="radio" name="cookiealert_attivo" value="disabled" checked> Disabled
            
            ';
            
            
            }
        } 
        
        
        //Stampa la textarea
        public function settings_field_input_textarea($args) {
            // Get the field name from the $args array
            $fieldarea = $args['fieldarea'];
            // Get the value of this setting
            $value = get_option($fieldarea);
            // echo a proper input type="text"
            echo sprintf('<textarea name="%s" id="%s" >%s</textarea>', $fieldarea, $fieldarea, $value);
        } 
        
        //Stampa gli input text 
        public function settings_field_input_text($args) {
            // Get the field name from the $args array
            $field = $args['field'];
            // Get the value of this setting
            $value = get_option($field);
            // echo a proper input type="text"
            echo sprintf('<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value);
        } 
        
       
        
        //Menu	
        public function add_menu()
        {
            // Add a page to manage this plugin's settings
        	add_options_page(
        	    'Cookie Alert', 
        	    'Cookie Alert', 
        	    'manage_options', 
        	    'cookie_alert_template', 
        	    array(&$this, 'plugin_settings_page')
        	);
        } // END public function add_menu()
    
        /**
         * Menu Callback
         */		
        public function plugin_settings_page()
        {
        	if(!current_user_can('manage_options'))
        	{
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}
	
        	// Render the settings template
        	include(sprintf("%s/template/setup.php", dirname(__FILE__)));
        } // END public function plugin_settings_page()
    } // END class WP_Plugin_Template_Settings
} // END if(!class_exists('WP_Plugin_Template_Settings'))
