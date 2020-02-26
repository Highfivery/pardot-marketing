<?php
/**
 * Pardot admin functionality
 *
 * @since 1.0.0
 */

function pardotmarketing_admin_menu() {
  add_submenu_page( 'options-general.php', __( 'Pardot Marketing', 'pardotmarketing' ), __( 'Pardot Marketing', 'pardotmarketing' ), 'manage_options', 'pardot-marketing', 'pardotmarketing_options_page' );
}
add_action( 'admin_menu', 'pardotmarketing_admin_menu' );


function pardotmarketing_options_page() {
 if ( ! current_user_can( 'manage_options' ) ) { return; }

  ?>
  <div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <form action="options.php" method="post">
    <?php
    // Output security fields for the registered setting "pardot"
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

function pardotmarketing_admin_init() {
  register_setting( 'pardotmarketing', 'pardotmarketing_options' );

  add_settings_section( 'pardotmarketing_section_credentials', __( 'Pardot API Credentials', 'pardotmarketing' ), 'pardotmarketing_section_credentials_cb', 'pardotmarketing' );

  add_settings_field( 'pardotmarketing_field_api_url', __( 'URL', 'pardot' ), 'pardotmarketing_field_cb', 'pardotmarketing', 'pardotmarketing_section_credentials', [
    'label_for' => 'pardotmarketing_field_api_url',
    'type'      => 'url',
    'desc'      => __( 'Enter the Pardot API endpoint.', 'sparkcognition'),
    'class'     => 'regular-text'
  ]);

  add_settings_field( 'pardotmarketing_field_api_email', __( 'Email', 'pardot' ), 'pardotmarketing_field_cb', 'pardotmarketing', 'pardotmarketing_section_credentials', [
    'label_for' => 'pardotmarketing_field_api_email',
    'type'      => 'email',
    'desc'      => __( 'Enter the Pardot API email.', 'sparkcognition'),
    'class'     => 'regular-text'
  ]);

  add_settings_field( 'pardotmarketing_field_api_password', __( 'Password', 'pardot' ), 'pardotmarketing_field_cb', 'pardotmarketing', 'pardotmarketing_section_credentials', [
    'label_for' => 'pardotmarketing_field_api_password',
    'type'      => 'password',
    'desc'      => __( 'Enter the Pardot API password.', 'sparkcognition'),
    'class'     => 'regular-text'
  ]);

  add_settings_field( 'pardotmarketing_field_api_user_key', __( 'User Key', 'pardot' ), 'pardotmarketing_field_cb', 'pardotmarketing', 'pardotmarketing_section_credentials', [
    'label_for' => 'pardotmarketing_field_api_user_key',
    'type'      => 'text',
    'desc'      => __( 'Enter the Pardot API user key.', 'sparkcognition'),
    'class'     => 'regular-text'
  ]);
}
add_action( 'admin_init', 'pardotmarketing_admin_init' );

function pardotmarketing_field_cb( $args ) {
  $options = get_option( 'pardotmarketing_options' );

  switch( $args['type'] ) {
    case 'url':
    case 'text':
    case 'password':
    case 'number':
    case 'email':
      ?>
      <input class="<?php echo $args['class']; ?>" type="<?php echo $args['type']; ?>" value="<?php if ( ! empty( $options[ $args['label_for'] ] ) ): echo esc_attr( $options[ $args['label_for'] ] ); endif; ?>" placeholder="" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="pardotmarketing_options[<?php echo esc_attr( $args['label_for'] ); ?>]"><?php if ( ! empty( $args['suffix'] ) ): echo ' ' . $args['suffix']; endif; ?>
      <p class="description"><?php echo $args['desc'] ?></p>
      <?php
    break;
    case 'textarea':
      ?>
      <textarea rows="10" class="<?php echo $args['class']; ?>" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="pardotmarketing_options[<?php echo esc_attr( $args['label_for'] ); ?>]"><?php if ( ! empty( $options[ $args['label_for'] ] ) ): echo esc_attr( $options[ $args['label_for'] ] ); endif; ?></textarea>
      <p class="description"><?php echo $args['desc'] ?></p>
      <?php
    break;
  }

  ?>
  <?php
}

function pardotmarketing_section_credentials_cb( $args ) {
  ?>
  <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Update your Pardot API credentials below.', 'pardot' ); ?></p>
  <?php
 }
