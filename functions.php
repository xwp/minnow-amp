<?php
/**
 * Minnow AMP functions and definitions.
 *
 * @package Minnow_AMP
 */

/**
 * Add AMP theme support.
 */
function minnow_amp_setup() {
	add_theme_support( 'amp' );
}
add_action( 'after_setup_theme', 'minnow_amp_setup', 11 );

/**
 * Enqueue scripts and styles.
 */
function minnow_amp_scripts() {

	// The Minnow theme is linking to a deprecated genericons.css which does an @import.
	wp_styles()->registered['genericons']->src = get_template_directory_uri() . '/genericons/genericons/genericons.css';

	// Use parent theme's stylesheet instead of our stylesheet.
	wp_styles()->registered['minnow-style']->src = get_template_directory_uri() . '/style.css';

	// Add AMP style customizations.
	wp_enqueue_style( 'minnow-amp-style', get_stylesheet_uri(), array( 'minnow-style' ) );

	// Unnecessary since amp-bind handles in header.php.
	wp_dequeue_script( 'minnow-script' );
	wp_dequeue_script( 'minnow-navigation' );

	// Unnecessary because only needed by IE11.
	wp_dequeue_script( 'minnow-skip-link-focus-fix' );

	// Unnecessary because AMP plugin implements AMP-based solution.
	wp_dequeue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'minnow_amp_scripts', 11 );
