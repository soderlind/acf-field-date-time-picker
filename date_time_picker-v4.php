<?php

class acf_field_date_time_picker extends acf_field
{
	// vars
	var $settings   // will hold info such as dir / path
		, $defaults // will hold default field options
		, $domain   // holds the language domain
		, $lang;
		
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
		$this->category = __("jQuery", $this->domain); // Basic, Content, Choice, etc
		$this->domain = 'acf-date_time_picker';
		$this->defaults = array(
			'value'              => ''
			, 'label'            => __( 'Choose Time', $this->domain )
			, 'time_format'      => 'hh:mm'
			, 'show_date'        => true
			, 'date_format'      => 'mm/dd/yy'
			, 'show_week_number' => false
			, 'picker'           => 'slider'
			, 'language'         => 'en'
		);

		
		
		// do not delete!
    	parent::__construct();
    	
    	
    	// settings
		$this->settings = array(
			'path'      => apply_filters('acf/helpers/get_path', __FILE__)
			, 'dir'     => apply_filters('acf/helpers/get_dir', __FILE__)
			, 'version' => '2.0.4'
		);

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
	
	function create_options( $field )
	{
		$field = array_merge($this->defaults, $field);
		$key = $field['name'];
		?>
		<tr class="field_option field_option_<?php echo $this->name; ?> timepicker_choice">
			<td class="label">
				<label for=""><?php _e( "Date and Time Picker?", $this->domain ); ?></label>
			</td>
			<td>
				<?php
				do_action('acf/create_field', array(
						'type'      => 'radio'
						, 'name'    => 'fields['.$key.'][show_date]'
						, 'value'   => $field['show_date']
						, 'layout'  => 'horizontal'
						, 'choices' => array(
								'true'    => __( 'Date and Time Picker', $this->domain )
								, 'false' => __( 'Time Picker', $this->domain )
						)
					) );
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?> timepicker_dateformat">
			<td class="label">
				<label><?php _e( "Date Format", $this->domain ); ?></label>
				<p class="description"><?php printf(__("eg. mm/dd/yy. read more about <a href=\"%s\" target=\"_blank\">formatting  date</a>", $this->domain ),"http://docs.jquery.com/UI/Datepicker/formatDate");?></p>
			</td>
			<td>
				<?php
				do_action('acf/create_field', array(
						'type'    => 'text'
						, 'name'  => 'fields[' . $key . '][date_format]'
						, 'value' => $field['date_format']
					) );
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?> timepicker_timeformat">
			<td class="label">
				<label><?php _e( "Time Format", $this->domain );?></label>
				<p class="description"><?php printf(__("eg. hh:mm. read more about <a href=\"%s\" target=\"_blank\">formatting  time</a>", $this->domain ),"http://trentrichardson.com/examples/timepicker/#tp-formatting");?></p>
			</td>
			<td>
				<?php
				do_action('acf/create_field', array(
						'type'    => 'text'
						, 'name'  => 'fields[' . $key . '][time_format]'
						, 'value' => $field['time_format']
					) );
				?>
		   </td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?> timepicker_week_number">
			<td class="label">
				<label for=""><?php _e( "Display Week Number?", $this->domain ); ?></label>
			</td>
			<td>
				<?php
				do_action('acf/create_field', array(
						'type'      => 'radio'
						, 'name'    => 'fields['.$key.'][show_week_number]'
						, 'value'   => $field['show_week_number']
						, 'layout'  => 'horizontal'
						, 'choices' => array(
								'true'    => __( 'Yes', $this->domain )
								, 'false' => __( 'No', $this->domain )
						)
					) );
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?> timepicker_week_number">
			<td class="label">
				<label for=""><?php _e( "Time Picker style?", $this->domain ); ?></label>
			</td>
			<td>
				<?php
				do_action('acf/create_field', array(
						'type'      => 'radio'
						, 'name'    => 'fields['.$key.'][picker]'
						, 'value'   => $field['picker']
						, 'layout'  => 'horizontal'
						, 'choices' => array(
								'slider'   => __( 'Slider', $this->domain )
								, 'select' => __( 'Dropdown', $this->domain )
						)
					) );
				?>
			</td>
		</tr>
		<?php /* ?>
		<tr class="field_option field_option_<?php echo $this->name; ?> timepicker_week_number">
			<td class="label">
				<label for=""><?php _e( "Time Picker language?", $this->domain ); ?></label>
			</td>
			<td>
				<?php
				$dir_path = $this->settings['path'] . 'js/localization/';
				$exclude_list = array(".", "..");
				$languages = preg_filter("/jquery-ui-timepicker-(.*?)\.js/","$1",array_diff(scandir($dir_path), $exclude_list));				
				$locales["en"] = "en";
				foreach ($languages as $k => $v) {
					$locales[$v] = $v;
				}
				asort($locales);
				$locales["unknown"] = 'Use: "lang/' . $this->domain . '-' . get_locale() . '.mo"';

				do_action('acf/create_field', array(
						'type'      => 'select'
						, 'name'    => 'fields['.$key.'][language]'
						, 'value'   => $field['language']
						, 'choices' => $locales
					) );
				?>
			</td>
		</tr> 
		<?php */?> 
		<?php
		
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
	
	function create_field( $field ) {
		$field = array_merge( $this->defaults, $field );
		extract( $field, EXTR_SKIP ); //Declare each item in $field as its own variable i.e.: $name, $value, $label, $time_format, $date_format and $show_week_number

		if ( $show_date != 'true' ) {
			echo '<input type="text" name="' . $name . '" class="time_picker" value="' . $value . '" data-picker="' . $picker . '" data-time_format="' . $time_format . '"  title="' . $label . '" />';
		} else {
			echo '<input type="text" name="' . $name . '" class="time_picker" value="' . $value . '" data-picker="' . $picker . '" data-date_format="' . $date_format . '" data-time_format="' . $time_format . '" data-show_week_number="' . $show_week_number . '"  title="' . $label . '" />';
		}
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

		wp_enqueue_script( 'jquery-ui-timepicker', $this->settings['dir'] . 'js/jquery-ui-timepicker-addon.js', array(
				'jquery-ui-datepicker',
				'jquery-ui-slider'
		), $this->settings['version'], true );	

		if ( file_exists(  $this->settings['path'] . '/js/localization/jquery-ui-timepicker-' . $js_locale . '.js' ) ) {
			wp_enqueue_script( 'timepicker-localization', $this->settings['dir'] . 'js/localization/jquery-ui-timepicker-' . $js_locale . '.js', array(
				'jquery-ui-timepicker'
			), $this->settings['version'], true );
			wp_enqueue_script( 'timepicker', $this->settings['dir'] . 'js/timepicker.js', array(
				'timepicker-localization'
			), $this->settings['version'], true );
			$has_locale = true;
		} else {
			wp_enqueue_script( 'timepicker', $this->settings['dir'] . 'js/timepicker.js', array(
				'jquery-ui-timepicker'
			), $this->settings['version'], true );
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

		wp_enqueue_style('jquery-style', $this->settings['dir'] . 'css/jquery-ui.css'); 
		wp_enqueue_style('timepicker',  $this->settings['dir'] . 'css/jquery-ui-timepicker-addon.css',array(
			'jquery-style'
		),$this->settings['version']);
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
		$dir_path = $this->settings['path'] . 'js/localization/';
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