<?php

namespace runcommand\REST;

use WP_Error;
use WP_REST_Server;

class Commands_Controller extends Base_Posts_Controller {

	protected static $schema_title = 'command';

	public function __construct( $post_type ) {
		parent::__construct( $post_type );
	}

	public function register_routes() {

		register_rest_field( self::$schema_title, 'title', array(
			'get_callback'        => function( $resource ) {
				$post = get_post( $resource['id'] );
				return $post->post_title;
			},
			'schema'              => array(
				'description'     => 'Title of the command.',
				'type'            => 'string',
			),
		) );

		register_rest_field( self::$schema_title, 'description', array(
			'get_callback'        => function( $resource ) {
				$post = get_post( $resource['id'] );
				return $post->post_excerpt;
			},
			'update_callback'     => function( $value, $post ) {
				wp_update_post( array( 'ID' => $post->ID, 'post_excerpt' => $value ) );
			},
			'schema'              => array(
				'description'     => 'Abbreviated description of what the command does.',
				'type'            => 'string',
			),
		) );

		parent::register_routes();
	}

	public function get_item_schema() {
		$schema = parent::get_item_schema();

		// Unset attributes we don't want to use.
		$unused_attributes = array(
			'excerpt',
			'date',
			'date_gmt',
			'password',
			'modified',
			'modified_gmt',
			'status',
		);
		foreach( $unused_attributes as $attribute ) {
			if ( isset( $schema['properties'][ $attribute ] ) ) {
				unset( $schema['properties'][ $attribute ] );
			}
		}
		return $this->add_additional_fields_schema( $schema );
	}

	public function get_collection_params() {
		$params = parent::get_collection_params();
		$params['order']['default'] = 'asc';
		$params['orderby']['default'] = 'title';

		$unused_params = array(
			'after',
			'before',
			'author',
			'author_exclude',
			'status',
			'filter',
		);
		foreach( $unused_params as $param ) {
			if ( isset( $params[ $param ] ) ) {
				unset( $params[ $param ] );
			}
		}
		return $params;
	}

}
