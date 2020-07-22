=== Pardot Marekting ===
Contributors: bmarshall511
Tags: pardot, marketing, elementor, elementor widget
Donate link: https://benmarshall.me/donate/?utm_source=pardot_marketing&utm_medium=wordpress_repo&utm_campaign=donate
Requires at least: 5.2
Tested up to: 5.4.2
Requires PHP: 7.1
Stable tag: 4.3.8
License: GNU GPLv3
License URI: https://choosealicense.com/licenses/gpl-3.0/

Pardot Marketing is a Pardot Form Handler-friendly & Elementor widgetized WordPress plugin. Say good-bye to those constraining Form Handler embeds!

== Description ==

Pardot Marketing is the Pardot plugin on steroids. It provides sites the ability to add completely customizable [Form Handlers](https://www.pardot.com/training/form-handlers-15-introduction-to-form-handlers/) vs. the annoying and constraining embeds with iframes. Easily add as many fields as you need, structure any way you'd like, style to fit your design, then match them to the Pardot Form Field Mappings in the Form Handler settings.

Pardot Marketing is a Pardot Form Handler-friendly & Elementor widgetized WordPress plugin. Say good-bye to those annoying & ugly Form Handler embeds.

= Plugin Features =

* Style Form Handlers to match your theme
* Real-time user input validation
* Easy-to-use Form Handler Elementor widget
* Custom success & error messages
* more coming soon...

Have a question, comment or suggestion? Feel free to [contact me](https://benmarshall.me/contact/?utm_source=wordpress.org&utm_medium=plugin&utm_campaign=pardot_marketing), follow me [on Twitter](https://twitter.com/bmarshall0511) or [visit my site](https://benmarshall.me/?utm_source=wordpress.org&utm_medium=plugin&utm_campaign=pardot_marketing).

== Installation ==

1. Upload the entire pardot-marketing folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the Plugins screen (Plugins > Installed Plugins).

For more information, see the [plugin’s website](https://benmarshall.me/pardot-marketing).

== Frequently Asked Questions ==

= Where should Pardot's Form Handler success and error locations be?  =

You can either create your own pages to direct the user's to a success or error result, or redirect them back to the page where the Form Handler is to display custom messages.

= What action hooks are available? =

* `pardotmarketing_before_form_handler` - Fires before output of a Form Handler Elementor widget.
* `pardotmarketing_form` - Fires right after the opening `form` element in the Form Handler Elementor widgets.

= What filters are available? =

* `pardotmarketing_form_handler_styles_filter` - Modifies what registered styles are used when a Form Handler Elementor widget is on the page.
* `pardotmarketing_form_handler_scripts_filter` - Modifies what registered scripts are used when a Form Handler Elementor widget is on the page.
* `pardotmarketing_form_handler_scripts_filter` - Modifies what registered scripts are used when a Form Handler Elementor widget is on the page.
* `pardotmarketing_form_handler_validation_options_filter_[form_id]` - Modifies/adds to the default [jQuery Validation](https://jqueryvalidation.org/) form options. [form_id] should be the value from the form `Form ID` field.

== Changelog ==

= 1.0.0 =

* Initial commit
