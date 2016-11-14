<?php

namespace runcommand;

use League\CommonMark\Converter;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;
use Webuni\CommonMark\TableExtension\TableExtension;

class Content_Model extends Controller {

	protected static $custom_post_types = array(
		'command',
		'tip',
		'spark',
	);

	protected function setup_actions() {
		add_action( 'init', array( $this, 'action_init_register_post_types' ) );
		add_action( 'init', array( $this, 'action_init_register_shortcodes' ) );
		add_action( 'p2p_init', array( $this, 'action_p2p_init_register_connections' ) );
		add_action( 'template_redirect', function() {
			global $wp;

			if ( 'wp' === $wp->request ) {
				wp_safe_redirect( home_url( 'commands/' ) );
				exit;
			}
			if ( 'to' === $wp->request ) {
				wp_safe_redirect( home_url( 'tips/' ) );
				exit;
			}
			if ( 'excerpts' === $wp->request ) {
				wp_safe_redirect( home_url( 'tips/' ) );
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

		add_filter( 'register_post_type_args', function( $args, $post_type ) {
			global $wp_rewrite;
			if ( 'post' === $post_type ) {
				$archive_slug = 'blog';
				$args['has_archive'] = $archive_slug;
				$archive_slug = $wp_rewrite->root . $archive_slug;
				add_rewrite_rule( "{$archive_slug}/?$", "index.php?post_type=$post_type", 'top' );
				$feeds = '(' . trim( implode( '|', $wp_rewrite->feeds ) ) . ')';
				add_rewrite_rule( "{$archive_slug}/feed/$feeds/?$", "index.php?post_type=$post_type" . '&feed=$matches[1]', 'top' );
				add_rewrite_rule( "{$archive_slug}/$feeds/?$", "index.php?post_type=$post_type" . '&feed=$matches[1]', 'top' );
				add_rewrite_rule( "{$archive_slug}/{$wp_rewrite->pagination_base}/([0-9]{1,})/?$", "index.php?post_type=$post_type" . '&paged=$matches[1]', 'top' );
			}
			return $args;
		}, 10, 2 );

		// Transform endash back to -- to reverse wptexturize
		add_filter( 'the_title', function( $title ) {
			return str_replace( '&#8211;', '--', $title );
		});

		// Inject the newsletter signup form before Using
		add_filter( 'the_content', function( $content ){
			$search = '## Using';
			return str_replace( $search, '[newsletter-signup]' . PHP_EOL . PHP_EOL . $search, $content );
		}, 0 );

		// Inject the Buy Now button into premium commands
		add_filter( 'the_content', function( $content ) {
			$button_label = get_post_meta( get_the_ID(), 'purchase_button_label', true );
			$button_url = get_post_meta( get_the_ID(), 'purchase_button_url', true );
			if ( ! $button_label || ! $button_url ) {
				return $content;
			}
			$button = '<a class="button right" href="' . esc_url( $button_url ) . '">' . esc_html( $button_label ) . '</a>';
			$search = stripos( $content, '## Overview' ) ? '## Overview' : '## Using';
			return str_replace( $search, $button . PHP_EOL . PHP_EOL . $search, $content );
		}, 0 );

		$markdown_convert = function( $string ) {
			$environment = Environment::createCommonMarkEnvironment();
			$environment->addExtension( new TableExtension() );
			$converter = new Converter( new DocParser( $environment ), new HtmlRenderer( $environment ) );
			$retval = $converter->convertToHtml( $string );
			return str_replace( '<br>', '', $retval );
		};
		foreach( array( 'the_excerpt', 'the_content' ) as $filter ) {
			add_filter( $filter, $markdown_convert, 0 );
		}

		// Ensure inline titles have link targets
		add_filter( 'the_content', function( $content ){
			$content = preg_replace_callback( '#(<h[1-4]>)(.+)</h[1-4]+#', function( $matches ){
				$id = sanitize_key( str_replace( ' ', '-', html_entity_decode( $matches[2] ) ) );
				return str_replace( $matches[1], rtrim( $matches[1], '>' ) . ' id="' . esc_attr( $id ) . '">', $matches[0] );
			}, $content );
			return $content;
		});

	}

	public function action_init_register_post_types() {

		add_post_type_support( 'page', 'excerpt' );

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
					'thumbnail',
					'revisions',
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
				case 'tip':
					$singular = 'Tip';
					$plural = 'Tips';
					$args['description'] = 'Continually updated micro-tutorials on how to solve different problems with WP-CLI.';
					$args['menu_position'] = 7;
					$args['menu_icon'] = 'dashicons-info';
					$args['has_archive'] = 'tips';
					$args['rest_base'] = 'tips';
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

	public function action_p2p_init_register_connections() {
		p2p_register_connection_type( array(
			'name'           => 'command_to_post',
			'from'           => 'command',
			'to'             => 'post',
			'sortable'       => 'from',
			'admin_column'   => 'any',
			'title'          => array(
				'from'       => 'Posts',
				'to'         => 'Commands',
			),
			'admin_box'      => array(
				'show'       => 'any',
				'context'    => 'side'
			)
		) );
		p2p_register_connection_type( array(
			'name'           => 'command_to_tip',
			'from'           => 'command',
			'to'             => 'tip',
			'sortable'       => 'from',
			'admin_column'   => 'any',
			'title'          => array(
				'from'       => 'Tips',
				'to'         => 'Commands',
			),
			'admin_box'      => array(
				'show'       => 'any',
				'context'    => 'side'
			)
		) );
	}

	public function action_init_register_shortcodes() {
		add_shortcode( 'pricing-grid', function() {
			return \runcommand::get_template_part( 'pricing-grid' );
		});
		add_shortcode( 'newsletter-signup', function() {
			return \runcommand::get_template_part( 'newsletter-signup' );
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
