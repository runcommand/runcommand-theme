<?php

namespace runcommand;

class Content_Model extends Controller {

	protected static $content_post_types = array(
		'command',
	);

	protected function setup_actions() {
		add_action( 'init', array( $this, 'action_init_register_post_types' ) );
	}

	protected function setup_filters() {
		// App handles all body classes
		add_filter( 'body_class', '__return_empty_array');
	}

	public function action_init_register_post_types() {
		foreach( self::$content_post_types as $post_type ) {
			$args = array(
				'hierarchical'            => false,
				'public'                  => true,
				'show_in_nav_menus'       => true,
				'show_ui'                 => true,
				'has_archive'             => true,
				'query_var'               => true,
				'rewrite'                 => array(
					'with_front'          => false,
				),
				'show_in_rest'            => true,
				'rest_controller_class'   => '\runcommand\REST\Base_Posts_Controller',
				'supports'                => array(
					'title',
				)
			);
			switch ( $post_type ) {
				case 'command':
					$singular = 'Command';
					$plural = 'Commands';
					$args['has_archive'] = 'commands';
					$args['rest_base'] = 'commands';
					$args['rest_controller_class'] = '\runcommand\REST\Commands_Controller';
					break;
			}
			$args['labels'] = array(
				'name'                => $plural,
				'singular_name'       => $singular,
				'all_items'           => sprintf( 'All %s', $plural ),
				'new_item'            => sprintf( 'New %s', $singular ),
				'add_new'             => sprintf( 'Add New', $singular ),
				'add_new_item'        => sprintf( 'Add New %s', $singular ),
				'edit_item'           => sprintf( 'Edit %s', $singular ),
				'view_item'           => sprintf( 'View %s', $singular ),
				'search_items'        => sprintf( 'Search %s', $plural ),
				'not_found'           => sprintf( 'No %s found', $plural ),
				'not_found_in_trash'  => sprintf( 'No %s found in trash', $plural ),
				'parent_item_colon'   => sprintf( 'Parent %s', $singular ),
				'menu_name'           => $plural,
			);
			register_post_type( $post_type, $args );
		}
	}

	public function filter_post_type_link( $post_link, $post, $leavename, $sample ) {
		if ( in_array( $post->post_type, self::$content_post_types ) ) {
			$post_link = home_url( sprintf( '%s/%d/', $post->post_type, $post->ID ) );
		}
		return $post_link;
	}

	public static function get_post_types() {
		return self::$content_post_types;
	}

}
