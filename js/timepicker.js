/**
 *  Date and Time Picker
 */
(function($){

	function initialize_field( $el ) {

		//$el.doStuff();

	}


	if( typeof acf.add_action !== 'undefined' ) {

		/*
		*  ready append (ACF5)
		*
		*  These are 2 events which are fired during the page load
		*  ready = on page load similar to $(document).ready()
		*  append = on new DOM elements appended via repeater field
		*
		*  @type	event
		*  @date	20/07/13
		*
		*  @param	$el (jQuery selection) the jQuery element which contains the ACF fields
		*  @return	n/a
		*/

		acf.add_action('ready append', function( $el ){
			
			$el.find('input.ps_timepicker').each(function(){
				var input = $(this)
					, is_timeonly = (input.attr('data-date_format') == undefined)
					, date_format = (input.attr('data-date_format') != undefined) ? input.attr('data-date_format') : 'mm/dd/yy'
					, time_format = input.attr('data-time_format')
					, has_ampm = (input.attr('data-time_format').search(/t/i) != -1);

				//don't apply datepicker to clone field
				if (input.parents('.acf-row.clone').length) {
					return;
				}


				input.addClass('active').attr("placeholder", (is_timeonly) ? time_format : date_format + ' ' + time_format).datetimepicker({
					changeYear: true
					, yearRange: "-100:+100"
					, changeMonth: true				
					, timeOnly: is_timeonly
					, timeFormat: time_format
					, dateFormat: date_format
					, showWeek: (input.attr('data-show_week_number') != "true") ? 0 : 1
					, ampm: has_ampm
					, controlType: input.attr('data-picker')
					, timeOnlyTitle: input.attr('title')
					, monthNames: timepicker_objectL10n.monthNames
					, monthNamesShort: timepicker_objectL10n.monthNamesShort
					, dayNames: timepicker_objectL10n.dayNames
					, dayNamesShort: timepicker_objectL10n.dayNamesShort
					, dayNamesMin: timepicker_objectL10n.dayNamesMin
					, firstDay: timepicker_objectL10n.firstDay
				});

				
				if($('body > #ui-datepicker-div').length > 0)
				{
					$('#ui-datepicker-div').wrap('<div class="ui-acf" />');
				}

				// allow null
				input.blur(function(){
					
					if( !input.val() )
					{
						input.val('');
					}
				});
			});

			

		});


	} else {


		/*
		*  acf/setup_fields (ACF4)
		*
		*  This event is triggered when ACF adds any new elements to the DOM. 
		*
		*  @type	function
		*  @since	1.0.0
		*  @date	01/01/12
		*
		*  @param	event		e: an event object. This can be ignored
		*  @param	Element		postbox: An element which contains the new HTML
		*
		*  @return	n/a
		*/

		$(document).live('acf/setup_fields', function(e, postbox){

			$(postbox).find('input.ps_timepicker').each(function(){
				var input = $(this)
					, is_timeonly = (input.attr('data-date_format') == undefined)
					, date_format = (input.attr('data-date_format') != undefined) ? input.attr('data-date_format') : 'mm/dd/yy'
					, time_format = input.attr('data-time_format')
					, has_ampm = (input.attr('data-time_format').search(/t/i) != -1);

				if( acf.helpers.is_clone_field(input) )
				{
					return;
				}


				input.addClass('active').attr("placeholder", (is_timeonly) ? time_format : date_format + ' ' + time_format).datetimepicker({
					changeYear: true
					, yearRange: "-100:+100"
					, changeMonth: true				
					, timeOnly: is_timeonly
					, timeFormat: time_format
					, dateFormat: date_format
					, showWeek: (input.attr('data-show_week_number') != "true") ? 0 : 1
					, ampm: has_ampm
					, controlType: input.attr('data-picker')
					, timeOnlyTitle: input.attr('title')
					, monthNames: timepicker_objectL10n.monthNames
					, monthNamesShort: timepicker_objectL10n.monthNamesShort
					, dayNames: timepicker_objectL10n.dayNames
					, dayNamesShort: timepicker_objectL10n.dayNamesShort
					, dayNamesMin: timepicker_objectL10n.dayNamesMin
					, firstDay: timepicker_objectL10n.firstDay
				});

				
				if($('body > #ui-datepicker-div').length > 0)
				{
					$('#ui-datepicker-div').wrap('<div class="ui-acf" />');
				}

				// allow null
				input.blur(function(){
					
					if( !input.val() )
					{
						input.val('');
					}
				});
			});
		});
	}
})(jQuery);
