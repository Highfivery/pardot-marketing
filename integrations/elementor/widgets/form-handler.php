<?php
namespace PardotMarketing\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class FormHandler extends Widget_Base {

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
    return 'pardotmarketing-form-handler';
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
    return __( 'Pardot Form Handler', 'pardotmarketing' );
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
    return 'fab fa-salesforce';
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
    return [ 'general' ];
  }

  public function get_style_depends() {
    $styles = apply_filters( 'pardotmarketing_form_handler_styles_filter', [ 'pardotmarketing-form-handler' ] );

    return $styles;
  }

  public function get_script_depends() {
    $scripts = apply_filters( 'pardotmarketing_form_handler_scripts_filter', [ 'pardotmarketing-jquery-validation' ] );

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
        'description' => __( 'Copy & paste the Pardot form handler endpoint URL.', 'pardotmarketing' ),
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
			'key',
			[
				'label' => __( 'External Field Name', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __( 'i.e. first_name', 'pardotmarketing' ),
        'description' => __( "Found of the form handler summary page under 'Form Field Mappings'", 'pardotmarketing' )
			]
    );

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
        'description' => __( 'Enter each option on a separate line. To differentiate between label and value, separate them with a pipe character ("|"). For example: First Name|f_name', 'pardotmarketing' ),
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
			'inline',
			[
				'label' => __( 'Display Horizontally', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pardotmarketing' ),
				'label_off' => __( 'No', 'pardotmarketing' ),
				'return_value' => 'yes',
        'default' => 'no',
        'conditions' => [
          'terms' => [
            [
              'name' => 'type',
              'operator' => 'in',
              'value' => [
                'checkbox'
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
			'minlength',
			[
				'label' => __( 'Min. Character Length', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'step' => 1,
        'default' => '',
        'conditions' => [
          'terms' => [
            [
              'name' => 'type',
              'operator' => 'in',
              'value' => [
                'text', 'tel', 'textarea'
              ],
            ],
          ],
        ],
			]
    );

    $repeater->add_control(
			'maxlength',
			[
				'label' => __( 'Max. Character Length', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'step' => 1,
        'default' => '',
        'conditions' => [
          'terms' => [
            [
              'name' => 'type',
              'operator' => 'in',
              'value' => [
                'text', 'tel', 'textarea'
              ],
            ],
          ],
        ],
			]
		);

    $repeater->add_responsive_control(
			'width',
			[
				'label' => __( 'Column Width', 'pardotmarketing' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
					'auto'  => __( 'Default', 'pardotmarketing' ),
					'100%' => __( '100%', 'pardotmarketing' ),
					'80%' => __( '80%', 'pardotmarketing' ),
          '75%' => __( '75%', 'pardotmarketing' ),
          '66%' => __( '66%', 'pardotmarketing' ),
          '60%' => __( '60%', 'pardotmarketing' ),
          '50%' => __( '50%', 'pardotmarketing' ),
          '40%' => __( '40%', 'pardotmarketing' ),
          '33%' => __( '33%', 'pardotmarketing' ),
          '25%' => __( '25%', 'pardotmarketing' ),
          '20%' => __( '20%', 'pardotmarketing' ),
        ],
        'desktop_default' => 'auto',
				'tablet_default' => 'auto',
				'mobile_default' => 'auto',
        'devices' => [ 'desktop', 'tablet', 'mobile' ],
        'selectors' => [
          '(desktop) {{WRAPPER}} {{CURRENT_ITEM}}' => 'width: {{VALUE}};',
          //'(tablet) {{WRAPPER}} {{CURRENT_ITEM}} .pardotmarketing-form-handler-field' => 'width: {{width_tablet.VALUE}};',
          //'(mobile) {{WRAPPER}} {{CURRENT_ITEM}} .pardotmarketing-form-handler-field' => 'width: {{width_mobile.VALUE}};',
				],
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

    $this->add_control(
			'fields',
			[
				'label' => __( 'Pardot Form Handler Fields', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ label }}}',
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
					'auto'  => __( 'Default', 'pardotmarketing' ),
					'100%' => __( '100%', 'pardotmarketing' ),
					'80%' => __( '80%', 'pardotmarketing' ),
          '75%' => __( '75%', 'pardotmarketing' ),
          '66%' => __( '66%', 'pardotmarketing' ),
          '60%' => __( '60%', 'pardotmarketing' ),
          '50%' => __( '50%', 'pardotmarketing' ),
          '40%' => __( '40%', 'pardotmarketing' ),
          '33%' => __( '33%', 'pardotmarketing' ),
          '25%' => __( '25%', 'pardotmarketing' ),
          '20%' => __( '20%', 'pardotmarketing' ),
        ],
        'desktop_default' => 'auto',
				'tablet_default' => 'auto',
				'mobile_default' => 'auto',
        'devices' => [ 'desktop', 'tablet', 'mobile' ],
        'selectors' => [
          '(desktop) {{WRAPPER}} .pardotmarketing-form-handler-field-submit' => 'width: {{VALUE}};',
          '(tablet) {{WRAPPER}} .pardotmarketing-form-handler-field-submit' => 'width: {{submit_width_tablet.VALUE}};',
          '(mobile) {{WRAPPER}} .pardotmarketing-form-handler-field-submit' => 'width: {{submit_width_mobile.VALUE}};',
				],
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
			'form_id',
			[
				'label' => __( 'Form ID', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __( 'new_form_id', 'pardotmarketing' ),
        'description' => __( "Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows A-z 0-9 & underscore chars without spaces.", 'pardotmarketing' )
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
        'default' => __( 'The form has been successfully submitted.', 'pardotmarketing' ),
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
        'default' => __( 'The was a problem submitting the form.', 'pardotmarketing' ),
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

    $this->start_controls_section(
			'form_section',
			[
				'label' => __( 'Form', 'pardotmarketing' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
    );

    $this->add_control(
			'column_gap',
			[
				'label' => __( 'Column Gap', 'pardotmarketing' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'rem' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .pardotmarketing-form-handler-field' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
				],
			]
    );

    $this->add_control(
			'rows_gap',
			[
				'label' => __( 'Rows Gap', 'pardotmarketing' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'rem' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
          ],
          'rem' => [
            'min' => 0,
						'max' => 10,
						'step' => 0.5,
          ]
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
          '{{WRAPPER}} .pardotmarketing-form-handler-field' => 'margin-bottom: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .pardotmarketing-form-handler-fields' => 'margin-bottom: -{{SIZE}}{{UNIT}};',
				],
			]
    );

    $this->end_controls_section();

    $this->start_controls_section(
			'button_section',
			[
				'label' => __( 'Button', 'pardotmarketing' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
    );

    $this->start_controls_tabs(
			'button_style_tabs'
		);

    $this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => __( 'Normal', 'pardotmarketing' ),
			]
		);

    $this->add_control(
			'button_bg_color',
			[
				'label' => __( 'Background Color', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .pardotmarketing-form-handler-button' => 'background-color: {{VALUE}}',
				],
			]
    );

    $this->add_control(
			'button_txt_color',
			[
				'label' => __( 'Text Color', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .pardotmarketing-form-handler-button' => 'color: {{VALUE}}',
				],
			]
    );

    $this->end_controls_tab();

    $this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => __( 'Hover', 'pardotmarketing' ),
			]
    );

    $this->add_control(
			'button_bg_color_hover',
			[
				'label' => __( 'Background Color', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .pardotmarketing-form-handler-button:hover' => 'background-color: {{VALUE}}',
				],
			]
    );

    $this->add_control(
			'button_txt_color_hover',
			[
				'label' => __( 'Text Color', 'pardotmarketing' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .pardotmarketing-form-handler-button:hover' => 'color: {{VALUE}}',
				],
			]
    );

    $this->end_controls_tab();

    $this->add_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'pardotmarketing' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .pardotmarketing-form-handler-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

    $this->add_control(
			'button_text_padding',
			[
				'label' => __( 'Text Padding', 'pardotmarketing' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .pardotmarketing-form-handler-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
    );

    $this->end_controls_tabs();

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
    if ( ! $settings['fields'] ) { return; }

    // Get the spacing
    $column_spacing = $settings['column_gap']['size'] / 2;
    $rows_spacing   = $settings['rows_gap']['size'];
    $grid_offset    = ( $column_spacing * -1 ) . $settings['column_gap']['unit'];

    do_action('pardotmarketing_before_form_handler');
    ?>
    <div class="pardotmarketing-form-handler">
      <form
        class="pardotmarketing-form-handler-form"
        method="post"
        data-url="<?php echo esc_url( $settings['endpoint']['url'] ); ?>"
        <?php if ( ! empty( $settings['form_id'] ) ): ?>id="<?php echo esc_attr( $settings['form_id'] ); ?>"<?php endif; ?>
      >
        <?php do_action('pardotmarketing_form'); ?>
        <?php if ( ! empty( $_REQUEST['errors'] ) ): ?>
          <div class="pardotmarketing-form-handler-message pardotmarketing-form-handler-error">
            <?php if ( $settings['custom_messages'] == 'yes' && $settings['error_message'] ): ?>
              <p><?php echo $settings['error_message']; ?></p>
            <?php elseif( ! empty( $_REQUEST['errorMessage'] ) ): ?>
              <p><?php echo $_REQUEST['errorMessage']; ?></p>
            <?php else: ?>
              <p><?php _e( 'There was a problem submitting the form. Please try again.', 'pardotmarketing' ); ?></p>
            <?php endif; ?>
          </div>
        <?php endif; ?>
        <div class="pardotmarketing-form-handler-fields">
          <?php
          foreach( $settings['fields'] as $field ):
            // Get the field value
            $value = ! empty( $field['value'] ) ? $field['value'] : false;
            if ( ! empty( $_REQUEST[ $field['key'] ] ) ):
              $value = $_REQUEST[ $field['key'] ];
            endif;

            // Add the field container
            if( $field['type'] != 'hidden' ):
              ?>
              <div class="pardotmarketing-form-handler-field elementor-repeater-item-<?php echo $field['_id']; ?>">
            <?php endif; ?>

            <?php
            // Add the field label
            if( $field['type'] != 'hidden' ):
              $label_classes = [ 'pardotmarketing-form-handler-label' ];
              ?>
              <label class="pardotmarketing-form-handler-label" for="pardotmarketing-form-handler-<?php echo esc_attr( $field['key'] ); ?>">
                <?php echo $field['label']; ?>
              </label>
            <?php endif; ?>

            <?php
            // Output the field
            switch( $field['type'] ):
              case 'tel':
              case 'text':
              case 'url':
              case 'email':
              case 'hidden':
                ?>
                <input
                  class="pardotmarketing-form-handler-input"
                  type="<?php echo $field['type']; ?>"
                  name="<?php echo esc_attr( $field['key'] ); ?>"
                  id="pardotmarketing-form-handler-<?php echo esc_attr( $field['key'] ); ?>"
                  <?php if ( ! empty( $field['minlength'] ) ): ?>minlength="<?php echo intval( $field['minlength'] ); ?>"<?php endif; ?>
                  <?php if ( ! empty( $field['maxlength'] ) ): ?>maxlength="<?php echo intval( $field['maxlength'] ); ?>"<?php endif; ?>
                  <?php if ( $field['placeholder'] ): ?> placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>"<?php endif; ?>
                  <?php if ( $value ): ?> value="<?php echo esc_attr( $value ); ?>"<?php endif; ?>
                  <?php if ( $field['required'] ): ?> required<?php endif; ?>
                >
                <?php
              break;
              case 'textarea':
                ?>
                <textarea
                  rows="<?php echo $field['rows']; ?>"
                  class="pardotmarketing-form-handler-input"
                  name="<?php echo esc_attr( $field['key'] ); ?>"
                  id="pardotmarketing-form-handler-<?php echo esc_attr( $field['key'] ); ?>"
                  <?php if ( ! empty( $field['minlength'] ) ): ?>minlength="<?php echo intval( $field['minlength'] ); ?>"<?php endif; ?>
                  <?php if ( ! empty( $field['maxlength'] ) ): ?>maxlength="<?php echo intval( $field['maxlength'] ); ?>"<?php endif; ?>
                  <?php if ( $field['placeholder'] ): ?> placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>"<?php endif; ?>
                  <?php if ( $field['required'] ): ?> required<?php endif; ?>><?php echo trim( $value ); ?></textarea>
                <?php
              break;
              case 'select':
                ?>
                <select
                  name="<?php echo esc_attr( $field['key'] ); ?>"
                  class="pardotmarketing-form-handler-select"
                  <?php if ( $field['required'] ): ?> required<?php endif; ?>
                >
                  <?php
                  $options = explode( "\n", $field['options'] );
                  foreach( $options as $key => $val ):
                    $option = explode( '|', $val );
                    ?>
                    <option
                      value="<?php echo esc_attr( $option[0] ); ?>"
                      <?php if ( $value == $option[0] ): ?> selected="selected"<?php endif; ?>
                    >
                      <?php echo ! empty( $option[1] ) ? esc_attr( $option[1] ) : esc_attr( $option[0] ); ?>
                    </option>
                    <?php
                  endforeach;
                  ?>
                </select>
                <?php
              break;
              case 'checkbox':
                $options_classes = [ 'pardotmarketing-form-handler-options' ];

                if ( $field['inline'] == 'yes' ):
                  $options_classes[] = 'pardotmarketing-form-handler-options-inline';
                endif;
                ?>
                <div class="<?php echo implode( ' ', $options_classes ); ?>">
                  <?php
                  $options = explode( "\n", $field['options'] );
                  $name    = $field['key'];

                  // If more than one option, send as an array
                  if ( count( $options ) > 1 ):
                    $name = $field['key'] . '[]';
                  endif;

                  $option_count = 0;
                  foreach( $options as $key => $val ):
                    $option_count++;
                    $option    = explode( '|', $val );
                    $option_id = 'pardotmarketing-form-handler-' . esc_attr( $field['key'] . '-' . $option_count );
                    ?>
                    <div class="pardotmarketing-form-handler-option">
                      <input
                        type="<?php echo $field['type']; ?>"
                        id="<?php echo $option_id; ?>"
                        value="<?php echo esc_attr( $option[0] ); ?>"
                        <?php if ( $value == $option[0] ): ?> checked="checked"<?php endif; ?>
                        name="<?php echo esc_attr( $name ); ?>"
                        class="pardotmarketing-form-handler-option-input"
                      >
                      <label for="<?php echo $option_id; ?>">
                        <?php echo ! empty( $option[1] ) ? esc_attr( $option[1] ) : esc_attr( $option[0] ); ?>
                      </label>
                    </div>
                    <?php
                  endforeach;
                  ?>
                </div>
                <?php
              break;
            endswitch;
            ?>
            <?php if( $field['type'] != 'hidden' ): ?></div><?php endif; ?>
          <?php endforeach; ?>
          <div class="pardotmarketing-form-handler-field pardotmarketing-form-handler-field-submit">
            <button
              type="submit"
              class="pardotmarketing-form-handler-button"
            ><?php echo $settings['submit_text']; ?></button>
          </div>
        </div>
      </form>
      <script>
      (function( $ ) {
        'use strict';

        var PardotMarketingForms = {
          init: function() {
            var $forms = $('.pardotmarketing-form-handler-form');

            $forms.each(function() {
              var $form = $( this );

              $form.validate({
                <?php
                $options = apply_filters( 'pardotmarketing_form_handler_validation_options_filter_' . $settings['form_id'], [
                  'submitHandler' => 'function(form) {
                    $form.addClass("pardotmarketing-form-handler-form-is-submitting");
                    $(this).attr("action", $(this).data("url"));

                    $(this).unbind("submit").submit();
                  }'
                ]);

                if ( $options ):
                  foreach( $options as $key => $value ):
                    ?>
                    '<?php echo $key; ?>': <?php echo $value; ?>
                    <?php
                  endforeach;
                endif;
                ?>
              });
            });
          },
        };

        $(function() {
          PardotMarketingForms.init();
        });
      })(jQuery);
      </script>
    </div>
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

    <?php
  }
}
