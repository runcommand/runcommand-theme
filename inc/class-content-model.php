<?php

namespace runcommand;

use League\CommonMark\CommonMarkConverter;

class Content_Model extends Controller {

	protected static $custom_post_types = array(
		'command',
		'excerpt',
		'spark',
	);

	protected function setup_actions() {
		add_action( 'init', array( $this, 'action_init_register_post_types' ) );
		add_action( 'init', array( $this, 'action_init_register_shortcodes' ) );
		add_action( 'template_redirect', function() {
			global $wp;

			if ( 'wp' === $wp->request ) {
				wp_safe_redirect( home_url( 'commands/' ) );
				exit;
			}
			if ( 'to' === $wp->request ) {
				wp_safe_redirect( home_url( 'excerpts/' ) );
				exit;
			}
			if ( 'for' === $wp->request ) {
				wp_safe_redirect( home_url( 'sparks/' ) );
				exit;
			}
		});
	}

	protected function setup_filters() {

		$custom_post_types = self::$custom_post_types;
		add_filter( 'msm_sitemap_entry_post_type', function() use ( $custom_post_types ) {
			return array_merge( array( 'post', 'page' ), $custom_post_types );
		});

		// Transform endash back to -- to reverse wptexturize
		add_filter( 'the_title', function( $title ) {
			return str_replace( '&#8211;', '--', $title );
		});

		add_filter( 'the_content', function( $content ) {
			$converter = new CommonMarkConverter;
			return $converter->convertToHtml( $content );
		}, 0 );

	}

	public function action_init_register_post_types() {
		foreach( self::$custom_post_types as $post_type ) {
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
					'excerpt',
					'editor',
				)
			);
			switch ( $post_type ) {
				case 'command':
					$singular = 'Command';
					$plural = 'Commands';
					$args['description'] = 'WP-CLI commands maintained by runcommand.';
					$args['menu_position'] = 6;
					$args['menu_icon'] = 'dashicons-editor-code';
					$args['has_archive'] = 'commands';
					$args['rest_base'] = 'commands';
					$args['rest_controller_class'] = '\runcommand\REST\Commands_Controller';
					$args['rewrite']['slug'] = 'wp';
					break;
				case 'excerpt':
					$singular = 'Excerpt';
					$plural = 'Excerpts';
					$args['description'] = 'Continually updated micro-tutorials on how to solve different problems with WP-CLI.';
					$args['menu_position'] = 7;
					$args['menu_icon'] = 'dashicons-info';
					$args['has_archive'] = 'excerpts';
					$args['rest_base'] = 'excerpts';
					$args['rewrite']['slug'] = 'to';
					break;
				case 'spark':
					$singular = 'Spark';
					$plural = 'Sparks';
					$args['description'] = 'Everything you wish you had a WP-CLI command for.';
					$args['menu_position'] = 8;
					$args['menu_icon'] = 'dashicons-lightbulb';
					$args['has_archive'] = 'sparks';
					$args['rest_base'] = 'sparks';
					$args['rewrite']['slug'] = 'for';
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

	public function action_init_register_shortcodes() {
		add_shortcode( 'pricing-grid', function() {
			return \runcommand::get_template_part( 'pricing-grid' );
		});
	}

	public function filter_post_type_link( $post_link, $post, $leavename, $sample ) {
		if ( in_array( $post->post_type, self::$content_post_types ) ) {
			$post_link = home_url( sprintf( '%s/%d/', $post->post_type, $post->ID ) );
		}
		return $post_link;
	}

	public static function get_post_types() {
		return self::$custom_post_types;
	}

	public static function get_content_post_types() {
		return array_merge( array( 'post', 'page' ), self::$custom_post_types );
	}

}
