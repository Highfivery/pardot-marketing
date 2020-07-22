<?php
/**
 * Admin interface & functionality
 *
 * @package PardotMarketing
 * @since 4.0.0
 */

function pardotmarketing_admin_menu() {
  // Not currently being used
  /*add_menu_page(
    __( 'Pardot Marketing Dashboard', 'pardotmarketing' ),
    __( 'Pardot Marketing', 'pardotmarketing' ),
    'manage_options',
    'pardot-marketing',
    'pardotmarketing_dashboard',
    'dashicons-cloud'
  );*/
}
add_action( 'admin_menu', 'pardotmarketing_admin_menu' );

function pardotmarketing_dashboard() {
  if ( ! current_user_can( 'manage_options' ) ) { return; }
    ?>
    <div class="wrap">
      <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
      <form action="options.php" method="post">
      <?php
      // Output security fields for the registered setting "pardotmarketing"
      settings_fields( 'pardotmarketing' );

      // Output setting sections and their fields
      do_settings_sections( 'pardotmarketing' );

      // Output save settings button
      submit_button( 'Save Settings' );
      ?>
      </form>
    </div>
  <?php
}

function pardotmarketing_validate_options( $input ) {
  if(  ! function_exists( 'is_plugin_active' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
  }

  return $input;
 }

/**
 * Add settings link to plugin description
 */
function pardotmarketing_admin_action_links( $actions, $plugin_file, $plugin_data, $context ) {
  $links = [
    'settings' => '<a href="' . admin_url( 'admin.php?page=pardot-marketing' ) . '">' . __( 'Settings' ) . '</a>'
  ];

  return array_merge( $links, $actions );
}


function pardotmarketing_admin_init() {
  if(  ! function_exists( 'is_plugin_active' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
  }

  $options = pardotmarketing_options();

  // Add settings link to plugin description
  add_filter( 'plugin_action_links_' . plugin_basename( PARDOT_MARKETING ), 'pardotmarketing_admin_action_links', 10, 4 );

  register_setting( 'pardotmarketing', 'pardotmarketing', 'pardotmarketing_validate_options' );

  add_settings_section( 'pardotmarketing_general_settings', __( 'General Settings', 'pardotmarketing' ), 'pardotmarketing_general_settings_cb', 'pardotmarketing' );

  // API URL (not currently being used)
  /*add_settings_field( 'api_url', __( 'API URL', 'pardot' ), 'pardotmarketing_field_cb', 'pardotmarketing', 'pardotmarketing_general_settings', [
    'label_for' => 'api_url',
    'type'      => 'url',
    'desc'      => __( 'Enter the Pardot API endpoint.', 'sparkcognition'),
    'class'     => 'regular-text'
  ]);*/

  // API email (not currently being used)
  /*add_settings_field( 'api_email', __( 'API Email', 'pardot' ), 'pardotmarketing_field_cb', 'pardotmarketing', 'pardotmarketing_general_settings_cb', [
    'label_for' => 'api_email',
    'type'      => 'email',
    'desc'      => __( 'Enter the Pardot API email.', 'sparkcognition'),
    'class'     => 'regular-text'
  ]);*/

  // API password (not currently being used)
  /*add_settings_field( 'api_password', __( 'Password', 'pardot' ), 'pardotmarketing_field_cb', 'pardotmarketing', 'pardotmarketing_general_settings_cb', [
    'label_for' => 'api_password',
    'type'      => 'password',
    'desc'      => __( 'Enter the Pardot API password.', 'sparkcognition'),
    'class'     => 'regular-text'
  ]);*/

  // API user key (not currently being used)
  /*add_settings_field( 'api_user_key', __( 'User Key', 'pardot' ), 'pardotmarketing_field_cb', 'pardotmarketing', 'pardotmarketing_general_settings_cb', [
    'label_for' => 'api_user_key',
    'type'      => 'text',
    'desc'      => __( 'Enter the Pardot API user key.', 'sparkcognition'),
    'class'     => 'regular-text'
  ]);*/
}
add_action( 'admin_init', 'pardotmarketing_admin_init' );

function pardotmarketing_general_settings_cb() {
}

function pardotmarketing_field_cb( $args ) {
  $options = pardotmarketing_options();

  switch( $args['type'] ) {
    case 'url':
    case 'text':
    case 'password':
    case 'number':
    case 'email':
      ?>
      <input class="<?php echo $args['class']; ?>" type="<?php echo $args['type']; ?>" value="<?php if ( ! empty( $options[ $args['label_for'] ] ) ): echo esc_attr( $options[ $args['label_for'] ] ); endif; ?>" placeholder="<?php if ( ! empty( $args['placeholder'] ) ): echo $args['placeholder']; endif; ?>" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="pardotmarketing[<?php echo esc_attr( $args['label_for'] ); ?>]"><?php if ( ! empty( $args['suffix'] ) ): echo ' ' . $args['suffix']; endif; ?>
      <p class="description"><?php echo $args['desc'] ?></p>
      <?php
    break;
    case 'textarea':
      ?>
      <textarea rows="10" class="<?php echo $args['class']; ?>" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="pardotmarketing[<?php echo esc_attr( $args['label_for'] ); ?>]"><?php if ( ! empty( $options[ $args['label_for'] ] ) ): echo esc_attr( $options[ $args['label_for'] ] ); endif; ?></textarea>
      <p class="description"><?php echo $args['desc'] ?></p>
      <?php
    break;
    case 'select':
      ?>
      <select name="pardotmarketing[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>">
        <?php foreach( $args['options'] as $key => $label ): ?>
          <option value="<?php echo $key; ?>"<?php if ( $key === $options[ $args['label_for'] ] ): ?> selected="selected"<?php endif; ?>><?php echo $label; ?></option>
        <?php endforeach; ?>
      </select>
      <p class="description"><?php echo $args['desc'] ?></p>
      <?php
    break;
    case 'checkbox':
      ?>
      <?php foreach( $args['options'] as $key => $label ): ?>
        <label for="<?php echo esc_attr( $args['label_for'] . $key ); ?>">
          <input
            type="checkbox"
            <?php if ( ! empty( $args['class'] ) ): ?>class="<?php echo $args['class']; ?>"<?php endif; ?>
            id="<?php echo esc_attr( $args['label_for'] . $key ); ?>"
            name="pardotmarketing[<?php echo esc_attr( $args['label_for'] ); ?>]<?php if( $args['multi'] ): ?>[<?php echo $key; ?>]<?php endif; ?>" value="<?php echo $key; ?>"
            <?php if( $args['multi'] && $key === $options[ $args['label_for'] ][ $key ] || ! $args['multi'] && $key === $options[ $args['label_for'] ] ): ?> checked="checked"<?php endif; ?> /> <?php echo $label; ?>
        </label>
      <?php endforeach; ?>
      <p class="description"><?php echo $args['desc'] ?></p>
      <?php
    break;
    case 'radio':
      ?>
      <?php foreach( $args['options'] as $key => $label ): ?>
        <label for="<?php echo esc_attr( $args['label_for'] . $key ); ?>">
          <input
            type="radio"
            <?php if ( ! empty( $args['class'] ) ): ?>class="<?php echo $args['class']; ?>"<?php endif; ?>
            id="<?php echo esc_attr( $args['label_for'] . $key ); ?>"
            name="pardotmarketing[<?php echo esc_attr( $args['label_for'] ); ?>]" value="<?php echo $key; ?>"
            <?php if( $key == $options[ $args['label_for'] ] ): ?> checked="checked"<?php endif; ?> /> <?php echo $label; ?>
        </label><br />
      <?php endforeach; ?>
      <p class="description"><?php echo $args['desc'] ?></p>
      <?php
    break;
  }
  ?>
  <?php
}
