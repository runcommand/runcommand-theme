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
			'description'   => 'Search through the database for the string you think might be there.',
		), $response );
	}

}
