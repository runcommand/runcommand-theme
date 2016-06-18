<?php

namespace runcommand;

class Query extends Controller {

	protected function setup_actions() {
		add_action( 'pre_get_posts', array( $this, 'action_pre_get_posts' ) );
	}

	public function action_pre_get_posts( $query ) {

		if ( ! is_admin() && $query->is_archive() && 'command' === $query->get( 'post_type' ) ) {
			$query->set( 'posts_per_page', 50 );
		}

	}

}
