<?php

/**
 * Common functions for loading and saving data
 * across admin and user modules
 * 1.2 added function GetMetaSelected
 *      GetMetaCheckbox
 * 1.3 added has_valid_nonce()
 * @version 1.0.0
 * @since 1.0.0
 */


namespace fegoeducation\common;

class fegoed_Common {
    
    
    /*
     * Plugin spcific routines
     * since 1.0.0
     */


    
    /********************************************************************************************************************/
    /*
     * Functions common across all plugins
     */
    
    
    /**
     *  Returns option value for given key
     *  from array already loaded
     */
    public function GetOption($key) {
        $key = $this->fegoed_prefix . $key;
        if (array_key_exists($key, $this->fegoed_options)) {
            return $this->fegoed_options[$key];
        } else
            return null;
    }
    /*
     * echo out content plus BR or nothing if empty
     */
    public function ShowOption($key) {
        $key = $this->fegoed_prefix . $key;
        if (array_key_exists($key, $this->fegoed_options)) {
            if (strlen($this->fegoed_options[$key])>0) return '<br/>' . $this->fegoed_options[$key];
        } 
        return null;        
    }
    /*
     * returns checked if value is active
     */
    public function GetCheckbox($key) {
        $key = $this->fegoed_prefix . $key;
        if (array_key_exists($key, $this->fegoed_options)) {
            if ($this->fegoed_options[$key]==1) {
                return 'checked';
            } else return;
        } else
            return $key;
    }   
    /*
     * returns true of values if value is seen
     */
    public function CheckValue($key, $chk = 'static' ) {
        $key = $this->fegoed_prefix . $key;
        if (array_key_exists($key, $this->fegoed_options)) {
            if ($this->fegoed_options[$key]==$chk) {              
              return true;
            } else return false;
        } else
        { return false; }
    }
    /* 
     * Return selected text for option boxes to test the value
     */
    public function GetSelected($key, $value) {
        $key = $this->fegoed_prefix . $key;
        if (array_key_exists($key, $this->fegoed_options)) {
            if ($this->fegoed_options[$key]==$value) {
                            return 'selected';

            } 
        }
    }

    /*
     * Returns selected text for option boxes on tested value from meta post data
     * get_post_meta($post->ID, '_action_post_name', true)
     * GetMetaSelected('_action_post_name',  $value)
     */
    public function GetMetaSelected($key,  $value) {
        global $post;

        $chk = get_post_meta($post->ID,$key, true);

            if ( $chk == $value) {
                            return 'selected';

        }
    }
    
      /*
     * returns checked if value is active
     */
    public function GetMetaCheckbox($key) {
        global $post;
        $chk = get_post_meta($post->ID,$key, true);        
        if ( $chk == 1 ) {
                return 'checked';
            } else return;
    }  
    
    
    
    /**
     *  Loads options from database.
     * loops through Only values that already known in the settings.
     * and laods any stored values
     */

    function LoadOptions () {
        $this->InitOptions();
        // load default values
        foreach ($this->fegoed_default_options as $key => $value) {
            $this->fegoed_options[$key] = $value;
        }
        // bring in loaded values
        $storedoptions = get_option($this->fegoed_data);
        if ($storedoptions && is_array($storedoptions)) {
            foreach ($storedoptions as $key => $value) {
                $this->fegoed_options[$key] = $value;
            }
        } else
            update_option($this->fegoed_data, $this->fegoed_default_options);
    }

    /*
     *  Sets the speficied option key to a new value
     */

    function SetOption($key, $value) {
        if (strstr($key, $this->fegoed_prefix) !== 0)
            $key = $fegoed_prefix . $key;

        $this->fegoed_options[$key] = $value;
    }

    /**
     * check for a valid noncevalue 
     * save contents from page to database
     *
     * @access private
     */

    public function Save_Options ( $save_option, $new_value) {
        // First, validate the nonce and verify the user as permission to save.
        if (!( $this->has_valid_nonce() && current_user_can('manage_options') )) {
            // TODO: Display an error message.
            echo "Error: You can not save this data";
              die;
        }
        // validation in main class
        update_option($save_option, $new_value);
        $this->redirect();
    }

    /**
     * Redirect to the page from which we came (which should always be the
     * admin page. If the referred isn't set, then we redirect the user to
     * the login page.
     *
     * @access private
     */
    private function redirect() {

        // To make the Coding Standards happy, we have to initialize this.
        if (!isset($_POST['_wp_http_referer'])) { // Input var okay.
            $_POST['_wp_http_referer'] = wp_login_url();
        }

        // Sanitize the value of the $_POST collection for the Coding Standards.
        $url = sanitize_text_field(
                wp_unslash($_POST['_wp_http_referer']) // Input var okay.
        );

        // Finally, redirect back to the admin page.
        wp_safe_redirect(urldecode($url));
        exit;
    }

        

        /**
         * Determines if the nonce variable associated with the options page is set
         * and is valid.
         *
         * @access public
         * @param   $this->nonce_field - field name for nonce
         *          $this->mynonce - nonce seed
         * @return boolean False if the field isn't set or the nonce value is invalid;
         *                 otherwise, true.
         */
        public function has_valid_nonce() {

            // If the field isn't even in the $_POST, then it's invalid.
            if (!isset($_POST[$this->nonce_field])) { // Input var okay.
                return false;
            }

            $field_value = wp_unslash($_POST[$this->nonce_field]);
            $action = $this->mynonce;

            return wp_verify_nonce($field_value, $action);
        }  

}
