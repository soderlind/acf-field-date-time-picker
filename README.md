[![Build Status](https://travis-ci.org/soderlind/acf-field-date-time-picker.svg?branch=master)](https://travis-ci.org/soderlind/acf-field-date-time-picker) [![Code Climate](https://codeclimate.com/github/soderlind/acf-field-date-time-picker/badges/gpa.svg)](https://codeclimate.com/github/soderlind/acf-field-date-time-picker)
# ACF  Date and Time Picker Field

Adds a 'Date and Time Picker' field type for the [Advanced Custom Fields](http://wordpress.org/extend/plugins/advanced-custom-fields/) WordPress plugin.

-----------------------

### ACF PRO 5.+ is no longer supported, ACF PRO [has its own date and time picker](https://www.advancedcustomfields.com/resources/date-time-picker/)

### Overview

This is an add-on for the Advanced Custom Fields WordPress plugin, that allows you to add a Date and Time Picker field type.

### Compatibility

This add-on will work with ACF 3 and 4

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

#### Updating to ACF PRO

I got this quetion over at [AWP on Facebook](https://www.facebook.com/groups/advancedwp/permalink/1198240376904841/?comment_id=1198432300218982&notif_t=group_comment&notif_id=1469033404164280):


>How does upgrading work? If someone starts with ACF and your plugin,
then upgrades to ACF Pro, will their date/time custom field disappear?
I understand the data will be maintained but wondering if the field
will still be visible in WP admin.


Updating to ACF PRO should work fine, ACF PRO has a compatibility add-on for this plugin, but test it on a non production environment first.

Also, read the comments on this issue: [https://github.com/.../acf-field-date-time-picker/issues/103](https://github.com/.../acf-field-date-time-picker/issues/103)



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
