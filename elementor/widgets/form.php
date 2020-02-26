<?php
namespace PardotMarketingElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Form extends Widget_Base {

  /**
   * Retrieve the widget name.
   *
   * @since 1.1.0
   *
   * @access public
   *
   * @return string Widget name.
   */
  public function get_name() {
    return 'pardotmarketing-form';
  }

  /**
   * Retrieve the widget title.
   *
   * @since 1.1.0
   *
   * @access public
   *
   * @return string Widget title.
   */
  public function get_title() {
    return __( 'Form', 'pardotmarketing' );
  }

  /**
   * Retrieve the widget icon.
   *
   * @since 1.1.0
   *
   * @access public
   *
   * @return string Widget icon.
   */
  public function get_icon() {
    return 'fab fa-wpforms';
  }

  /**
   * Retrieve the list of categories the widget belongs to.
   *
   * Used to determine where to display the widget in the editor.
   *
   * Note that currently Elementor supports only one category.
   * When multiple categories passed, Elementor uses the first one.
   *
   * @since 1.1.0
   *
   * @access public
   *
   * @return array Widget categories.
   */
  public function get_categories() {
    return [ 'pardotmarketing' ];
  }

  public function get_style_depends() {
    $styles = [ 'pardotmarketing-form' ];

    return $styles;
  }

  public function get_script_depends() {
    $scripts = [ 'pardotmarketing-form' ];

    return $scripts;
  }

