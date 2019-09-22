<?php
/**
 * Event Custom Post Type functionality
 *
 * @package     seraware-retro
 * @since       1.0.0
 * @author      wamp
 * @link        https://wamp.co.uk
 * @license     GNU General Public License 2.0+
 */
namespace fegoeducation;
if (!class_exists('fegoeducation_post_types')) {
 
    class fegoeducation_post_types {
        
        public function __construct()  {

        add_action( 'init', array($this, 'register_fegoeducation_post_types') ); 
        
        }
        /**
         * Register the custom post type.
         *
         * @since 1.0.0
         *
         * @return void
         */
        function register_fegoeducation_post_types() {
        /**
         * Student Notification custom post type.
         *
         */
        $student_cpt = array(
            'description'        => __( 'Description.', 'studentswamp' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_nav_menus'  => false,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'student' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-groups',
            'supports'           => array( 'title', 'editor', 'thumbnail' ),
            'labels'             => array(
                'name'               => _x( 'Students', 'post type general name', 'studentswamp' ),
                'singular_name'      => _x( 'Student', 'post type singular name', 'studentswamp' ),
                'menu_name'          => _x( 'Students', 'admin menu', 'studentswamp' ),
                'name_admin_bar'     => _x( 'Student', 'add new on admin bar', 'studentswamp' ),
                'add_new'            => _x( 'Add New', 'student', 'studentswamp' ),
                'add_new_item'       => __( 'Add New Student', 'studentswamp' ),
                'new_item'           => __( 'New Student', 'studentswamp' ),
                'edit_item'          => __( 'Edit Student', 'studentswamp' ),
                'view_item'          => __( 'View Student', 'studentswamp' ),
                'all_items'          => __( 'All Students', 'studentswamp' ),
                'search_items'       => __( 'Search Students', 'studentswamp' ),
                'parent_item_colon'  => __( 'Parent Students:', 'studentswamp' ),
                'not_found'          => __( 'No students found.', 'studentswamp' ),
                'not_found_in_trash' => __( 'No students found in Trash.', 'studentswamp' ),
                'featured_image' => __( 'Student Image', 'studentswamp' )
            )
                );

        //---------------------------------------------------------------
        /**
         * Countries custom post type.
         *
         */
        $countries_cpt = array(
            'description'        => __( 'Description.', 'studentswamp' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_nav_menus'  => false,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'countries' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-admin-site-alt',
            'supports'           => array( 'title', 'editor', 'thumbnail' ),
            'labels'             => array(
                'name'               => _x( 'Countries', 'post type general name', 'countryswamp' ),
                'singular_name'      => _x( 'Country', 'post type singular name', 'countryswamp' ),
                'menu_name'          => _x( 'Countries', 'admin menu', 'countryswamp' ),
                'name_admin_bar'     => _x( 'Country', 'add new on admin bar', 'countryswamp' ),
                'add_new'            => _x( 'Add New', 'Country', 'countryswamp' ),
                'add_new_item'       => __( 'Add New Country', 'countryswamp' ),
                'new_item'           => __( 'New Country', 'countryswamp' ),
                'edit_item'          => __( 'Edit Country', 'countryswamp' ),
                'view_item'          => __( 'View Country', 'countryswamp' ),
                'all_items'          => __( 'All Countries', 'countryswamp' ),
                'search_items'       => __( 'Search Countries', 'countryswamp' ),
                'parent_item_colon'  => __( 'Parent Countries:', 'countryswamp' ),
                'not_found'          => __( 'No Countries found.', 'countryswamp' ),
                'not_found_in_trash' => __( 'No Countries found in Trash.', 'countryswamp' ),
                'featured_image' => __( 'Country Image', 'countryswamp' )
            )
    );
    //-----------------------------------------------------------------------
    /**
         * Countries custom post type.
         *
         */
        $university_cpt = array(
            'description'        => __( 'Description.', 'universityswamp' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_nav_menus'  => false,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'universities' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-building',
            'supports'           => array( 'title', 'editor', 'thumbnail' ),
            'labels'             => array(
                'name'               => _x( 'Universities', 'post type general name', 'universityswamp' ),
                'singular_name'      => _x( 'University', 'post type singular name', 'universityswamp' ),
                'menu_name'          => _x( 'Universities', 'admin menu', 'universityswamp' ),
                'name_admin_bar'     => _x( 'University', 'add new on admin bar', 'universityswamp' ),
                'add_new'            => _x( 'Add New', 'University', 'universityswamp' ),
                'add_new_item'       => __( 'Add New University', 'universityswamp' ),
                'new_item'           => __( 'New University', 'universityswamp' ),
                'edit_item'          => __( 'Edit University', 'universityswamp' ),
                'view_item'          => __( 'View University', 'universityswamp' ),
                'all_items'          => __( 'All Universities', 'universityswamp' ),
                'search_items'       => __( 'Search Universities', 'universityswamp' ),
                'parent_item_colon'  => __( 'Parent Universities:', 'universityswamp' ),
                'not_found'          => __( 'No Universities found.', 'universityswamp' ),
                'not_found_in_trash' => __( 'No Universities found in Trash.', 'universityswamp' ),
                'featured_image' => __( 'University Image', 'universityswamp' )
            )
    );

    //-----------------------------------------------------------------------
    /**
         * Featured School custom post type.
         *
         */
        $fet_school_cpt = array(
            'description'        => __( 'Description.', 'fegofeaturedswamp' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_nav_menus'  => false,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'fegofeatured' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-megaphone',
            'supports'           => array( 'title', 'editor', 'thumbnail' ),
            'labels'             => array(
                'name'               => _x( 'Featured School', 'post type general name', 'fegofeaturedswamp' ),
                'singular_name'      => _x( 'Featured School', 'post type singular name', 'fegofeaturedswamp' ),
                'menu_name'          => _x( 'Featured School', 'admin menu', 'fegofeaturedswamp' ),
                'name_admin_bar'     => _x( 'Featured School', 'add new on admin bar', 'fegofeaturedswamp' ),
                'add_new'            => _x( 'Add New Featured School', 'fegofeaturedswamp' ),
                'add_new_item'       => __( 'Add New Featured School', 'fegofeaturedswamp' ),
                'new_item'           => __( 'New Featured School', 'fegofeaturedswamp' ),
                'edit_item'          => __( 'Edit Featured School', 'fegofeaturedswamp' ),
                'view_item'          => __( 'View Featured School', 'fegofeaturedswamp' ),
                'all_items'          => __( 'All Featured School', 'fegofeaturedswamp' ),
                'search_items'       => __( 'Search Featured School', 'fegofeaturedswamp' ),
                'parent_item_colon'  => __( 'Parent Featured School:', 'fegofeaturedswamp' ),
                'not_found'          => __( 'No Featured School found.', 'fegofeaturedswamp' ),
                'not_found_in_trash' => __( 'No Featured School found in Trash.', 'fegofeaturedswamp' ),
                'featured_image' => __( 'Featured School Image', 'fegofeaturedswamp' )
            )
        );

        //-----------------------------------------------------------------------
        /**
         * Register all post types here...
         *
         */
        register_post_type( 'students', $student_cpt );
        register_post_type( 'countries', $countries_cpt );
        register_post_type( 'universities', $university_cpt );
        register_post_type( 'featured-school', $fet_school_cpt );
        }
        
    }
}