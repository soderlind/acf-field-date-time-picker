#Date and Time Picker field for Advanced Custom Fields v4.0#

This is an add-on for the [Advanced Custom Fields v4.0](https://github.com/elliotcondon/acf4) WordPress plugin, that allows you to add a Date and Time Picker field type.

## Installation ##

1. Clone or download and extract the add-on into wp-content/YOUR-THEME/fields folder. 
2. Add the following to your wp-content/YOUR-THEME/functions.php

	add_action('acf/register_fields', 'date_time_picker_field');

	function date_time_picker_field()
	{
	  include_once('fields/acf-field-date-time-picker/date-time-picker.php');
	}

## Use ##

Please see how to [Create a Time Picker field](http://soderlind.no/time-picker-field-for-advanced-custom-fields/#create-a-time-picker-field) at my site 

## Credit ##

Date and Time Picker field for Advanced Custom Fields v4.0 uses the [jQuery timepicker addon](http://trentrichardson.com/examples/timepicker/) by [Trent Richardson](http://trentrichardson.com)

Copyright 2012 Trent Richardson. Dual licensed under the [MIT](http://trentrichardson.com/Impromptu/MIT-LICENSE.txt) and [GPL](http://trentrichardson.com/Impromptu/GPL-LICENSE.txt) licenses.


