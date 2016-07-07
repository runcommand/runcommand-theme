<?php

namespace runcommand\Fields;

use Fieldmanager_Group;
use Fieldmanager_RichTextArea;

class Content_Model extends \runcommand\Controller {

	protected function setup_actions() {
		add_action( 'fm_post_spark', array( $this, 'action_fm_post_register_spark_fields' ) );
	}

	public function action_fm_post_register_spark_fields() {
		$spark_fields = new Fieldmanager_Group( null, array(
			'name'           => 'spark',
			'add_to_prefix'  => false,
			'serialize_data' => false,
			'children'       => array(
			),
		) );
		$spark_fields->add_meta_box( 'Spark Details', array( 'spark' ), 'normal', 'high' );
	}

}
