<?php

namespace runcommand;

class Distribution_Metadata extends Controller {

	protected static $default_title = 'runcommand';
	protected static $default_description = 'Premium WP-CLI commands and support';

	protected function setup_actions() {
		add_action( 'wp_head', array( $this, 'action_wp_head' ) );
		add_action( 'admin_head', array( $this, 'action_admin_head' ) );
	}

	protected function setup_filters() {
		add_filter( 'document_title_parts', array( $this, 'filter_document_title_parts' ) );
	}

	public function action_wp_head() {
		echo '<meta name="description" content="' . esc_attr( $this->get_current_meta_description() ) . '" />' . PHP_EOL;
		$facebook_tags = $this->get_facebook_open_graph_meta_tags();
		$twitter_tags = $this->get_twitter_card_meta_tags();
		$tags = array_merge( $facebook_tags, $twitter_tags );
		foreach ( array_filter( $tags ) as $name => $value ) {
			// Encoded ampersands in URLs seem to cause Facebook some anguish trying to parse
			if ( in_array( $name, array( 'og:image', 'og:url', 'twitter:image', 'twitter:url' ) ) ) {
				echo '<meta property="' . esc_attr( $name ) . '" content="' . esc_url( $value ) . '" />' . PHP_EOL;
			} else {
				echo '<meta property="' . esc_attr( $name ) . '" content="' . esc_attr( $value ) . '" />' . PHP_EOL;
			}
		}

		echo \runcommand::get_template_part( 'header/favicons' );
	}

	public function action_admin_head() {
		echo \runcommand::get_template_part( 'header/favicons' );
	}

	public function filter_document_title_parts( $title ) {

		if ( is_home() ) {
			$title['tagline'] = self::$default_description;
			$title = array_reverse( $title );
		}

		if ( is_singular() && 'command' === get_post_type() ) {
			$title['title'] = 'wp ' . $title['title'];
		}
		return $title;
	}

	private function get_current_meta_description() {
		if ( $post = $this->get_current_post() ) {
			return $post->get_seo_description();
		} else {
			return self::$default_description;
		}
	}

	/**
	 * Get the Facebook Open Graph meta tags for this page
	 */
	private function get_facebook_open_graph_meta_tags() {

		// Defaults
		$tags = array(
			'og:site_name'   => 'runcommand',
			'og:type'        => 'website',
			'og:title'       => self::$default_title,
			'og:description' => $this->get_current_meta_description(),
			'og:url'         => home_url( \runcommand::get_request_uri() ),
		);

		if ( $post = $this->get_current_post() ) {
			$tags['og:title'] = $post->get_facebook_open_graph_tag( 'title' );
			$tags['og:type'] = 'article';
			$tags['og:description'] = $post->get_facebook_open_graph_tag( 'description' );
			$tags['og:url'] = $post->get_facebook_open_graph_tag( 'url' );
			if ( $image = $post->get_facebook_open_graph_tag( 'image' ) ) {
				$tags['og:image'] = $image[0];
				$tags['og:image:width'] = $image[1];
				$tags['og:image:height'] = $image[2];
			}
		}

		return $tags;

	}

	/**
	 * Get the Twitter card meta tags for this page
	 */
	public function get_twitter_card_meta_tags() {

		// Defaults
		$tags = array(
			'twitter:card'        => 'summary',
			'twitter:site'        => '@runcommand',
			'twitter:title'       => self::$default_title,
			'twitter:description' => $this->get_current_meta_description(),
			'twitter:url'         => esc_url( home_url( \runcommand::get_request_uri() ) ),
			);

		if ( $post = $this->get_current_post() ) {
			$tags['twitter:title'] = $post->get_twitter_card_tag( 'title' );
			$tags['twitter:description'] = $post->get_twitter_card_tag( 'description' );
			$tags['twitter:url'] = $post->get_twitter_card_tag( 'url' );
			if ( $image = $post->get_twitter_card_tag( 'image' ) ) {
				$tags['twitter:card'] = 'summary_large_image';
				$tags['twitter:image'] = $image;
			}
		}
		return $tags;
	}

	private function get_current_post() {
		if ( is_singular( Content_Model::get_content_post_types() ) && $post = Query::get_post_by_id( get_queried_object_id() ) ) {
			return $post;
		}
		return false;
	}

}
