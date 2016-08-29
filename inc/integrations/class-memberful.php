<?php

namespace runcommand\Integrations;

class Memberful extends \runcommand\Controller {

	protected function setup_actions() {
		add_action( 'wp_head', array( $this, 'action_wp_head' ) );
	}

	public function action_wp_head() {
		echo \runcommand::get_template_part( 'header/memberful' );
	}
}
