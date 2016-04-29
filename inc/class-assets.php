<?php

namespace runcommand;

class Assets extends Controller {

	protected function setup_actions() {
		add_action( 'admin_enqueue_scripts', array( $this, 'action_admin_enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'action_wp_enqueue_scripts' ) );
	}

	public function action_admin_enqueue_scripts() {
		$time = filemtime( get_template_directory() . '/assets/css/style.css' );
		wp_enqueue_style( 'runcommand-admin', get_template_directory_uri() . '/assets/css/admin.css?r=' . (int) $time );
		// $time = filemtime( get_template_directory() . '/assets/css/editor-style.css' );
		// add_editor_style( get_stylesheet_directory_uri() . '/assets/css/editor-style.css?r=' . (int) $time );
	}

	public function action_wp_enqueue_scripts() {

		wp_enqueue_style( 'source-code-pro', 'https://fonts.googleapis.com/css?family=Source+Code+Pro:400,700,300' );

		$time = filemtime( get_template_directory() . '/assets/css/style.css' );
		wp_enqueue_style( 'runcommand', get_template_directory_uri() . '/assets/css/style.css?r=' . (int) $time, array( 'source-code-pro' ) );

		$time = filemtime( get_template_directory() . '/assets/dist/app.js' );
		wp_enqueue_script( 'runcommand', get_template_directory_uri() . '/assets/dist/app.js?r=' . (int) $time, null, false, true );
	}

}
