<?php

namespace runcommand\REST;

use WP_Error;

class Base_Posts_Controller extends \WP_REST_Posts_Controller {

	public function __construct( $post_type ) {
		parent::__construct( $post_type );
		$this->namespace = 'v1';
	}

	public function prepare_item_for_response( $post, $request ) {
		$response = parent::prepare_item_for_response( $post, $request );

		return $response;
	}

	public function get_collection_params() {
		$params = parent::get_collection_params();

		return $params;
	}

}
