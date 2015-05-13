<?php
/**
 *
 **************************
 * Wordpress Informations *
 **************************
 * Plugin Name: NGG Video
 * Description: The NGG is a great tool for showing images but if someone wants to show images and videos he do not have a chance to make that. This extension should change that.
 * Version: 0.0.1
 * Author: Sandro Schwager
 * Plugin URI: -
 * Author URI: -
 * Text Domain: nggvideo
 * Domain Path: /languages/
 * License: No license
 */


// Exit file if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'nggvideo' ) ) {

/**
 * The main class of the NGG Video Plugin
 */
final class NGGVideo {
  /**
   * Static variable which holds the instance of the class
   */
  private static $instance;

  /**
   * Method which provides the instance of the class (using singleton)
   */
  public static function get() {
    if(self::$instance === null) {
      self::$instance = new NGGVideo();
    }
    return self::$instance;
  }
  
  /**
   * Initialize the plugin - register everything
   */
	public function __construct() {
    $this->nggvideo_register();
  }
  
  /**
   * Register actions
   */
  public function nggvideo_register() {
    add_action('admin_menu',array(&$this, 'nggvideo_add_option_menu'));
		add_filter('ngg_render_template', array(&$this, 'nggvideo_add_template'), 10, 2);
	}

  /**
   * Register template
   */
	function nggvideo_add_template( $path, $template_name = false) {
		if ($template_name == 'nggvideo')
			$path = WP_PLUGIN_DIR . '/' . plugin_basename( dirname(__FILE__) ) . '/templates/gallery-nggvideo-template.php';
			
		return $path;
	}
  
  /**
   * Load scripts into wordpress pages
   */     
  public function nggvideo_wp_enqueue_scripts() {
  
  }
  
  /**
   * Add settings to option page in admin panel
   */     
  public function nggvideo_add_option_menu() {
    add_options_page( 'NGG Video Options', 'NGG Video',
			'manage_options', 'NGG_Video_Options',
			array($this, 'nggvideo_option_interface'));
  }
  
  /**
   * Includes the admin page
   */
  public function nggvideo_option_interface() {
    include(plugin_dir_path(__FILE__).'admin/nggvideo_admin_page.php');
  }
}

NGGVideo::get();
}