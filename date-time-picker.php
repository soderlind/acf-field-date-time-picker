<?php

/*
*  my-field.php
*
*  This file acts as a template for creating a new field type in the
*  Advanced Custom Fields plugin.
*
*  @since	4.0.0
*  @date	DD/MM/YYYY
*
*  @info	http://www.advancedcustomfields.com/docs/tutorials/creating-a-new-field-type/
*/

class acf_field_date_time_picker extends acf_field
{
	var $localizationDomain = 'acf_date_time_picker';
	/*
	*  __construct
	*
	*  Set name / label needed for actions / filters
	*
	*  @since	3.6
	*  @date	23/01/13
	*/

	function __construct() {
		// vars
		$this->name = 'date_time_picker';
		$this->label = __( 'Date and Time Picker' );

		$locale = get_locale();
		load_textdomain( $this->localizationDomain, sprintf( "/%s/language/%s-%s.mo", dirname( plugin_basename( __FILE__ ) ), $this->localizationDomain, $locale ) );
		// do not delete!
		parent::__construct();
	}


	/*
	*  load_value()
	*
	*  This filter is appied to the $value after it is loaded from the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value - the value found in the database
	*  @param	$post_id - the $post_id from which the value was loaded from
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the value to be saved in te database
	*/

	function load_value( $value, $post_id, $field ) {
		return $value;
	}


	/*
	*  update_value()
	*
	*  This filter is appied to the $value before it is updated in the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value - the value which will be saved in the database
	*  @param	$field - the field array holding all the field options
	*  @param	$post_id - the $post_id of which the value will be saved
	*
	*  @return	$value - the modified value
	*/

	function update_value( $value, $field, $post_id ) {
		return $value;
	}


	/*
	*  format_value()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is passed to the create_field action
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/

	function format_value( $value, $field ) {
		return $value;
	}


	/*
	*  format_value_for_api()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is passed back to the api functions such as the_field
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/

	function format_value_for_api( $value, $field ) {
		return $value;
	}


	/*
	*  load_field()
	*
	*  This filter is appied to the $field after it is loaded from the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$field - the field array holding all the field options
	*/

	function load_field( $field ) {
		return $field;
	}


	/*
	*  update_field()
	*
	*  This filter is appied to the $field before it is saved to the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*  @param	$post_id - the field group ID (post_type = acf)
	*
	*  @return	$field - the modified field
	*/

	function update_field( $field, $post_id ) {
		return $field;
	}


	/*
	*  create_field()
	*
	*  Create the HTML interface for your field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - an array holding all the field's data
	*/

	function create_field( $field ) {
		$field['value'] = isset( $field['value'] ) ? $field['value'] : '';
		$title = ( isset( $field['label'] ) ) ? ( empty( $field['label'] ) ? '' : $field['label'] ) : __( 'Choose Time', $this->localizationDomain );
		$time_format = ( isset( $field['timepicker_time_format'] ) ) ? ( empty( $field['timepicker_time_format'] ) ? 'hh:mm' : $field['timepicker_time_format'] ) : 'hh:mm';

		if ( $field['timepicker_show_date_format'] != 'true' ) {
			echo '<input type="text" name="' . $field['name'] . '" class="time_picker" value="' . $field['value'] . '" data-time_format="' . $time_format . '"  title="' . $title . '" />';
		} else {
			$date_format = ( isset( $field['timepicker_date_format'] ) ) ? ( empty( $field['timepicker_date_format'] ) ? 'mm/dd/yy' : $field['timepicker_date_format'] ) : 'mm/dd/yy';
			$show_week_number = ( isset( $field['timepicker_show_week_number'] ) ) ? ( empty( $field['timepicker_show_week_number'] ) ? 'false' : $field['timepicker_show_week_number'] ) : 'false';
			echo '<input type="text" name="' . $field['name'] . '" class="time_picker" value="' . $field['value'] . '" data-date_format="' . $date_format . '" data-time_format="' . $time_format . '" data-show_week_number="' . $show_week_number . '"  title="' . $title . '" />';
		}
	}


