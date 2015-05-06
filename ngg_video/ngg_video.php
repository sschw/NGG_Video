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

if ( !class_exists( 'nggvideo' ) ) :

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
   * Load scripts into wordpress pages
   */     
  public nggvideo_wp_enqueue_scripts() {
  
  }
  
  /**
   * Add settings to option page in admin panel
   */     
  public nggvideo_add_option_menu() {
    add_options_page( 'NGG Video Options', 'NGG Video',
			'manage_options', 'NGG Video Options',
			array($this, 'nggvideo_option_interface'));
  }
  
  /**
   * includes the admin page
   */
  public nggvideo_option_interface() {
    include(plugin_dir_path(__FILE__).'/admin/ngg_video_admin_page.php');
  }     
}
