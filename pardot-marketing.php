<?php
/**
 * Pardot Marketing
 *
 * @author            Ben Marshall
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Pardot Marketing
 * Plugin URI:        https://benmarshall.me
 * Description:       Provides true integration between WordPress sites and Pardot. Supports Elementor and inline Pardot forms.
 * Version:           1.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Ben Marshall
 * Author URI:        https://benmarshall.me
 * Text Domain:       pardotmarketing
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if ( ! defined( 'PARDOTMARKETING_PLUGIN' ) ) {
  define( 'PARDOTMARKETING_PLUGIN', __FILE__ );
}

/**
 * Admin interface
 */
require plugin_dir_path( __FILE__ ) . '/inc/admin.php';

/**
 * Elementor widgets
 */
require plugin_dir_path( __FILE__ ) . '/elementor/elementor.php';

/**
 * Pardot class
 */
require plugin_dir_path( __FILE__ ) . '/classes/class-pardot-api.php';
