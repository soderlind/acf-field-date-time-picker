<?php

class acf_field_date_time_picker extends acf_field
{

	/*
	*  __construct
	*
	*  Set name / label needed for actions / filters
	*
	*  @since	3.6
	*  @date	23/01/13
	*/

	function __construct()
	{
		// vars
		$this->name = 'date_time_picker';
		$this->label = __('Date and Time Picker');
		$this->domain = 'acf-field-date-time-picker';
		$this->category = __("jQuery", $this->domain); // Basic, Content, Choice, etc
		$this->defaults = array(
			 'label'             => __( 'Choose Time', $this->domain )
			, 'time_format'       => 'h:mm tt'
			, 'show_date'         => 'true'
			, 'date_format'       => 'm/d/y'
			, 'show_week_number'  => 'false'
			, 'picker'            => 'slider'
			, 'save_as_timestamp' => 'true'
			, 'get_as_timestamp'  => 'false'
		);

		$this->version = '2.0.15';
		$this->dir = plugin_dir_url( __FILE__ );
		$this->path = plugin_dir_path(__FILE__);

		// do not delete!
    	parent::__construct();
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

	function render_field_settings( $field )
	{
		$field = array_merge($this->defaults, $field);
		$key = $field['name'];
		
		acf_render_field_setting( $field, array(
			'type'      => 'radio'
			, 'label'	=> __( "Date and Time Picker?", $this->domain)
			, 'name'    => 'show_date'
			, 'value'   => $field['show_date']
			, 'layout'  => 'horizontal'
			, 'choices' => array(
			'true'    => __( 'Date and Time Picker', $this->domain )
			, 'false' => __( 'Time Picker', $this->domain )
			)
		) );

		acf_render_field_setting( $field, array(
			'type'    => 'text'
			, 'label' => __( "Date Format", $this->domain )
			, 'instructions'	=> sprintf(__("eg. mm/dd/yy. read more about <a href=\"%s\" target=\"_blank\">formatting  date</a>", $this->domain ),"http://docs.jquery.com/UI/Datepicker/formatDate")
			, 'name'  => 'date_format'
			, 'value' => $field['date_format']
		) );

		acf_render_field_setting( $field, array(
			'type'    => 'text'
			, 'label' => __( "Time Format", $this->domain )
			, 'instructions' => sprintf(__("eg. hh:mm. read more about <a href=\"%s\" target=\"_blank\">formatting  time</a>", $this->domain ),"http://trentrichardson.com/examples/timepicker/#tp-formatting")
			, 'name'  => 'time_format'
			, 'value' => $field['time_format']
		) );

		acf_render_field_setting( $field, array(
			'type'      => 'radio'
			, 'label' 	=> __( "Display Week Number?", $this->domain )
			, 'name'    => 'show_week_number'
			, 'value'   => $field['show_week_number']
			, 'layout'  => 'horizontal'
			, 'choices' => array(
					'true'    => __( 'Yes', $this->domain )
					, 'false' => __( 'No', $this->domain )
			)
		) );

		acf_render_field_setting( $field, array(
			'type'      => 'radio'
			, 'label'	=> __( "Time Picker style?", $this->domain )
			, 'name'    => 'picker'
			, 'value'   => $field['picker']
			, 'layout'  => 'horizontal'
			, 'choices' => array(
					'slider'   => __( 'Slider', $this->domain )
					, 'select' => __( 'Dropdown', $this->domain )
			)
		) );

		acf_render_field_setting( $field, array(
			'type'      => 'radio'
			, 'label'	=> __( "Save as timestamp?", $this->domain )
			, 'instructions' => sprintf( __( "Most users should leave this untouched, only set it to \"No\" if you need a date and time format not supported by <a href=\"%s\" target=\"_blank\">strtotime</a>", $this->domain ), "http://php.net/manual/en/function.strtotime.php" )
			, 'name'    => 'save_as_timestamp'
			, 'value'   => $field['save_as_timestamp']
			, 'layout'  => 'horizontal'
			, 'choices' => array(
					'true'    => __( 'Yes', $this->domain )
					, 'false' => __( 'No', $this->domain )
			)
		) );

		acf_render_field_setting( $field, array(
			'type'      => 'radio'
			, 'label'	=> __( "Get field as timestamp?", $this->domain )
			, 'instructions' => sprintf( __( "Most users should leave this untouched, only set it to \"Yes\" if you need get the  date and time field as a timestamp using  <a href=\"%s\" target=\"_blank\">the_field()</a> or <a href=\"%s\" target=\"_blank\">get_field()</a> ", $this->domain ), "http://www.advancedcustomfields.com/resources/functions/the_field/", "http://www.advancedcustomfields.com/resources/functions/get_field/" )
			, 'name'    => 'get_as_timestamp'
			, 'value'   => $field['get_as_timestamp']
			, 'layout'  => 'horizontal'
			, 'choices' => array(
					'true'    => __( 'Yes', $this->domain )
					, 'false' => __( 'No', $this->domain )
			)
		) );
	}



	/*
	*  create_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field - an array holding all the field's data
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function render_field( $field ) {

		if ( $field['show_date'] !== 'true' ) {
            $value = $field['save_as_timestamp'] && $this->isValidTimeStamp($field['value']) ? date_i18n(sprintf("%s",$this->js_to_php_timeformat($field['time_format'])), $field['value'])  : $field['value'];
            echo '<input type="text" value="' . $value . '" name="' . $field['name'] . '" class="ps_timepicker" value="" data-picker="' . $field['picker'] . '" data-time_format="' . $field['time_format'] . '"  title="' . $field['label'] . '" />';
        } else {
            $value = $field['save_as_timestamp'] && $this->isValidTimeStamp($field['value']) ? $value = date_i18n(sprintf("%s %s", $this->js_to_php_dateformat($field['date_format']),$this->js_to_php_timeformat($field['time_format'])), $field['value'])  : $field['value'];
            echo '<input type="text" value="' . $value . '" name="' . $field['name'] . '" class="ps_timepicker" value="" data-picker="' . $field['picker'] . '" data-date_format="' . $field['date_format'] . '" data-time_format="' . $field['time_format'] . '" data-show_week_number="' . $field['show_week_number'] . '"  title="' . $field['label'] . '" />';
        }
    }

	function format_value($value, $post_id, $field)
	{
		$field = array_merge($this->defaults, $field);

		/*if ($value != '' && $field['save_as_timestamp'] == 'true' && $this->isValidTimeStamp($value)) {
			if ( $field['show_date'] == 'true') {
				 $value = date_i18n(sprintf("%s %s",$this->js_to_php_dateformat($field['date_format']),$this->js_to_php_timeformat($field['time_format'])), $value);
			} else {
				 $value = date_i18n(sprintf("%s",$this->js_to_php_timeformat($field['time_format'])), $value);
			}
		}*/

		if ($value != '' && $field['save_as_timestamp'] == 'true' && $field['get_as_timestamp'] != 'true' && $this->isValidTimeStamp($value)) {
			if ( $field['show_date'] == 'true') {
				 $value = date_i18n(sprintf("%s %s",$this->js_to_php_dateformat($field['date_format']),$this->js_to_php_timeformat($field['time_format'])), $value);
			} else {
				 $value = date_i18n(sprintf("%s",$this->js_to_php_timeformat($field['time_format'])), $value);
			}
		}
		return $value;
	}


