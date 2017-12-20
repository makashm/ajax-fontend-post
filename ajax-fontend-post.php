<?php
/*
Plugin Name: Ajax Fontend Post
Description: Ajax Fontend Post For wp
Plugin URI: https://wppeople.net
Author: Al Imran Akash
Author URI: http://im.medhabi.com
Version: 1.0
Text Domain: fondendpost
Domain Path: /languages
*/

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main class for the plugin
 * @package IM_Fontend_Post
 * @author Al Imran Akash <alimranakash.bd@gmail.com>
 */
if( ! class_exists( 'IM_Fontend_Post' ) ) :

class IM_Fontend_Post {
	
	public static $_instance;
	public $plugin_name;
	public $plugin_version;

	public function __construct() {
		self::define();
		self::includes();
		self::hooks();
	}

	/**
	 * Define constants
	 */
	public function define(){
		define( 'IMFILE', __FILE__ );
		$this->plugin_name = 'fondendpost';
		$this->plugin_version = '1.0';
	}

	/**
	 * Includes files
	 */
	public function includes(){
		require_once dirname( IMFILE ) . '/includes/fondendpost-functions.php';
		require_once dirname( IMFILE ) . '/includes/class.fondendpost-public.php';
		require_once dirname( IMFILE ) . '/includes/class.fondendpost-admin.php';
		require_once dirname( IMFILE ) . '/includes/class.fondendpost-ajax.php';
	}

	/**
	 * Hooks
	 */
	public function hooks(){
		// public hooks
		$public = ( isset( $public ) && ! is_null( $public ) ) ? $public : new IM_Fontend_Post_Public( $this->plugin_name, $this->plugin_version );
		add_action( 'wp_head', array( $public, 'head' ) );
		add_action( 'wp_enqueue_scripts', array( $public, 'enqueue_scripts' ) );
		add_shortcode( 'fontendpost', array( $public, 'fontend_post_display' ) );
		
		// admin hooks
		$admin = ( isset( $admin ) && ! is_null( $admin ) ) ? $admin : new IM_Fontend_Post_Admin( $this->plugin_name, $this->plugin_version );
		add_action( 'admin_enqueue_scripts', array( $admin, 'enqueue_scripts' ) );
        add_action( 'admin_init', array( $admin, 'admin_init' ) );
        add_action( 'admin_menu', array( $admin, 'admin_menu' ) );

		// ajax hooks
		$ajax = ( isset( $ajax ) && ! is_null( $ajax ) ) ? $ajax : new IM_Fontend_Post_Ajax();
		add_action( 'wp_ajax_im_fontend_post', array( $ajax, 'im_fontend_post' ) );
		add_action( 'wp_ajax_nopriv_im_fontend_post', array( $ajax, 'im_fontend_post' ) );
	}

	/**
	 * Internationalization
	 */
	public function i18n() {
		load_plugin_textdomain( 'fondendpost', false, dirname( plugin_basename( IMFILE ) ) . '/languages/' );
	}

	/**
	 * Cloning is forbidden.
	 */
	private function __clone() { }

	/**
	 * Unserializing instances of this class is forbidden.
	 */
	private function __wakeup() { }

	/**
	 * Instantiate the plugin
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}

endif;

IM_Fontend_Post::instance();