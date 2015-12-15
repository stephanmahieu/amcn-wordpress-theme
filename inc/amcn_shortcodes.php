<?php
/**
 * AMCN Specific shortcodes
 *
 */


/**
 * Convert a html text fragment into a separate lines array.
 * 
 * @return array
 */
function amcn_convertToArray($content) {
	// split content into separate lines
	$lines = explode("\n", str_replace(array("\r\n","\n\r","\r"),"\n",$content));

	// remove line breaks
	for($x = 0; $x < count($lines); $x++) {
		$lines[$x] = str_replace(array("\n","<br />"),'',$lines[$x]);
	}

	// remove empty lines
	$lines = array_filter( $lines );
	array_slice( $lines, 0 );

	return $lines;
}

/**
 * Shortcode function for generating a geboortebericht.
 * The 8 lines between start and endtag are styled into a geboortebericht.
 * 
 * @return string
 */
function geboorte_bericht_function($atts, $content = null) {
	extract(shortcode_atts(array(
		'attr1' => 1,
	), $atts));

	$lines = amcn_convertToArray($content);

	if (count($lines) >= 8) {
		$return_string = '<div class="geboortebericht">';
		$return_string .= '<div class="geboorte-kennel"><a href="' . $lines[2] . '" target="_blank">' . $lines[1] . '</a></div>';
		$return_string .= '<div class="geboorte-contact">' . $lines[3] . '</div>';
		$return_string .= '<div class="center-box-outer"><div class="center-box-inner">';
		$return_string .= '<div class="geboorte-reu">' . gender_label($lines[4]) . '</div>';
		$return_string .= '<div class="geboorte-teef">' . gender_label($lines[5]) . '</div>';
		$return_string .= '</div></div>';
		$return_string .= '<div class="geboorte-datum">' . $lines[6] . '</div>';
		$return_string .= '<div class="geboorte-aantalbeschikbaar">';
		$return_string .= '<span class="geboorte-aantal">' . $lines[7] . '</span>';
		$return_string .= '<span class="geboorte-beschikbaar">' . $lines[8] . '</span>';
		$return_string .= '</div>';
		if (count($lines) > 8) {
			// keep additional unexpected lines
			for ($x = 9; $x <= count($lines); $x++) {
				$return_string .= '<div class="geboorte-contact">' . $lines[$x] . '</div>';
			}
		}
		$return_string .= '</div>';
	}

	return $return_string;
}

/**
 * Shortcode function for generating a dekbericht.
 * The 5 lines between start and endtag are styled into a dekbericht.
 * 
 * @return string
 */
function dek_bericht_function($atts, $content = null) {
	extract(shortcode_atts(array(
		'attr1' => 1,
	), $atts));

	$lines = amcn_convertToArray($content);

	if (count($lines) >= 5) {
		$return_string = '<div class="dekbericht">';
		$return_string .= '<div class="dek-kennel"><a href="' . $lines[2] . '" target="_blank">' . $lines[1] . '</a></div>';
		$return_string .= '<div class="dek-contact">' . $lines[3] . '</div>';
		$return_string .= '<div class="center-box-outer"><div class="center-box-inner">';
		$return_string .= '<div class="dek-reu">' . gender_label($lines[4]) . '</div>';
		$return_string .= '<div class="dek-teef">' . gender_label($lines[5]) . '</div>';
		$return_string .= '</div></div>';
		if (count($lines) > 5) {
			// keep additional unexpected lines
			for ($x = 6; $x <= count($lines); $x++) {
				$return_string .= '<div class="dek-contact">' . $lines[$x] . '</div>';
			}
		}
		$return_string .= '</div>';
	}

	return $return_string;
}

/**
 * Shortcode function for generating a planbericht.
 * The 5 lines between start and endtag are styled into a planbericht.
 * 
 * @return string
 */
function plan_bericht_function($atts, $content = null) {
	extract(shortcode_atts(array(
		'attr1' => 1,
	), $atts));

	$lines = amcn_convertToArray($content);

	if (count($lines) >= 5) {
		$return_string = '<div class="planbericht">';
		$return_string .= '<div class="dek-kennel"><a href="' . $lines[2] . '" target="_blank">' . $lines[1] . '</a></div>';
		$return_string .= '<div class="dek-contact">' . $lines[3] . '</div>';
		$return_string .= '<div class="center-box-outer"><div class="center-box-inner">';
		$return_string .= '<div class="dek-reu">' . gender_label($lines[4]) . '</div>';
		$return_string .= '<div class="dek-teef">' . gender_label($lines[5]) . '</div>';
		$return_string .= '</div></div>';
		if (count($lines) > 5) {
			// keep additional unexpected lines
			for ($x = 6; $x <= count($lines); $x++) {
				$return_string .= '<div class="dek-contact">' . $lines[$x] . '</div>';
			}
		}
		$return_string .= '</div>';
	}

	return $return_string;
}

function gender_label($line) {
	$idx = strpos($line,':');
	if ($idx) {
		$return_string = '<span class="gender_label">' . substr($line, 0, $idx+1) . '</span>' . substr($line, $idx+1);
	} else {
		$return_string = $line;
	}
	return $return_string;
}

/**
 *  shortcodes register function.
 */
function register_amcn_shortcodes() {
	add_shortcode('geboorte-bericht', 'geboorte_bericht_function');
	add_shortcode('dek-bericht',      'dek_bericht_function');
	add_shortcode('plan-bericht',     'plan_bericht_function');
}



function add_amcn_buttons( $buttons ) {
   array_push( $buttons, "|", "geboortebericht" );
   array_push( $buttons, "|", "dekbericht" );
   array_push( $buttons, "|", "planbericht" );
   return $buttons;
}

function add_amcn_plugin( $plugin_array ) {
   $plugin_array['geboortebericht'] = get_stylesheet_directory_uri() . '/js/geboortebericht.js';
   $plugin_array['dekbericht']      = get_stylesheet_directory_uri() . '/js/dekbericht.js';
   $plugin_array['planbericht']     = get_stylesheet_directory_uri() . '/js/planbericht.js';
   return $plugin_array;
}

/**
 * Register the buttons for the shortcodes in TinyMCE Editor.
 */
function register_amcn_buttons() {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		return;
	}

	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter( 'mce_external_plugins', 'add_amcn_plugin' );
		add_filter( 'mce_buttons',          'add_amcn_buttons' );
	}
}