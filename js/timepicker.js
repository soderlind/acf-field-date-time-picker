/*
Attach a jQuery.datetimepicker() to "input[type=text].time_picker" fields. Will also attach to dynamic added fields.
*/
jQuery(function() {
	jQuery(".field").on("focusin", "input[type=text].time_picker",  function(){
		self = jQuery(this);
		self.datetimepicker({
			timeOnly: (self.attr('data-date_format') == undefined),
			timeFormat: self.attr('data-time_format'),
			dateFormat: (self.attr('data-date_format') != undefined) ? self.attr('data-date_format') : 'mm/dd/yy',
			showWeek: (self.attr('data-show_week_number') != "true") ? 0 : 1,
			ampm: (self.attr('data-time_format').search(/t/i) != -1),
			controlType: self.attr('data-picker'),
			timeOnlyTitle: self.attr('title'),
			monthNames: timepicker_objectL10n.monthNames,
			monthNamesShort: timepicker_objectL10n.monthNamesShort,
			dayNames: timepicker_objectL10n.dayNames,
			dayNamesShort: timepicker_objectL10n.dayNamesShort,
			dayNamesMin: timepicker_objectL10n.dayNamesMin,
			firstDay: timepicker_objectL10n.firstDay
		});
	});
});

