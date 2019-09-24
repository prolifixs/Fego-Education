<?php
/**
 * FEGO EDUCATION CONSULT wordpress Plugin 
 *
 * Plugin Name: Fego Education
 * Plugin URI:  https://fegoeduconsulting.com/
 * Description: Additional Features to support the fego education platform.
 * Version:     1.0.0
 * Author:      SERAWARE LLC
 * Author URI:  https://seraware.com
 * Text Domain: fego-education
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// plugin namespace to keep code seperated
namespace fegoeducation;

// stop unwatned visitors calling directly
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Go away!' );
}


/*
* define the only constants used in the plugin
*/
    $myplugin_url = plugin_dir_url(__FILE__);
    if ( is_ssl() ) {
        $myplugin_url = str_replace('http://', 'https://', $myplugin_url);
    }
    define ( 'FEGOEDUCATION_URL', $myplugin_url);
    define ( 'FEGOEDUCATION_DIR', plugin_dir_path( __FILE__));
    define ( 'FEGOEDUCATION_VERS', '1.0.0');    
    define ( 'FEGOEDUCATION_transient', '_FEGOEDUCATION_welcome' );

    include_once(FEGOEDUCATION_DIR . 'init/class-post-types.php');

    /*
     * Initilise the init class at the end of this file
     */
    $mystart = new MyInit();



/*
 * launch
 * 
 * @since 1.0.0
 * @param none
 * @return void
 * 

 */      
function launch () {
    /*
     * load up my options. Declare first as can be used by admin and user sections.
     */
    include_once FEGOEDUCATION_DIR .'admin/pages/class-options.php';
    $my_options = new options_admin();
    add_action( 'admin_menu', array( $my_options, 'add_options_page' ) );
        /*
     *  register any custom post types       
     */

    require_once ( FEGOEDUCATION_DIR . 'admin/pages/class-welcome.php');         
    $my_welcome = new welcome_class();
        /*
     *  register any custom post types       
     */
    $call_my_post_types = new fegoeducation_post_types();
    /*
     * For the admin section
     */    
    if (is_admin()) {
        include_once ( FEGOEDUCATION_DIR . 'admin/class-admin-control.php');
            $my_control = new admin_control();  
    }
}
launch();


class MyInit
    {    
    public function __construct(){
        register_activation_hook( __FILE__, array($this, 'plugin_activated' ));
        register_deactivation_hook( __FILE__, array($this, 'plugin_deactivated' ));
        register_uninstall_hook( __FILE__, array($this, 'plugin_uninstall' ) ); 
    }
    public static function plugin_activated(){
         // This will run when the plugin is activated, setup the database
        // set transisnt marker to allow welcome with 30 seconds timeout.
        set_transient('FEGOEDUCATION_transient', true,30);
        $register_post_type = new fegoeducation_post_types(); 
        $register_post_type->register_fegoeducation_post_types();
        flush_rewrite_rules();
    }
    public function plugin_deactivated(){
         // This will run when the plugin is deactivated, use to delete the database
    }  
    public function plugin_uninstall() {
        // this will clean up for plugin delete. How well depends on you!
        delete_transient('FEGOEDUCATION_transient');    
    }
}