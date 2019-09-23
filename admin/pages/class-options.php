<?php
/*
 * Main settings options
 */
namespace fegoeducation;

include_once FEGOEDUCATION_DIR .'common/class-common.php';    

if (!class_exists('options_admin')) {
 

    class options_admin extends \fegoeducation\common\fegoed_Common {
        
        public function __construct()  {
            global $pagenow;
            // data array for active values
            $this->fegoed_options = array();
            // data array for default values
            $this->fegoed_default_options = array();
            // prefix for all variables
            $this->fegoed_prefix = 'fegodev_';
            // name of data record in wp_options
            $this->fegoed_data = 'fego-education-options'; 
            // used for style sheet reg
            $this->myname = 'fego_education_options';
            // used to seed the setting page nonce field value
            $this->mynonce = 'fegoed-demo-settings-save';
            // field name for nonce field
            $this->nonce_field = 'fegoed-custom-message';
            // name of options page in url
            $this->mypage = 'fegoed-options-page';
            // name of the form post action
            $this->myaction = 'fego_education_settings';
            // add the menu if not setup elsewhere
            // add_action( 'admin_menu', array( $options_admin, 'add_options_page' ) );
            add_action( 'admin_post_'.$this->myaction, array( $this, 'validate_options' ) );
            // only call enqueue when our page is being called.
            if (($pagenow == 'options-general.php' ) && ( $_GET["page"] == $this->mypage )) {
                       }
                add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
                add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );                    

            $this->LoadOptions();
            $this->UpgradeOptions();
        }

        /*
         * content of options page
         */    
        public function options_page_html()
        {
            // check user capabilities
            if (!current_user_can('manage_options')) {
                return;
            }
            wp_enqueue_style($this->myname);

            wp_enqueue_script($this->myname);

            include (  FEGOEDUCATION_DIR . '/admin/views/options-html.php' );
            include (  FEGOEDUCATION_DIR . '/admin/views/admin-footer.php' );
        }
        /*
         * create the options menu item
         */
        public function add_options_page() {
        add_options_page(
                'Fego Education Option Page',         // title
                'Fego Education Settings',            // menu slug
                'manage_options',                     // admin level
                $this->mypage,                        // page name
                array( $this, 'options_page_html' )   // function called
        );
    }
         /**
         *  Setup all initial/default values in a table
         */ 
        function InitOptions() {
            // set a default version number
            // add in all default value fields here 
            // then saved values will be loaded on top.
            $this->fegoed_default_options[$this->fegoed_prefix . 'version'] = 1.0;
            $this->fegoed_default_options[$this->fegoed_prefix . 'user-checkbox'] = 0; 
            $this->fegoed_default_options[$this->fegoed_prefix . 'plugin-serial'] = 'hello'; 
            }    
        /**
         * Upgrade data from old version
         * change or introduce new value from releases
         */
        function UpgradeOptions() {
            if ( $this->fegoed_options[$this->fegoed_prefix . 'version'] < 1.0) {
                $this->fegoed_options[$this->fegoed_prefix . 'version'] = '1.0';
                  
            }           
        }
        
        
        public function validate_options() {
            foreach ( $this->fegoed_default_options as $key => $value) {
                $targ = substr($key, strlen($this->fegoed_prefix));
                switch ($targ) {
                    case 'string'://SECTION 1 - dummy label defining strings
                    case 'version':  
                    case 'user-number'://SECTION 2 - dummy label defining ints
                    case 'plugin-serial':
 
                        $this->fegoed_options[$key] = sanitize_text_field($_POST[$targ]);
                        break;
                    case 'checkbox';//SECTION 3 - dummy label defining chckbox
                    case 'user-checkbox';    
                        if (isset($_POST[$targ])) {
                            $this->fegoed_options[$key] = 1;
                        }   else $this->fegoed_options[$key] = 0;
                        break;
                }
           }     
           $this->Save_Options($this->fegoed_data, $this->fegoed_options); 
        }
    /**
     * Registers the stylesheets or options page
     *
     * @since 0.2.0
     */
    public function enqueue_styles() {

            wp_register_style(
                    $this->myname,
                    FEGOEDUCATION_URL . 'admin/css/options.css',
                    array()
            );
             

    }  
        /**
     * Registers the JavaScript for options page.
     *
     * @since 0.1.0
     */
    public function enqueue_scripts() {
            // wp_enqueue_media();
      
    }   
}
} //end of class