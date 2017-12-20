<?php

/**
 * All public facing functions
 */

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * @package IM_Fontend_Post
 * @subpackage IM_Fontend_Post_Public
 * @author Al Imran Akash <alimranakash.bd@gmail.com>
 */
if( ! class_exists( 'IM_Fontend_Post_Public' ) ) :

class IM_Fontend_Post_Public {

    /**
     * Constructor function
     */
    public function __construct( $name, $version ) {
        $this->name = $name;
        $this->version = $version;
    }
    
    /**
     * Enqueue JavaScripts and stylesheets
     */
    public function enqueue_scripts() {
        wp_enqueue_style( $this->name .'-select2-css', plugins_url( '/assets/css/select2.min.css', IMFILE ), '', $this->version, 'all' );
        wp_enqueue_style( $this->name, plugins_url( '/assets/css/public.css', IMFILE ), '', $this->version, 'all' );

        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( $this->name .'-select2-js', plugins_url( '/assets/js/select2.min.js', IMFILE ), array( 'jquery' ), $this->version, true );
        wp_enqueue_script( $this->name, plugins_url( '/assets/js/public.js', IMFILE ), array( 'jquery' ), $this->version, true );
    }

    /**
     * Add some script to head
     */
    public function head() {
        echo '
        <script>
            var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '";
        </script>';
    }
    
    public function fontend_post_display() {
        ob_start();
        echo im_get_template( 'fontend-post-display' );
        return ob_get_clean();
    } 
}

endif;