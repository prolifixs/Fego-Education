<?php

/*  Controls All Admin logics
 * This controls the post meta data and the post type displays
 */

namespace fegoeducation;

    class admin_control {
        
    
    public function __construct () {
        /*
         * Custom Post type Meta Data For Embassy Date...
         */
        include_once FEGOEDUCATION_DIR .'admin/pages/class-meta-side-post.php';            
        $my_side_meta_post = new side_meta_post();     	
	}  
	
}      