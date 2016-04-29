<?php

namespace runcommand\REST;

use runcommand\Controller;
use WP_REST_Server;

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

}
