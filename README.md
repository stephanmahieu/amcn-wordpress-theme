# AMCN Wordpress Theme
Adaptation (Child) of the wordpress Twenty Fourteen theme for the Alaska Malamute Club Nederland (A.M.C.N.).

See it in action: http://www.amcn.nl/

## Enhancements

### Styling
Many improvements/changes to the default styling:
* width is increased from 474 to 774
* a home image is added left to the site title
* less whitespace between miscellaneous elements making it all visually a bit more compact
* adding background-color to tables
* custom bullet (paw print) for first level in unordered list
* blockquotes radically changed
* styling for custom shortcodes:
  * _geboortebericht_
  * _dekbericht_
  * _planbericht_ 
* additional styling added to style.css for:
  * Basic Google Maps Placemarks
  * Stupid Table Sorter
  * Fast Secure Contact Form _(deprecated)_
  * Contact Form 7

### Fix menu for larger touch devices
Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
Fix: [navigation.js](https://github.com/stephanmahieu/amcn-wordpress-theme/blob/master/js/navigation.js)

On a tablet without this fix opening a menu (by touch) would show all menu items but also immediately
select the first menu item given the user no chance of selecting any of the menu-items.

### Scroll to top
A scroll to top button is automatically displayed at the bottom of the screen for long pages and
dims automatically after a few seconds. See [scroll-top.js](https://github.com/stephanmahieu/amcn-wordpress-theme/blob/master/js/scroll-top.js)

### Shortcodes for special posts
Extra shortcodes have been added for _planbericht_, _dekbericht_ and _geboortebericht_.
They can be created from the editor using 3 custom buttons, each button will create the shortcode
including the contents (template).

### Shortcode for scheduling content
Content between enclosed shortcode will show only if between given date-times.
Provide at least one date-time.

Example:
```
[schedule-content show="01-06-2017 23:59:59" hide="30-06-2017 23:59:59"]
This is the scheduled content.
[/schedule-content]
```

### Sortable tables
Using the incorporated [stupidtable js library](https://github.com/joequery/Stupid-Table-Plugin), tables can be made sortable.

For the table **thead** and **tbody** tags must be used. Add a **data-sort** attribute of ***datatype*** to the **th** elements to make them
sortable by that data type. If you don't want that column to be sortable, just omit the data-sort attribute.

The predefined ***datatype*** 's for sorting are:
* int
* float
* string (case-sensitive)
* string-ins (case-insensitive)

Example:
```xml
  <thead>
    <tr>
      <th data-sort="string">Name</th>
      <th data-sort="int">Birthday</th>
    </tr>
  </thead>
```

You can also set the default sorting direction, sort columns onload, do multicolumn sorting and more,
See the [stupidtable github page](https://github.com/joequery/Stupid-Table-Plugin) for more details on how to use all
its features.

### Calculated fields
Some basic javascript support for calculated fields is available.

I have added two js functions in [amcnCustom.js](https://github.com/stephanmahieu/amcn-wordpress-theme/blob/master/js/amcnCustom.js) that can be called from javascript.

* **amcnAddCalculatedField(idFldAmount, factor, idFldSum, precision)**  
  Value from input with id **_idFldAmount_** is multiplied with **_factor_**,
  the result is stored in field with id **_idFldSum_**.
  Result is displayed with **_precision_** no of decimals.  
  The sum is calculated automatically each time the value changes.
  
* **amcnSumFields(idFlds, idSum, precision)**
  Calculate the sum of an array of fields \[**_idFlds_**\], the result is stored in field with id **_idSum_**.
  Result is displayed with **_precision_** no of decimals.  
  The sum is automatically recalculated when one of the fieldvalue chages.

Examples:
```javascript
amcnAddCalculatedField("#fld1",  5.0, "#fld2", 2);
amcnAddCalculatedField("#fld3", 10.0, "#fld4", 2);
amcnSumFields(["#fld2", "#fld4"], "#sum", 2);
```

## Screenshot of the AMCN theme

![Screenshoot](https://raw.githubusercontent.com/stephanmahieu/amcn-wordpress-theme/master/screenshot.png "Main Dialog Contextmenu")