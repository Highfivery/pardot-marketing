<?php
/**
 * Handles registering Elementor widgets
 *
 * @package PardotMarketing
 * @since 1.0.0
 */

namespace PardotMarketing;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.0.0
 */
class PardotMarketing_Widgets {

  /**
   * Instance
   *
   * @since 1.0.0
   * @access private
   * @static
   *
   * @var PardotMarketing_Widgets The single instance of the class.
   */
  private static $_instance = null;

  /**
   * Instance
   *
   * Ensures only one instance of the class is loaded or can be loaded.
   *
   * @since 1.0.0
   * @access public
   *
   * @return PardotMarketing_Widgets An instance of the class.
   */
  public static function instance() {
    if ( is_null( self::$_instance ) ) {
      self::$_instance = new self();
    }

    return self::$_instance;
  }

  /**
   * widget_scripts
   *
   * Load required plugin core files.
   *
   * @since 1.0.0
   * @access public
   */
  public function widget_scripts() {
    wp_register_script( 'pardotmarketing-jquery-validation', plugin_dir_url( PARDOT_MARKETING ) . 'assets/js/jquery.validate.min.js', [ 'jquery' ], PARDOT_MARKETING_VERSION, true );
    wp_register_style( 'pardotmarketing-form-handler', plugin_dir_url( PARDOT_MARKETING ) . 'assets/css/form-handler.css', [], PARDOT_MARKETING_VERSION );
  }

  /**
   * Include Widgets files
   *
   * Load widgets files
   *
   * @since 1.0.0
   * @access private
   */
  private function include_widgets_files() {
    require_once( __DIR__ . '/widgets/form-handler.php' );
  }

  /**
   * Register Widgets
   *
   * Register new Elementor widgets.
   *
   * @since 1.2.0
   * @access public
   */
  public function register_widgets() {
    // Its is now safe to include Widgets files
    $this->include_widgets_files();

    // Register Widgets
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\FormHandler() );
  }

  /**
   *  Plugin class constructor
   *
   * Register plugin action hooks and filters
   *
   * @since 1.2.0
   * @access public
   */
  public function __construct() {

    // Register widget scripts
    add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

    // Register widgets
    add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
  }
}

// Instantiate Plugin Class
PardotMarketing_Widgets::instance();
