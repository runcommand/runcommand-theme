<?php

class Test_API extends runcommand_REST_TestCase {

	public function test_routes() {
		$routes = $this->server->get_routes();
		$this->assertEqualSets( array(
			'/'
		), array_keys( $routes ) );
	}

}
