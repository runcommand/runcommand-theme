<?php

namespace runcommand\Fields;

class Command extends \runcommand\Controller {

	protected function setup_actions() {
		add_action( 'fm_post_command', array( $this, 'action_fm_post_register_command_fields' ) );
	}

	public function action_fm_post_register_command_fields() {
		$group = new \Fieldmanager_Group( false, array(
			'name'           => 'purchase_button',
			'serialize_data' => false,
			'add_to_prefix'  => false,
		) );
		$group->add_child( new \Fieldmanager_Textfield( 'Label', array(
			'name'           => 'purchase_button_label',
		) ) );
		$group->add_child( new \Fieldmanager_Textfield( 'URL', array(
			'name'           => 'purchase_button_url',
		) ) );
		$group->add_meta_box( 'Purchase Button', 'command', 'side' );
	}

}
