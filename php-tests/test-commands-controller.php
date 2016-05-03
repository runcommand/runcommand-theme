<?php

class Test_Commands_Controller extends runcommand_REST_Testcase {

	public function test_get_item() {
		$request = new WP_REST_Request( 'GET', '/v1/commands/' . $this->command1 );
		$response = $this->server->dispatch( $request );
		$this->assertStatus( 200, $response );
		$this->assertResponseData( array(
			'title'         => 'db ack',
			'slug'          => 'db-ack',
			'type'          => 'command',
			'description'   => 'Find a specific string in the database.',
		), $response );
	}

	public function test_create_item() {
		wp_set_current_user( $this->admin1 );
		$request = new WP_REST_Request( 'POST', '/v1/commands' );
		$request->set_param( 'title', 'user one-time-login' );
		$request->set_param( 'description', 'Use WP-CLI to generate a one-time login URL for any user.' );
		$request->set_param( 'status', 'publish' );
		$response = $this->server->dispatch( $request );
		$this->assertStatus( 201, $response );
		$this->assertResponseData( array(
			'title'         => 'user one-time-login',
			'slug'          => 'user-one-time-login',
			'type'          => 'command',
			'description'   => 'Use WP-CLI to generate a one-time login URL for any user.',
		), $response );
	}

	public function test_create_item_unauthenticated() {
		$request = new WP_REST_Request( 'POST', '/v1/commands' );
		$request->set_param( 'title', 'user one-time-login' );
		$request->set_param( 'description', 'Use WP-CLI to generate a one-time login URL for any user.' );
		$request->set_param( 'status', 'publish' );
		$response = $this->server->dispatch( $request );
		$this->assertStatus( 401, $response );
	}

}
