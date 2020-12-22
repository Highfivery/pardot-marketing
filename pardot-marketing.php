<?php
/**
 * Pardot Marketing WordPress Plugin
 *
 * @package    PardotMarketing
 * @subpackage WordPress
 * @since      1.0.0
 * @author     Ben Marshall
 * @copyright  2020 Ben Marshall
 * @license    GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Pardot Marketing
 * Plugin URI:        https://benmarshall.me/pardot-marketing
 * Description:       Provides integration between WordPress and Pardot. Supports Elementor and Pardot forms, allowing you to customize styling to match your site.
 * Version:           1.1.2
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Ben Marshall
 * Author URI:        https://benmarshall.me
 * Text Domain:       pardotmarketing
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

/**
 * Security Note: Blocks direct access to the plugin PHP files.
 */
defined( 'ABSPATH' ) || die();

// Define plugin constants
define( 'PARDOT_MARKETING', __FILE__ );
define( 'PARDOT_MARKETING_VERSION', '1.1.2' );

if ( ! function_exists( 'pardotmarketing_install' ) ) {
  function pardotmarketing_install() {
    // Assign WP admin all Pardot Marketing capabilities
    $admin = get_role( 'administrator' );
    $admin->add_cap( 'pardotmarketing_read_prospects', true );
    $admin->add_cap( 'pardotmarketing_read_forms', true );

    // Create the Pardot Adminstrator role
    $pardot_admin_capabilities = get_role( 'administrator' )->capabilities;
    $pardot_admin_capabilities['pardotmarketing_read_prospects'] = true;
    $pardot_admin_capabilities['pardotmarketing_read_forms'] = true;

    add_role( 'pardotmarketing_admin', 'Pardot Administrator', $pardot_admin_capabilities );
  }
}
add_action( 'init', 'pardotmarketing_install' );
//register_activation_hook( PARDOT_MARKETING, 'pardotmarketing_install' );

/**
 * Pardot API class
 */
require plugin_dir_path( PARDOT_MARKETING ) . '/classes/class-pardot-api.php';

/**
 * Helpers
 */
require plugin_dir_path( PARDOT_MARKETING ) . '/inc/helpers.php';

/**
 * Plugin scripts
 */
require plugin_dir_path( PARDOT_MARKETING ) . '/inc/scripts.php';

/**
 * Admin interface & functionality
 */
require plugin_dir_path( PARDOT_MARKETING ) . '/inc/admin.php';

/**
 * Elementor functionality
 */
require plugin_dir_path( PARDOT_MARKETING ) . '/integrations/elementor/widgets.php';
