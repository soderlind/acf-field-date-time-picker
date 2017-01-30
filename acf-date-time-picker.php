<?php
/**
 * Plugin Name: Advanced Custom Fields: Date and Time Picker
 * Plugin URI: https://github.com/soderlind/acf-field-date-time-picker
 * Description: Date and Time Picker field for Advanced Custom Fields
 * Version: 2.1.5
 * Author: Per Soderlind
 * Author URI: http://soderlind.no
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: acf-field-date-time-picker
 * Domain Path: /languages
 */
define( 'ACFFIELDDATETIMEPICKER_VERSION', '2.1.5' );
/**
 * Class acfFieldDateTimePickerPlugin
 */
if ( ! class_exists( 'ACFFieldDateTimePickerPlugin' ) ) :
	class ACFFieldDateTimePickerPlugin {
		/**
		 * Construct
		 *
		 * @description:
		 * @since: 3.6
		 * @created: 1/04/13
		 */
		function __construct() {

			load_plugin_textdomain( 'acf-field-date-time-picker', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
			// version 4+
			add_action( 'acf/register_fields', array( $this, 'register_fields' ) );
			// version 3-
			add_action( 'init', array( $this, 'init' ) );
		}

		/**
		 * Init
		 *
		 * @description:
		 * @since: 3.6
		 * @created: 1/04/13
		 */
		function init() {
			if ( function_exists( 'register_field' ) ) {
				register_field( 'acf_field_date_time_picker', dirname( __File__ ) . '/date-time-picker-v3.php' );
			}
		}

		/**
		 * register_fields
		 *
		 * @description:
		 * @since: 3.6
		 * @created: 1/04/13
		 */
		function register_fields() {
			require_once( 'date-time-picker-v4.php' );
		}
	}

	new ACFFieldDateTimePickerPlugin();
endif;
