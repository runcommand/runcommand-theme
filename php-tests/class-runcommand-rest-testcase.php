<?php

abstract class runcommand_REST_Testcase extends WP_UnitTestCase {

	protected $server;

	public function setUp() {
		parent::setUp();

		/** @var WP_REST_Server $wp_rest_server */
		global $wp_rest_server;
		$this->server = $wp_rest_server = new WP_REST_Server;
		do_action( 'rest_api_init' );

		$this->admin1 = $this->factory->user->create( array(
			'role' => 'administrator',
		) );

		$this->command1 = $this->factory->post->create( array(
			'post_title'       => 'db ack',
			'post_type'        => 'command',
			'post_status'      => 'publish',
			'post_excerpt'     => 'Find a specific string in the database.',
		) );

		static $did_once;
		if ( ! isset( $did_once ) ) {
			$initial_state = runcommand\REST\API::get_initial_state();
			file_put_contents( dirname( dirname( __FILE__ ) ) . '/js-tests/initial-state.js', 'export default ' . json_encode( $initial_state ) );
			$initial_state = true;
		}

	}

	protected function assertStatus( $status, $response ) {
		$this->assertEquals( $status, $response->get_status() );
	}

	protected function assertResponseData( $data, $response ) {
		$response_data = $response->get_data();
		$tested_data = array();
		foreach( $data as $key => $value ) {
			if ( isset( $response_data[ $key ] ) ) {
				$tested_data[ $key ] = $response_data[ $key ];
			} else {
				$tested_data[ $key ] = null;
			}
		}
		$this->assertEquals( $data, $tested_data );
	}

	public function tearDown() {
		parent::tearDown();

		/** @var WP_REST_Server $wp_rest_server */
		global $wp_rest_server;
		$wp_rest_server = null;
	}

}
