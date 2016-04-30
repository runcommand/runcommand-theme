<?php

namespace runcommand\REST;

use runcommand\Controller;
use WP_REST_Server;
use WP_REST_Request;

class API extends Controller {

	protected function setup_actions() {

	}

	protected function setup_filters() {
		add_filter( 'rest_url_prefix', function(){
			return 'api';
		});
		add_filter( 'rest_endpoints', function( $endpoints ){
			foreach( $endpoints as $route => $data ) {
				if ( 0 === stripos( $route, '/wp/v2' ) || 0 === stripos( $route, '/oembed/1.0' ) ) {
					unset( $endpoints[ $route ] );
				}
			}
			return $endpoints;
		});
	}

	public static function get_initial_state() {
		$state = array();
		foreach( array( 'commands' ) as $type ) {
			$state[ $type ] = array(
				'items'     => array(),
			);
		}

		$request = new WP_REST_Request( 'GET', '/v1/commands' );
		$response = rest_do_request( $request );
		if ( ! $response->is_error() ) {
			$state['commands']['items'] = $response->get_data();
		}

		return $state;
	}

}
