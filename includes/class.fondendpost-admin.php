<?php

/**
 * All admin facing functions
 */

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * @package IM_Fontend_Post
 * @subpackage IM_Fontend_Post_Admin
 * @author Al Imran Akash <alimranakash.bd@gmail.com>
 */
if( ! class_exists( 'IM_Fontend_Post_Admin' ) ) :

class IM_Fontend_Post_Admin {

	private $settings_api;

    /**
     * Constructor function
     */
    public function __construct( $name, $version ) {

    	require_once dirname( IMFILE ) . '/vendor/wordpress-settings-api/class.settings-api.php';

        $this->name = $name;
        $this->version = $version;
        $this->settings_api = new WeDevs_Settings_API;
    }
    
    /**
     * Enqueue JavaScripts and stylesheets
     */
    public function enqueue_scripts() {
        wp_enqueue_style( $this->name, plugins_url( '/assets/css/admin.css', IMFILE ), '', $this->version, 'all' );
        
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( $this->name, plugins_url( '/assets/js/admin.js', IMFILE ), array( 'jquery' ), $this->version, true );
    }

    public function admin_init() {
        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    public function admin_menu() {
        add_menu_page( __( 'Ajax Fontend Post', 'ajax-fontebd-post' ), __( 'Ajax Fontend Post', 'fondendpost' ), 'edit_pages', 'ajax-fontebd-post', array( $this, 'settings_page' ), 'dashicons-carrot', '3.5' );
    }

    public function get_settings_sections() {
        $sections = array(
            'grocery-general' => array(
                'id'    => 'grocery-general',
                'title' => __( 'General', 'fondendpost' ),
                'desc'  => __( '', 'fondendpost' ),
            ),
        );

        return $sections;
    }


    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    public function get_settings_fields() {
        $settings_fields = array(
            'grocery-general' => array(
                'popup_logo' => array(
                    'name'      => 'popup_logo',
                    'label'     => __( 'Popup Logo', 'fondendpost' ),
                    'desc'      => __( 'Logo to show in the popup.', 'fondendpost' ),
                    'type'      => 'file',
                ),
            ),
        );
        
        return $settings_fields;

    }

    public function settings_page() {
        ?>
        <div class="wrap fondendpost-wrap">
        <h2><?php _e( 'Ajax Fontend Post Settings', 'fondendpost' ); ?></h2>

        <div class="fondendpost-settings">
        <?php
            $this->settings_api->show_navigation();
            $this->settings_api->show_forms();
        ?>
        </div><!-- fondendpost-settings -->

        </div><!-- wrap fondendpost-wrap -->
        <?php
    }


    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    public function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ( $pages as $page ) {
                $pages_options[ $page->ID ] = $page->post_title;
            }
        }

        return $pages_options;
    }

     public function show_delivery_date( $order ) {
        echo '
        <div class="address">
            <p class="none_set">
                <strong>Delivery Date:</strong>
            ' . get_post_meta( $order->get_order_number(), '_delivery_date', true ) . '
            </p>
        </div>
        ';
    }
}

endif;