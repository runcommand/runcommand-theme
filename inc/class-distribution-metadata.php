<?php

namespace runcommand;

class Distribution_Metadata extends Controller {

	protected function setup_actions() {

	}

	protected function setup_filters() {
		add_filter( 'document_title_parts', array( $this, 'filter_document_title_parts' ) );
	}

	public function filter_document_title_parts( $title ) {

		if ( is_home() ) {
			$title['tagline'] = 'Premium WP-CLI commands and support';
			$title = array_reverse( $title );
		}

		if ( is_singular() && 'command' === get_post_type() ) {
			$title['title'] = 'wp ' . $title['title'];
		}
		return $title;
	}

}
