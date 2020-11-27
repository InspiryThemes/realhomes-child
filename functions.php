<?php
/*-----------------------------------------------------------------------------------*/
/*	Enqueue Styles in Child Theme
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'inspiry_enqueue_child_styles' ) ) {
	function inspiry_enqueue_child_styles() {
		if ( ! is_admin() ) {
			// dequeue and deregister parent default css
			wp_dequeue_style( 'parent-default' );
			wp_deregister_style( 'parent-default' );

			// dequeue parent custom css
			wp_dequeue_style( 'parent-custom' );

			// parent default css
			wp_enqueue_style( 'parent-default', get_template_directory_uri() . '/style.css' );

			// parent custom css
			wp_enqueue_style( 'parent-custom' );

			// child default css
			wp_enqueue_style( 'child-default', get_stylesheet_uri(), array( 'parent-default' ), '1.0', 'all' );

			// child custom css
			wp_enqueue_style( 'child-custom', get_stylesheet_directory_uri() . '/css/child-custom.css', array( 'child-default' ), '1.4', 'all' );

			// child custom js
			wp_enqueue_script( 'child-custom', get_stylesheet_directory_uri() . '/js/child-custom.js', array( 'jquery' ), '1.4', true );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'inspiry_enqueue_child_styles', PHP_INT_MAX );


if ( ! function_exists( 'inspiry_load_translation_from_child' ) ) {
	/**
	 * Load translation files from child theme
	 */
	function inspiry_load_translation_from_child() {
		load_child_theme_textdomain( 'framework', get_stylesheet_directory() . '/languages' );
	}

	add_action( 'after_setup_theme', 'inspiry_load_translation_from_child' );
}