	/*
	*  create_options()
	*
	*  Create extra options for your field. This is rendered when editing a field.
	*  The value of $field['name'] can be used (like bellow) to save extra data to the $field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field	- an array holding all the field's data
	*/

	function create_options( $field ) {
		$field['timepicker_show_date_format'] = isset( $field['timepicker_show_date_format'] ) ? $field['timepicker_show_date_format'] : 'false';
		$field['timepicker_date_format'] = isset( $field['timepicker_date_format'] ) ? $field['timepicker_date_format'] : 'mm/dd/yy';
		$field['timepicker_time_format'] = isset( $field['timepicker_time_format'] ) ? $field['timepicker_time_format'] : 'hh:mm';
		$field['timepicker_show_week_number'] = isset( $field['timepicker_show_week_number'] ) ? $field['timepicker_show_week_number'] : 'false';

		$key = $field['name'];
		?>
		<tr class="field_option field_option_<?php echo $this->name; ?> timepicker_choice">
			<td class="label">
				<label for=""><?php _e( "Date and Time Picker?", $this->localizationDomain ); ?></label>
			</td>
			<td>
				<?php
				do_action('acf/create_field', array(
						'type' => 'radio',
						'name' => 'fields['.$key.'][timepicker_show_date_format]',
						'value' => $field['timepicker_show_date_format'],
						'layout' => 'horizontal',
						'choices' => array(
							'true' => __( 'Date and Time Picker', $this->localizationDomain ),
							'false' => __( 'Time Picker', $this->localizationDomain )
						)
					) );
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?> timepicker_dateformat">
			<td class="label">
				<label><?php _e( "Date format", $this->localizationDomain ); ?></label>
				<p class="description"><?php printf(__("eg. mm/dd/yy. read more about <a href=\"%s\" target=\"_blank\">formatting  date</a>", $this->localizationDomain ),"http://docs.jquery.com/UI/Datepicker/formatDate");?></p>
			</td>
			<td>
				<?php
				do_action('acf/create_field', array(
						'type' => 'text',
						'name' => 'fields[' . $key . '][timepicker_date_format]',
						'value' => $field['timepicker_date_format']
					) );
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?> timepicker_timeformat">
			<td class="label">
				<label><?php _e( "Time Format", $this->localizationDomain );?></label>
				<p class="description"><?php printf(__("eg. hh:mm. read more about <a href=\"%s\" target=\"_blank\">formatting  time</a>", $this->localizationDomain ),"http://trentrichardson.com/examples/timepicker/#tp-formatting");?></p>
			</td>
			<td>
				<?php
				do_action('acf/create_field', array(
						'type' => 'text',
						'name' => 'fields[' . $key . '][timepicker_time_format]',
						'value' => $field['timepicker_time_format']
					) );
				?>
		   </td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?> timepicker_week_number">
			<td class="label">
				<label for=""><?php _e( "Display Week Number?", $this->localizationDomain ); ?></label>
			</td>
			<td>
				<?php
				do_action('acf/create_field', array(
						'type' => 'radio',
						'name' => 'fields['.$key.'][timepicker_show_week_number]',
						'value' => $field['timepicker_show_week_number'],
						'layout' => 'horizontal',
						'choices' => array(
							'true' => __( 'Yes', $this->localizationDomain ),
							'false' => __( 'No', $this->localizationDomain )
						)
					) );
				?>
			</td>
		</tr>
		<?php

	}


