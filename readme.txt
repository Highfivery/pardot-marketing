=== Pardot Marketing ===
Contributors: bmarshall511
Tags: pardot, marketing, elementor, elementor widget
Donate link: https://benmarshall.me/donate/?utm_source=pardot_marketing&utm_medium=wordpress_repo&utm_campaign=donate
Requires at least: 5.2
Tested up to: 5.7
Requires PHP: 7.3
Stable tag: 1.1.3
License: GNU GPLv3
License URI: https://choosealicense.com/licenses/gpl-3.0/

Pardot Marketing is a Pardot Form Handler-friendly & Elementor widgetized WordPress plugin. Say good-bye to those constraining Form Handler embeds!

== Description ==

Pardot Marketing is the Pardot plugin on steroids. It provides sites the ability to add completely customizable [Form Handlers](https://www.pardot.com/training/form-handlers-15-introduction-to-form-handlers/) vs. the annoying and constraining embeds with iframes. Easily add as many fields as you need, structure any way you'd like, style to fit your design, then match them to the Pardot Form Field Mappings in the Form Handler settings.

Pardot Marketing is a Pardot Form Handler-friendly & Elementor widgetized WordPress plugin. Say good-bye to those annoying & ugly Form Handler embeds.

= Plugin Features =

* Custom Pardot user roles & capabilites to control access (see FAQ)
* View Pardot prospects on-site
* Easy-to-use Form Handler Elementor widget
* Style Form Handlers to match your theme
* Real-time user input validation
* Create your own validation rules, including checking remote sources
* Pre-defined country select dropdown available
* Inject URL parameters and browser cookies into form fields (e.g. utm_source, utm_campaign, etc)
* Custom error & success messages with the ability to hide the form after success
* Integrate with any theme or plugin using custom actions & filters
* more coming soon...

Have a question, comment or suggestion? Feel free to [contact me](https://benmarshall.me/contact/?utm_source=wordpress.org&utm_medium=plugin&utm_campaign=pardot_marketing), follow me [on Twitter](https://twitter.com/bmarshall0511) or [visit my site](https://benmarshall.me/?utm_source=wordpress.org&utm_medium=plugin&utm_campaign=pardot_marketing).

== Installation ==

1. Upload the entire pardot-marketing folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the Plugins screen (Plugins > Installed Plugins).

For more information, see the [plugin’s website](https://benmarshall.me/pardot-marketing).

== Frequently Asked Questions ==

= What user roles are available? =

* Pardot Administrator (<code>pardotmarketing_admin</code>) - Inherits WP admin & all Pardot Marketing capabilities

= What user capabilites are there? =

* <code>pardotmarketing_read_prospects</code> - Allows access to the Pardot Prospects admin screen

= How do I add my own field validation rules? =

Pardot Marketing uses the [jQuery Validation plugin](https://jqueryvalidation.org/) to handle & add custom valdations. You can add your own by using the `pardotmarketing_form_handler_scripts_filter` to add your own JS that can extend the form rules or inject your own JS rules via the `pardotmarketing_form_handler_validation_options_filter_[form_id]` filter.

= Where should Pardot's Form Handler success and error locations be?  =

You can either create your own pages to direct the user's to a success or error result, or redirect them back to the page where the Form Handler is to display custom messages.

= What action hooks are available? =

* `pardotmarketing_before_form_handler` - Fires before output of a Form Handler Elementor widget.
* `pardotmarketing_pre_form` - Fires right before the opening `form` element in the Form Handler Elementor widgets.
* `pardotmarketing_form` - Fires right after the opening `form` element in the Form Handler Elementor widgets.
* `pardotmarketing_pre_error_msg` - Fires before output of the error message notification.
* `pardotmarketing_error_msg` - Fires right after the opening tag of the error message notification.
* `pardotmarketing_error_post_msg` - Fires at the end of the error message notification, before the closing tag.

= What filters are available? =

* `pardotmarketing_form_handler_styles_filter` - Modifies what registered styles are used when a Form Handler Elementor widget is on the page.
* `pardotmarketing_form_handler_scripts_filter` - Modifies what registered scripts are used when a Form Handler Elementor widget is on the page.
* `pardotmarketing_form_handler_scripts_filter` - Modifies what registered scripts are used when a Form Handler Elementor widget is on the page.
* `pardotmarketing_form_handler_validation_options_filter_[form_id]` - Modifies/adds to the default [jQuery Validation](https://jqueryvalidation.org/) form options. [form_id] should be the value from the form `Form ID` field.

== Changelog ==

= 1.1.3 =

* [Resolves #5](https://github.com/bmarshall511/pardot-marketing/issues/5). Added border styling options to the form handler submit button.
* [Resolves #4](https://github.com/bmarshall511/pardot-marketing/issues/4). Added ability to hide field labels.
* [Resolves #3](https://github.com/bmarshall511/pardot-marketing/issues/3). Added radio field option to the form handlers.

= 1.1.2 =

* Enhancement - Ability to select the submitted value for country select fields (i.e. country name or abbr.)
* Enhancement - Developers now have access to the `pardot_marketing_country_options_WIDGET_ID` filter, see [#1](https://github.com/bmarshall511/pardot-marketing/issues)

= 1.1.1 =

* Fix - Bug when multiple Pardot Form Handler widgets are on the page.

= 1.1.0 =

* Added Prospects & Forms admin dashboard with data pulled from the Pardot API

= 1.0.0 =

* Initial commit
