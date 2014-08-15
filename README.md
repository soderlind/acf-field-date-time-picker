# ACF  Date and Time Picker Field

Adds a 'Date and Time Picker' field type for the [Advanced Custom Fields](http://wordpress.org/extend/plugins/advanced-custom-fields/) WordPress plugin.

-----------------------

### Thanks to [yanknudtskov](https://github.com/yanknudtskov), the plugin now works with ACF 5.0

### Overview

This is an add-on for the Advanced Custom Fields WordPress plugin, that allows you to add a Date and Time Picker field type.

### Compatibility

This add-on will work with:

* Advanced Custom Fields version 4.3.5 and up (including ACF 5)
* Advanced Custom Fields version 3 and bellow


### Installation


This add-on can be treated as both a WP plugin and a theme include. The plugin is also available from the [WordPress plugin directory](http://wordpress.org/plugins/acf-field-date-time-picker/)

**Install as Plugin**

1. Copy the 'acf-date_time_picker' folder into your plugins folder
2. Activate the plugin via the Plugins admin page

**Include within theme**

1.	Copy the 'acf-date_time_picker' folder into your theme folder (can use sub folders). You can place the folder anywhere inside the 'wp-content' directory
2.	Edit your functions.php file and add the code below (Make sure the path is correct to include the acf-date_time_picker.php file)

```php
add_action('acf/register_fields', 'my_register_fields');

function my_register_fields()
{
	include_once('acf-date_time_picker/acf-date_time_picker.php');
}
```

### Frequently Asked Questions


**How do I set the date and time format?**

To set  the date and time format when you create the field, you have to create a string using the letters below.

#### Date format


		d    day of month (no leading zero)
		dd   day of month (two digit)
		o    day of the year (no leading zeros)
		oo   day of the year (three digit)
		D    day name short
		DD   day name long
		m    month of year (no leading zero)
		mm   month of year (two digit)
		M    month name short
		MM   month name long
		y    year (two digit)
		yy   year (four digit)


#### Time format


		H    Hour with no leading 0 (24 hour)
		HH   Hour with leading 0 (24 hour)
		h    Hour with no leading 0 (12 hour)
		hh   Hour with leading 0 (12 hour)
		m    Minute with no leading 0
		mm   Minute with leading 0
		s    Second with no leading 0
		ss   Second with leading 0
		l    Milliseconds always with leading 0
		t    a or p for AM/PM
		T    A or P for AM/PM
		tt   am or pm for AM/PM
		TT   AM or PM for AM/PM


#### Examples

* `yy-mm-dd`: 2013-04-12
* `HH:mm`: 24 hour clock, with a leading 0 for hour and minute
* `h:m tt`: 12 hour clock with am/pm, no leading 0

### More Information

http://soderlind.no/time-picker-field-for-advanced-custom-fields/

### Changelog

Please see [Changelog.md](Changelog.md)
