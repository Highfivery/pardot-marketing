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

    if ( empty( $options['api_url'] ) ) { $options['api_url'] = 'https://pi.pardot.com/api'; }

    return $options;
  }
}

/**
 * Returns the plugin settings.
 */
if ( ! function_exists( 'pardotmarketing_request' ) ) {
  function pardotmarketing_request( $action, $args = [] ) {
    $options = pardotmarketing_options();

    if (
      empty( $options['api_email'] ) ||
      empty( $options['api_password'] ) ||
      empty( $options['api_user_key'] )
    ) {
      return false;
    }

    $pardot_api = new PardotAPI([
      'api_email'    => $options['api_email'],
      'api_password' => $options['api_password'],
      'api_user_key' => $options['api_user_key']
    ]);

    switch ( $action ) {
      case 'getProspects':
        return $pardot_api->getProspects( $args );
      break;
      case 'getForms':
        return $pardot_api->getForms( $args );
      break;
    }

    return false;
  }
}

/**
 * Returns a Pardot forms
 */
if ( ! function_exists( 'pardotmarketing_get_forms' ) ) {
  function pardotmarketing_get_forms( $args = [] ) {
    $forms = pardotmarketing_request( 'getForms', $args );
    if ( ! $forms ) { return false; }
    $parsed = [ 'total_results' => $forms['total_results'], 'forms' => [] ];

    foreach( $forms['form'] as $key => $form ) {
      // Available fields
      $parsed['forms'][ $form['id'] ] = [
        'id'         => '',
        'name'       => '',
        'campaign'   => [],
        'crm_fid'  => '',
        'embedCode'  => '',
        'created_at' => '',
        'updated_at' => ''
      ];

      $parsed['forms'][ $form['id'] ]['id'] = $form['id'];

      // Name
      if ( ! empty( $form['name'] ) ) {
        $parsed['forms'][ $form['id'] ]['name'] = $form['name'];
      }

      // Campaign
      if ( ! empty( $form['campaign'] ) ) {
        $parsed['forms'][ $form['id'] ]['campaign'] = $form['campaign'];
      }

      // CRM field
      if ( ! empty( $form['crm_fid'] ) ) {
        $parsed['forms'][ $form['id'] ]['crm_fid'] = $form['crm_fid'];
      }

      // Embed code
      if ( ! empty( $form['embedCode'] ) ) {
        $parsed['forms'][ $form['id'] ]['embedCode'] = $form['embedCode'];
      }

      // Created
      if ( ! empty( $form['created_at'] ) ) {
        $parsed['forms'][ $form['id'] ]['created_at'] = strtotime( $form['created_at'] );
      }

      // Updated
      if ( ! empty( $form['updated_at'] ) ) {
        $parsed['forms'][ $form['id'] ]['updated_at'] = strtotime( $form['updated_at'] );
      }
    }

    return $parsed;
  }
}

/**
 * Returns a Pardot prospects
 */
if ( ! function_exists( 'pardotmarketing_get_prospects' ) ) {
  function pardotmarketing_get_prospects( $args = [] ) {
    $prospects = pardotmarketing_request( 'getProspects', $args );
    if ( ! $prospects ) { return false; }
    $parsed = [ 'total_results' => $prospects['total_results'], 'prospects' => [] ];
    foreach( $prospects['prospect'] as $key => $prospect ) {
      // Available fields
      $parsed['prospects'][ $prospect['id'] ] = [
        'id'          => '',
        'campaign_id' => '',
        'first_name'  => '',
        'last_name'   => '',
        'email'       => '',
        'company'     => '',
        'job_title'   => '',
        'country'     => '',
        'created_at'  => '',
        'updated_at'  => ''
      ];

      $parsed['prospects'][ $prospect['id'] ]['id'] = $prospect['id'];

      // Campaign ID
      if ( ! empty( $prospect['campaign_id'] ) ) {
        $parsed['prospects'][ $prospect['id'] ]['campaign_id'] = $prospect['campaign_id'];
      }

      // First name
      if ( ! empty( $prospect['first_name'] ) ) {
        $parsed['prospects'][ $prospect['id'] ]['first_name'] = $prospect['first_name'];
      }

      // Last name
      if ( ! empty( $prospect['last_name'] ) ) {
        $parsed['prospects'][ $prospect['id'] ]['last_name'] = $prospect['last_name'];
      }

      // Email
      if ( ! empty( $prospect['email'] ) ) {
        $parsed['prospects'][ $prospect['id'] ]['email'] = $prospect['email'];
      }

      // Company
      if ( ! empty( $prospect['company'] ) ) {
        $parsed['prospects'][ $prospect['id'] ]['company'] = $prospect['company'];
      }

      // Job title
      if ( ! empty( $prospect['job_title'] ) ) {
        $parsed['prospects'][ $prospect['id'] ]['job_title'] = $prospect['job_title'];
      }

      // Country
      if ( ! empty( $prospect['country'] ) ) {
        $parsed['prospects'][ $prospect['id'] ]['country'] = $prospect['country'];
      }

      // Created
      if ( ! empty( $prospect['created_at'] ) ) {
        $parsed['prospects'][ $prospect['id'] ]['created_at'] = strtotime( $prospect['created_at'] );
      }

      // Updated
      if ( ! empty( $prospect['updated_at'] ) ) {
        $parsed['prospects'][ $prospect['id'] ]['updated_at'] = strtotime( $prospect['updated_at'] );
      }
    }

    return $parsed;
  }
}
