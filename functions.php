<?php

// Defines
define( 'FL_CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'FL_CHILD_THEME_URL', get_stylesheet_directory_uri() );

// Classes
require_once 'classes/class-fl-child-theme.php';
require_once 'classes/MIHTML.class.php';

// Actions
add_action( 'fl_head', 'FLChildTheme::stylesheet' );
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

// ------------
function mi_script() {
	wp_register_script( 'mi', FL_CHILD_THEME_URL . '/js/mi.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'mi' );
}

add_action( 'wp_enqueue_scripts', 'mi_script' );
// enable Shortcodes in Widgets:
add_filter( 'widget_text', 'do_shortcode' );


function load_template_part( $template_name, $part_name = null ) {
	ob_start();
	get_template_part( $template_name, $part_name );
	$var = ob_get_contents();
	ob_end_clean();
	return $var;
}

// Add to the admin_init hook of your theme functions.php file
add_action( 'init', function() {
	register_taxonomy_for_object_type('post_tag', 'page');
	register_taxonomy_for_object_type('category', 'page');
} );


// Some shortcodes

add_shortcode( 'mi_email', function ( $atts ) {
	return'<a href="mailto:info@m-trans-fahrzeugservice.de">E-Mail:&nbsp;info@m-trans-fahrzeugservice.de</a>';
} );

add_shortcode( 'mi_tel', function ( $atts ) {
	return'<a href="tel:+493098637734">Tel:&nbsp;030&nbsp;986377-34</a>';
} );

add_shortcode( 'mi_firma', function ( $atts ) {
	return'M-Trans-Fahrzeugservice GmbH';
} );

add_shortcode( 'mi_oeff', function ( $atts ) {
	$s[] = '<table class="mi-oeff">';
	$s[] = '<tr>';
	$s[] = '<td class="col0">Mo-Fr:</td>';
	$s[] = '<td>07:00 - 18:00 Uhr</td>';
	$s[] = '</tr>';
	$s[] = '</table>';
	return implode( '', $s );
} );


add_shortcode( 'mi_akz', function ( $atts ) {
	$atts   = shortcode_atts( array(
		'format' => 'inline',
	), $atts );
	$format = $atts['format'];
	$a[]    = 'M-Trans-Fahrzeugservice GmbH';
	// $a[]    = '';
	$a[]    = 'Plauener Str. 161';
	$a[]    = 'D-13053 Berlin';
	$a[]    = '<a href="tel:+493098637734">Tel:&nbsp;030&nbsp;986377-34</a>';
	$a[]    = 'Fax:Tel:&nbsp;030&nbsp;986377-35';
	$a[]    = '<a href="mailto:info@m-trans-fahrzeugservice.de">E-Mail:&nbsp;info@m-trans-fahrzeugservice.de</a>';
	if ( $format == 'inline' ) {
		return implode( ', ', $a );
	} elseif ( $format == 'block' ) {
		return implode( '<br>', $a );
	} else {
		return implode( ' ', $a );
	}
} );