<?php

$_tests_dir = getenv('WP_TESTS_DIR');
if ( ! $_tests_dir ) {
	$_tests_dir = '/tmp/wordpress-tests-lib';
}

require_once $_tests_dir . '/includes/functions.php';

function _register_theme() {
	global $wp_test_current_theme;

	$theme_dir = dirname( dirname( __FILE__ ) );
	$wp_test_current_theme = basename( $theme_dir );

	register_theme_directory( dirname( $theme_dir ) );

	add_filter( 'pre_option_template', function(){
		global $wp_test_current_theme;
		return $wp_test_current_theme;
	});
	add_filter( 'pre_option_stylesheet', function(){
		global $wp_test_current_theme;
		return $wp_test_current_theme;
	});

	add_filter( 'pre_option_permalink_structure', function(){
		return '/%year%/%monthnum%/%day%/%postname%/';
	});

}
tests_add_filter( 'muplugins_loaded', '_register_theme' );

require $_tests_dir . '/includes/bootstrap.php';

require dirname( __FILE__ ) . '/class-runcommand-rest-testcase.php';
