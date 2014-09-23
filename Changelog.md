# Changelog

### 2.0.18
* Thanks to [kamilgrzegorczyk](https://github.com/kamilgrzegorczyk), Fixing clone field issue in repeater

### 2.0.17
* Thanks to [leocaseiro](https://github.com/leocaseiro), Fix Backend Timestamp handling: `render_field` and Tested Up WordPress 4.0

### 2.0.16
* Fix Undefined property: `acf_field_date_time_picker::$domain`

### 2.0.15
* Thanks to [yanknudtskov](https://github.com/yanknudtskov), the plugin now works with ACF 5.0

### 2.0.14
* Added new `languages/acf-field-date-time-picker.po` file (note, renamed the language file)

### 2.0.13
* Fixed compatibility bug with ACF 4.3.5
* *NOTE: 2.0.13 requires ACF 4.3.5 or later*

### 2.0.12
* Added support for date format `dd/mm/yy`
* Bugfix

### 2.0.11
* Added option to retrive field values, using `the_field()` and `get_field()`, as a timestamp

### 2.0.10
* Removed "value" from defaults

### 2.0.9
* Thanks to [flahertydaf](http://support.advancedcustomfields.com/forums/topic/custom-fields-get-emptied-when-publishing/page/2/#post-2325), the plugin in now working with the latest ACF version
* Replaced `DateTime::createFromFormat` (PHP 5 >= 5.3.0), with `strtotime`
* minor bugfixes

### 2.0.8
* Adds option to store the date and time field as a UNIX timestamp or not.

### 2.0.7
* Bug fix. 2.0.6 assumed that the stored date and time was in UNIX timestamp format. 2.0.7 will check and only convert if the date and time is.

### 2.0.6
* Changed how the Date and Time Picker field is triggered when ACF adds a new Date and Time Picker field to the DOM
* Saves the Date and Time Picker field as an UNIX timestamp to MySQL. Use the PHP [date](http://php.net/manual/en/function.date.php) function  when you use it in your theme.

### 2.0.5
* When enqueuing JavaScripts, replaced dependecy of jquery-ui-datepicker with acf-datepicker

### 2.0.4
* Updated JavaScript [language detection and loading](http://soderlind.no/time-picker-field-for-advanced-custom-fields/#localization)

### 2.0.3
* Fixed Repeater field bug
* Added support for including the field in a theme

### 2.0.2
* Updated readme.txt

### 2.0.1
* Minor fix

### 2.0.0.beta
* Total rewrite, based on the [acf-field-type-template](https://github.com/elliotcondon/acf-field-type-template). Works with ACF v3 and ACF v4. In this beta you can only add the Date Time Picker field as a plugin (i.e. not as a template field).

### 1.2.0
* Updated jquery-ui-timepicker-addon.js to the latest version (1.0.0) and added localization support.

### 1.1.1
* Fixed a small bug

### 1.1
* Change name to Date and Time Picker to reflect the new option to select between Date and Time picker or Time Picker only. Thanks to Wilfrid for point this out (not sure why I didn’t include it in 1.0)

### 1.0
* Initial version