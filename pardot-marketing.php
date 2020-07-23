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
 * Version:           1.0.1
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
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Define plugin constants
define( 'PARDOT_MARKETING', __FILE__ );
define( 'PARDOT_MARKETING_VERSION', '1.0.1' );

/**
 * Helpers
 */
require plugin_dir_path( PARDOT_MARKETING ) . '/inc/helpers.php';

/**
 * Admin interface & functionality
 */
require plugin_dir_path( PARDOT_MARKETING ) . '/inc/admin.php';

/**
 * Elementor functionality
 */
require plugin_dir_path( PARDOT_MARKETING ) . '/integrations/elementor/widgets.php';
