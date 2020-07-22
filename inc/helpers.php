<?php
/**
 * Plugin helpers
 *
 * @package PardotMarketing
 * @since 1.0.0
 */

/**
 * Returns the plugin settings.
 */
if ( ! function_exists( 'pardotmarketing_options' ) ) {
  function pardotmarketing_options() {
    $options = get_option( 'pardotmarketing' );

    return $options;
  }
}
