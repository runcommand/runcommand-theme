<?php

class Test_API extends runcommand_REST_TestCase {

	public function test_routes() {
		$routes = $this->server->get_routes();
		$this->assertEqualSets( array(
			'/',
			'/v1',
			'/v1/commands',
			'/v1/commands/(?P<id>[\d]+)',
			'/v1/excerpts',
			'/v1/excerpts/(?P<id>[\d]+)',
		), array_keys( $routes ) );
	}

}