	function js_to_php_dateformat($date_format) {
	    $chars = array(
	        // Day
	        'dd' => 'd', 'd' => 'j', 'DD' => 'l','D' => 'D', 'o' => 'z',
	        // Month
	        'mm' => 'm', 'm' => 'n', 'MM' => 'F', 'M' => 'M',
	        // Year
	        'yy' => 'Y', 'y' => 'y',
	    );

	    return strtr((string)$date_format, $chars);
	}


    function js_to_php_timeformat($time_format) {

	    $chars = array(
		    //hour
		    'HH' => 'H', 'H'  => 'G', 'hh' => 'h' , 'h'  => 'g',
		    //minute
		    'mm' => 'i', 'm'  => 'i',
		    //second
		    'ss' => 's', 's' => 's',
		    //am/pm
		    'TT' => 'A', 'T' => 'A', 'tt' => 'a', 't' => 'a'
	    );

	    return strtr((string)$time_format, $chars);
	}


	function isValidTimeStamp($timestamp) {
	    return ((string)(int)$timestamp === (string)$timestamp);
	}

	/*
	*  load_value()
	*
	*  This filter is applied to the $value after it is loaded from the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value found in the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*  @return	$value
	*/
	function load_value( $value, $post_id, $field ) {
		
		$field = array_merge($this->defaults, $field);

		if ($value != '' && $field['save_as_timestamp'] == 'true' && $field['get_as_timestamp'] != 'true' && $this->isValidTimeStamp($value)) {
			if ( $field['show_date'] == 'true') {
				 $value = date_i18n(sprintf("%s %s",$this->js_to_php_dateformat($field['date_format']),$this->js_to_php_timeformat($field['time_format'])), $value);
			} else {
				 $value = date_i18n(sprintf("%s",$this->js_to_php_timeformat($field['time_format'])), $value);
			}
		}
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
	*  @param	$post_id - the $post_id of which the value will be saved
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the modified value
	*/

	// function update_value( $value, $post_id, $field ) {
	// 	$field = array_merge($this->defaults, $field);
	// 	if ($value != '' && $field['save_as_timestamp'] == 'true') {
	// 		$value = strtotime( $value );
	// 	}
	// 	return $value;
	// }

    function update_value( $value, $post_id, $field ) {
        $field = array_merge($this->defaults, $field);
        if ($value != '' && $field['save_as_timestamp'] == 'true') {
            if (preg_match('/^dd?\//',$field['date_format'] )) { //if start with dd/ or d/ (not supported by strtotime())
                $value = str_replace('/', '-', $value);
            }
            $value = strtotime( $value );
        }

        return $value;
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
		

		$has_locale = false;
		$js_locale = $this->get_js_locale(get_locale());

		wp_enqueue_script( 'jquery-ui-timepicker', $this->dir . 'js/jquery-ui-timepicker-addon.js', array(
				'acf-input',
				'jquery-ui-slider'
		), $this->version, true );

		if ( file_exists(  $this->path . 'js/localization/jquery-ui-timepicker-' . $js_locale . '.js' ) ) {
			wp_enqueue_script( 'timepicker-localization', $this->dir . 'js/localization/jquery-ui-timepicker-' . $js_locale . '.js', array(
				'jquery-ui-timepicker'
			), $this->version, true );
			wp_enqueue_script( 'timepicker', $this->dir . 'js/timepicker.js', array(
				'timepicker-localization'
			), $this->version, true );
			$has_locale = true;
		} else {
			wp_enqueue_script( 'timepicker', $this->dir . 'js/timepicker.js', array(
				'jquery-ui-timepicker'
			), $this->version, true );
		}

		if ( ! $has_locale && $js_locale != 'en' ) {
			$timepicker_locale = array(
				'closeText'      => __( 'Done', $this->domain )
				, 'currentText'  => __( 'Today', $this->domain )
				, 'prevText'     => __( 'Prev', $this->domain )
				, 'nextText'     => __( 'Next', $this->domain )
				, 'monthStatus'  => __( 'Show a different month', $this->domain )
				, 'weekHeader'   => __( 'Wk', $this->domain )
				, 'timeText'     => __( "Time", $this->domain )
				, 'hourText'     => __( "Hour", $this->domain )
				, 'minuteText'   => __( "Minute", $this->domain )
				, 'secondText'   => __( "Second", $this->domain )
				, 'millisecText' => __( "Millisecond", $this->domain )
				, 'timezoneText' => __( "Time Zone", $this->domain )
				, 'isRTL'        => $wp_locale->is_rtl()
			);
		}
		$timepicker_wp_locale = array(
			'monthNames'           => $this->strip_array_indices( $wp_locale->month )
			, 'monthNamesShort'    => $this->strip_array_indices( $wp_locale->month_abbrev )
			, 'dayNames'           => $this->strip_array_indices( $wp_locale->weekday )
			, 'dayNamesShort'      => $this->strip_array_indices( $wp_locale->weekday_abbrev )
			, 'dayNamesMin'        => $this->strip_array_indices( $wp_locale->weekday_initial )
			, 'showMonthAfterYear' => false
			, 'showWeek'           => false
			, 'firstDay'           => get_option( 'start_of_week' )
		);

		$l10n = ( isset( $timepicker_locale ) ) ? array_merge( $timepicker_wp_locale, $timepicker_locale ) : $timepicker_wp_locale;
		wp_localize_script( 'timepicker', 'timepicker_objectL10n', $l10n );

		wp_enqueue_style('jquery-style', $this->dir . 'css/jquery-ui.css',array(
			'acf-datepicker'
		),$this->version);
		wp_enqueue_style('timepicker', $this->dir . 'css/jquery-ui-timepicker-addon.css',array(
			'jquery-style'
		),$this->version);
	}

	/**
	 * helper function, see: http://www.renegadetechconsulting.com/tutorials/jquery-datepicker-and-wordpress-i18n
	 * @param  array $ArrayToStrip
	 * @return array
	 */
	function strip_array_indices( $ArrayToStrip ) {
		foreach ( $ArrayToStrip as $objArrayItem ) {
			$NewArray[] =  $objArrayItem;
		}

		return $NewArray;
	}

	function get_js_locale($locale) {
		$dir_path = $this->path . 'js/localization/';
		$exclude_list = array(".", "..");
		$languages = $this->ps_preg_filter("/jquery-ui-timepicker-(.*?)\.js/","$1",array_diff(scandir($dir_path), $exclude_list));

		$locale = strtolower(str_replace("_", "-", $locale));

		if (false !== strpos($locale,'-')) {
			$l = explode("-",$locale);
			$pattern = array('/' .  $locale . '/','/' . $l[0] . '/', '/' . $l[1]  . '/');
		} else {
			$pattern = array('/' . $locale . '/');
		}
		$res = $this->ps_preg_filter($pattern,"$0",$languages,-1,$count);

		return ($count) ? implode("", $res) : 'en';
	}


	function ps_preg_filter ($pattern, $replace, $subject,$limit = -1, &$count = 0) {
		if (function_exists('preg_filter'))
			return preg_filter($pattern, $replace, $subject,$limit,$count);
		else
			return  array_diff(preg_replace($pattern, $replace, $subject,$limit,$count), $subject);
	}


}


// create field
new acf_field_date_time_picker();

?>