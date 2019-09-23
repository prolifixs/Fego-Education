<?php
/*
 * code to run a welcome screen after activation.
 * may need checking
 */
namespace fegoeducation;

class welcome_class {
    public function __construct()  {       
        add_action( 'admin_init', array($this,'welcome_do_activation_redirect') );  
        // add to the upcoming admin meny
            
        // Delete the redirect transient
        // Bail if activating from network, or bulk
        if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
            return;
        } 
        // add to menu
        add_action('admin_menu', array($this, 'welcome_pages') );
        add_action('admin_head', array($this, 'welcome_remove_menus' ) );
    }


    public function welcome_do_activation_redirect() {
      // Bail if no activation redirect
        if ( ! get_transient( 'FEGOEDUCATION_transient' ) ) {
            return;
          }
      // Redirect 
      wp_safe_redirect( add_query_arg( array( 'page' => 'fegoeducation-about-page' ), admin_url( 'index.php' ) ) );
    }


    /*
     * add a menu item
     */
    public function welcome_pages() {
      add_dashboard_page(
        'Welcome to Fego Education Consult Software',
        'Plugin Welcome',
        'read',
        'fegoeducation-about-page',
        array( $this,'welcome_content')
      );
    }

    public function welcome_remove_menus() {
        remove_submenu_page( 'index.php', 'fegoeducation-about-page' );
    }



    /* 
     * The Welcome screen
     */
    public static function welcome_content() {
        include(  FEGOEDUCATION_DIR . '/admin/views/welcome_content.php' );
        include (  FEGOEDUCATION_DIR . '/admin/views/admin-footer.php' );
        // now page is seen you can delete the transient
        delete_transient( 'FEGOEDUCATION_transient' );
    }


}