	/*
	*  input_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	*  Use this action to add css + javascript to assist your create_field() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function input_admin_enqueue_scripts() {
		global $wp_locale;

		wp_enqueue_script( 'jquery-ui-timepicker', get_stylesheet_directory_uri() . '/fields/acf-field-date-time-picker/js/jQuery-Timepicker-Addon/jquery-ui-timepicker-addon.js', array(
				'jquery-ui-datepicker',
				'jquery-ui-slider'
			), '1.0.0', true );
		wp_enqueue_script( 'timepicker', get_stylesheet_directory_uri() . '/fields/acf-field-date-time-picker/js/timepicker.js', array(
				'jquery-ui-timepicker'
			), '4.0.0', true );


		wp_enqueue_style('jquery-style', get_stylesheet_directory_uri() . '/fields/acf-field-date-time-picker/css/jquery-ui.css'); 
		wp_enqueue_style('timepicker',  get_stylesheet_directory_uri() . '/fields/acf-field-date-time-picker/js/jQuery-Timepicker-Addon/jquery-ui-timepicker-addon.css',array(
			/*'jquery-style'*/
		),'1.0.0');

		//localize our js, from http://www.renegadetechconsulting.com/tutorials/jquery-datepicker-and-wordpress-i18n (google cache: http://webcache.googleusercontent.com/search?q=cache:LG5-wdUYzZUJ:www.renegadetechconsulting.com/tutorials/jquery-datepicker-and-wordpress-i18n&hl=en&prmd=imvns&strip=1)
		$timepickerArgs = array(
			'closeText'    => __( 'Done', $this->localizationDomain ),
			'currentText'        => __( 'Today', $this->localizationDomain ),
			'prevText'    => __( 'Prev', $this->localizationDomain ),
			'nextText'    => __( 'Next', $this->localizationDomain ),
			'monthNames'         => $this->strip_array_indices( $wp_locale->month ),
			'monthNamesShort'    => $this->strip_array_indices( $wp_locale->month_abbrev ),
			'monthStatus'        => __( 'Show a different month', $this->localizationDomain ),
			'showMonthAfterYear'  => false,
			'dayNames'    => $this->strip_array_indices( $wp_locale->weekday ),
			'dayNamesShort'      => $this->strip_array_indices( $wp_locale->weekday_abbrev ),
			'dayNamesMin'        => $this->strip_array_indices( $wp_locale->weekday_initial ),
			'showWeek'    => false,
			'weekHeader'   => __( 'Wk', $this->localizationDomain ),
			'firstDay'    => get_option( 'start_of_week' ),
			'isRTL'     => $wp_locale->is_rtl(),
			'timeText'      => __( "Time", $this->localizationDomain ),
			'hourText'      => __( "Hour", $this->localizationDomain ),
			'minuteText'    => __( "Minute", $this->localizationDomain ),
			'secondText'    => __( "Second", $this->localizationDomain ),
			'millisecText'    => __( "Millisecond", $this->localizationDomain ),
			'timezoneText'    => __( "Time Zone", $this->localizationDomain ),
			'locale'         => ( '' == get_locale() ) ? 'en' : strtolower( substr( get_locale(), 0, 2 ) ) // only ISO 639-1  (code from class-wp-editor.php)
		);

		// Pass the array to the enqueued JS
		wp_localize_script( 'timepicker', 'timepicker_objectL10n', $timepickerArgs );


	}

	function strip_array_indices( $ArrayToStrip ) {
		foreach ( $ArrayToStrip as $objArrayItem ) {
			$NewArray[] =  $objArrayItem;
		}

		return $NewArray;
	}


	/*
	*  input_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is created.
	*  Use this action to add css and javascript to assist your create_field() action.
	*
	*  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function input_admin_head() {

	}


	/*
	*  field_group_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
	*  Use this action to add css + javascript to assist your create_field_options() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function field_group_admin_enqueue_scripts() {

	}


	/*
	*  field_group_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is edited.
	*  Use this action to add css and javascript to assist your create_field_options() action.
	*
	*  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function field_group_admin_head() {

	}
}


// create field
new acf_field_date_time_picker();


/*--------------------------------------- fuctions.php ----------------------------------------------------

add_action('acf/register_fields', 'date_time_picker_field');

function date_time_picker_field()
{
	include_once('fields/acf-field-date-time-picker/date-time-picker.php');
}
*/

?>