  /**
   * Register the widget controls.
   *
   * Adds different input fields to allow the user to change and customize the widget settings.
   *
   * @since 1.1.0
   *
   * @access protected
   */
  protected function _register_controls() {
    $this->start_controls_section(
			'settings_section',
			[
				'label' => __( 'Settings', 'pardotmarketing' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
    );

    $this->add_control(
			'endpoint',
			[
				'label' => __( 'Endpoint URL', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::URL,
        'show_external' => false,
        'description' => __( 'Copy & paste the Pardot form endpoint URL.', 'pardotmarketing' ),
			]
    );

    $this->add_control(
			'popup',
			[
				'label' => __( 'In Popup', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pardotmarketing' ),
				'label_off' => __( 'No', 'pardotmarketing' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
    );

    $this->add_control(
			'popup_trigger',
			[
				'label' => __( 'Popup Open Selector', 'pardotmarketing' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'description' => __( 'The selector that triggers the popup this form is in.', 'pardotmarketing' ),
        'placeholder' => 'i.e. .open-popup',
        'conditions' => [
          'terms' => [
            [
              'name' => 'popup',
              'operator' => 'in',
              'value' => [
                'yes',
              ],
            ],
          ],
        ],
			]
    );

    $this->end_controls_section();

    $this->start_controls_section(
			'fields_section',
			[
				'label' => __( 'Form Fields', 'pardotmarketing' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

    $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'type',
			[
				'label' => __( 'Type', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'text',
				'options' => [
          'text'  => __( 'Text', 'pardotmarketing' ),
          'textarea'  => __( 'Textarea', 'pardotmarketing' ),
          'email' => __( 'Email', 'pardotmarketing' ),
          'url' => __( 'URL', 'pardotmarketing' ),
          'tel' => __( 'Telephone', 'pardotmarketing' ),
          'checkbox' => __( 'Checkbox', 'pardotmarketing' ),
          'select' => __( 'Select', 'pardotmarketing' ),
          'hidden' => __( 'Hidden', 'pardotmarketing' ),
				],
			]
    );

    $repeater->add_control(
			'key',
			[
				'label' => __( 'Key', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __( 'i.e. first_name', 'pardotmarketing' ),
        'description' => __( "Use the 'External Field Name' value from the Pardot form.", 'pardotmarketing' )
			]
    );

    $repeater->add_control(
			'label',
			[
				'label' => __( 'Label', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __( 'i.e. First Name', 'pardotmarketing' ),
        'conditions' => [
          'terms' => [
            [
              'name' => 'type',
              'operator' => '!in',
              'value' => [
                'hidden',
              ],
            ],
          ],
        ],
			]
    );

    $repeater->add_control(
			'options',
			[
				'label' => __( 'Options', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 5,
        'description' => __( 'Enter each option in a separate line. To differentiate between label and value, separate them with a pipe char ("|"). For example: First Name|f_name', 'pardotmarketing' ),
        'conditions' => [
          'terms' => [
            [
              'name' => 'type',
              'operator' => 'in',
              'value' => [
                'select', 'checkbox'
              ],
            ],
          ],
        ],
			]
		);

    $repeater->add_control(
			'value',
			[
				'label' => __( 'Default Value', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __( 'i.e. John Doe', 'pardotmarketing' ),
        'dynamic' => [
          'active' => true,
        ],
			]
    );

    $repeater->add_control(
			'placeholder',
			[
				'label' => __( 'Placeholder', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __( 'i.e. Enter your first name', 'pardotmarketing' ),
        'conditions' => [
          'terms' => [
            [
              'name' => 'type',
              'operator' => '!in',
              'value' => [
                'hidden', 'checkbox', 'select'
              ],
            ],
          ],
        ],
			]
    );

    $repeater->add_control(
			'required',
			[
				'label' => __( 'Required', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pardotmarketing' ),
				'label_off' => __( 'No', 'pardotmarketing' ),
				'return_value' => 'yes',
        'default' => 'yes',
        'conditions' => [
          'terms' => [
            [
              'name' => 'type',
              'operator' => '!in',
              'value' => [
                'hidden',
              ],
            ],
          ],
        ],
			]
    );

    $repeater->add_control(
			'inline',
			[
				'label' => __( 'Inline List', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pardotmarketing' ),
				'label_off' => __( 'No', 'pardotmarketing' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
    );

    $repeater->add_responsive_control(
			'width',
			[
				'label' => __( 'Column Width', 'pardotmarketing' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
					'default'  => __( 'Default', 'pardotmarketing' ),
					'100' => __( '100%', 'pardotmarketing' ),
					'80' => __( '80%', 'pardotmarketing' ),
          '75' => __( '75%', 'pardotmarketing' ),
          '66' => __( '66%', 'pardotmarketing' ),
          '60' => __( '60%', 'pardotmarketing' ),
          '50' => __( '50%', 'pardotmarketing' ),
          '40' => __( '40%', 'pardotmarketing' ),
          '33' => __( '33%', 'pardotmarketing' ),
          '25' => __( '25%', 'pardotmarketing' ),
          '20' => __( '20%', 'pardotmarketing' ),
        ],
        'desktop_default' => 'default',
				'tablet_default' => 'default',
				'mobile_default' => 'default',
        'devices' => [ 'desktop', 'tablet', 'mobile' ],
        'conditions' => [
          'terms' => [
            [
              'name' => 'type',
              'operator' => '!in',
              'value' => [
                'hidden',
              ],
            ],
          ],
        ],
			]
    );

    $repeater->add_control(
			'rows',
			[
				'label' => __( 'Rows', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
        'default' => 4,
        'conditions' => [
          'terms' => [
            [
              'name' => 'type',
              'operator' => 'in',
              'value' => [
                'textarea',
              ],
            ],
          ],
        ],
			]
		);

		$this->add_control(
			'fields',
			[
				'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'title_field' => '{{{ key }}}',
			]
		);

    $this->end_controls_section();

    $this->start_controls_section(
			'submit_section',
			[
				'label' => __( 'Submit Button', 'pardotmarketing' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
    );

    $this->add_control(
			'submit_text',
			[
				'label' => __( 'Text', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Submit', 'pardotmarketing' ),
			]
    );

    $this->add_responsive_control(
			'submit_width',
			[
				'label' => __( 'Column Width', 'pardotmarketing' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
					'default'  => __( 'Default', 'pardotmarketing' ),
					'100' => __( '100%', 'pardotmarketing' ),
					'80' => __( '80%', 'pardotmarketing' ),
          '75' => __( '75%', 'pardotmarketing' ),
          '66' => __( '66%', 'pardotmarketing' ),
          '60' => __( '60%', 'pardotmarketing' ),
          '50' => __( '50%', 'pardotmarketing' ),
          '40' => __( '40%', 'pardotmarketing' ),
          '33' => __( '33%', 'pardotmarketing' ),
          '25' => __( '25%', 'pardotmarketing' ),
          '20' => __( '20%', 'pardotmarketing' ),
        ],
        'desktop_default' => 'default',
				'tablet_default' => 'default',
				'mobile_default' => 'default',
        'devices' => [ 'desktop', 'tablet', 'mobile' ],
			]
		);

    $this->end_controls_section();

    $this->start_controls_section(
			'options_sections',
			[
				'label' => __( 'Additional Options', 'pardotmarketing' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
    );

    $this->add_control(
			'custom_messages',
			[
				'label' => __( 'Custom Messages', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pardotmarketing' ),
				'label_off' => __( 'No', 'pardotmarketing' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
    );

    $this->add_control(
			'success_message',
			[
				'label' => __( 'Success Message', 'pardotmarketing' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'label_block' => true,
        'conditions' => [
          'terms' => [
            [
              'name' => 'custom_messages',
              'operator' => 'in',
              'value' => [
                'yes',
              ],
            ],
          ],
        ],
			]
    );

    $this->add_control(
			'error_message',
			[
				'label' => __( 'Error Message', 'pardotmarketing' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'label_block' => true,
        'conditions' => [
          'terms' => [
            [
              'name' => 'custom_messages',
              'operator' => 'in',
              'value' => [
                'yes',
              ],
            ],
          ],
        ],
			]
    );

    $this->end_controls_section();
  }

  /**
   * Render the widget output on the frontend.
   *
   * Written in PHP and used to generate the final HTML.
   *
   * @since 1.1.0
   *
   * @access protected
   */
  protected function render() {
    $settings = $this->get_settings_for_display();

    if ( $settings['fields'] ) {
      echo '<div class="pardotmarketing-form-widget">';

      if ( ! empty( $_REQUEST['error'] ) ) {
        ?>
        <div class="pardotmarketing-msg pardotmarketing-msg--error">
          <?php if ( $settings['custom_messages'] == 'yes' && $settings['error_message'] ) { ?>
            <p><?php echo $settings['error_message']; ?></p>
          <?php } elseif( ! empty( $_REQUEST['errorMessage'] ) ) { ?>
            <p><?php echo $_REQUEST['errorMessage']; ?></p>
          <?php } else { ?>
            <p><?php _e( 'There was a problem submitting the form. Please try again.', 'pardotmarketing' ); ?></p>
          <?php } ?>
        </div>
        <?php
      }

      if ( ! empty( $_REQUEST['success'] ) ) {
        ?>
        <div class="pardotmarketing-msg pardotmarketing-msg--success">
          <?php if ( $settings['custom_messages'] == 'yes' && $settings['success_message'] ) { ?>
            <p><?php echo $settings['success_message']; ?></p>
          <?php } else { ?>
            <p><?php _e( 'Form submitted successfully.', 'pardotmarketing' ); ?></p>
          <?php } ?>
        </div>
        <?php
      }

      echo '<form class="pardotmarketing-form" data-url="' . $settings['endpoint']['url'] . '">';

      if ( $settings['popup_trigger'] ) {
        ?>
        <input type="hidden" name="popup" value="<?php echo esc_attr(  $settings['popup_trigger'] ); ?>">
        <?php
      }

      echo '<div class="pardotmarketing-fields">';
      foreach (  $settings['fields'] as $field ) {
        $value = $field['value'] ? $field['value'] : false;
        if ( ! empty( $_REQUEST[ $field['key'] ] ) ) {
          $value = $_REQUEST[ $field['key'] ];
        }

        $classes = [ 'pardotmarketing-field' ];

        if ( $field['width'] ) {
          $classes[] = 'pardotmarketing-field--width-' . $field['width'];
        }

        if ( $field['width_tablet'] ) {
          $classes[] = 'pardotmarketing-field--width-tablet-' . $field['width_tablet'];
        }

        if ( $field['width_mobile'] ) {
          $classes[] = 'pardotmarketing-field--width-mobile-' . $field['width_mobile'];
        }

        if ( $field['type'] != 'hidden' ) {
          echo '<div class="' . implode( ' ', $classes ) . '">';

          if ( $field['type'] != 'checkbox' ) {
            echo '<label class="pardotmarketing-label"><span class="pardotmarketing-label-txt">' . $field['label'] . '</span>';
          } else {
            echo '<div class="pardotmarketing-label"><span class="pardotmarketing-label-txt">' . $field['label'] . '</span>';
          }
        }

        switch( $field['type'] ) {
          case 'tel':
          case 'text':
          case 'url':
          case 'email':
          case 'hidden':
            ?>
            <input class="pardotmarketing-input" type="<?php echo $field['type']; ?>" name="<?php echo $field['key']; ?>"<?php if ( $field['placeholder'] ) { ?> placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>"<?php } ?><?php if ( $value ) { ?> value="<?php echo esc_attr( $value ); ?>"<?php } ?><?php if ( $field['required'] ) { ?> required<?php } ?>>
            <?php
          break;
          case 'textarea':
            ?>
            <textarea rows="<?php echo $field['rows']; ?>" class="pardotmarketing-input" name="<?php echo $field['key']; ?>"<?php if ( $field['placeholder'] ) { ?> placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>"<?php } ?><?php if ( $field['required'] ) { ?> required<?php } ?>><?php echo $value; ?></textarea>
            <?php
          break;
          case 'checkbox':
            if ( $field['inline'] == 'yes' ) {
              echo '<div class="pardotmarketing-checkboxes pardotmarketing-checkboxes--inline">';
            } else {
              echo '<div class="pardotmarketing-checkboxes">';
            }
            $options = explode( "\n", $field['options'] );
            $name = $field['key'];
            if ( count( $options ) > 1 ) {
              $name = $field['key'] . '[]';
            }
            foreach( $options as $key => $val ) {
              $option = explode( '|', $val );
              ?>
              <div class="pardotmarketing-checkbox"><input type="checkbox" id="<?php echo sanitize_title_with_dashes( $name . '-' . $option[0]); ?>" value="<?php echo esc_attr( $option[0] ); ?>"<?php if ( $value == $option[0] ) { ?> checked="checked"<?php } ?> name="<?php echo esc_attr( $name ); ?>" class="pardotmarketing-checkbox-input"> <label for="<?php echo sanitize_title_with_dashes( $name . '-' . $option[0]); ?>"><?php echo ! empty( $option[1] ) ? esc_attr( $option[1] ) : esc_attr( $option[0] ); ?></label></div>
              <?php
            }
            echo '</div>';
          break;
          case 'select':
            ?>
            <select name="<?php echo $field['key']; ?>" class="pardotmarketing-input"<?php if ( $field['required'] ) { ?> required<?php } ?>>
              <?php
              $options = explode( "\n", $field['options'] );
              foreach( $options as $key => $val ) {
                $option = explode( '|', $val );
                ?>
                <option value="<?php echo esc_attr( $option[0] ); ?>[]"<?php if ( $value == $option[0] ) { ?> selected="selected"<?php } ?>><?php echo ! empty( $option[1] ) ? esc_attr( $option[1] ) : esc_attr( $option[0] ); ?></option>
                <?php
              }
              ?>
            </select>
            <?php
          break;
        }
        if ( $field['type'] != 'hidden' ) {
          if ( $field['type'] != 'checkbox' ) {
            echo '</label>';
          } else {
            echo '</div>';
          }

          echo '</div>';
        }
      }

      $classes = [ 'pardotmarketing-field' ];
      if ( $settings['submit_width'] ) {
        $classes[] = 'pardotmarketing-field--width-' . $settings['submit_width'];
      }

      if ( $settings['submit_width_tablet'] ) {
        $classes[] = 'pardotmarketing-field--width-tablet-' . $settings['submit_width_tablet'];
      }

      if ( $settings['submit_width_mobile'] ) {
        $classes[] = 'pardotmarketing-field--width-mobile-' . $settings['submit_width_mobile'];
      }
      echo '<div class="' . implode( ' ', $classes ) . '">';
        ?>
        <button type="submit" class="pardotmarketing-button"><?php echo $settings['submit_text']; ?></button>
        <?php
      echo '</div>';

      echo '</div>';
      echo '</form>';
      echo '</div>';
    }
    ?>

    <?php
  }

  /**
   * Render the widget output in the editor.
   *
   * Written as a Backbone JavaScript template and used to generate the live preview.
   *
   * @since 1.1.0
   *
   * @access protected
   */
  protected function _content_template() {
    ?>
    <?php _e( 'Live preview is unavailable for this widget.', 'pardotmarketing' ); ?>
    <?php
  }
}
