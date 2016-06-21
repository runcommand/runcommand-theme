<?php

namespace runcommand;

class Query extends Controller {

	protected function setup_actions() {
		add_action( 'pre_get_posts', array( $this, 'action_pre_get_posts' ) );
	}

	public function action_pre_get_posts( $query ) {

		if ( ! is_admin() && $query->is_main_query() && $query->is_archive() && 'command' === $query->get( 'post_type' ) ) {
			$query->set( 'posts_per_page', 50 );
		}

		if ( 'command' === $query->get( 'post_type' ) && ! $query->get( 'orderby' ) && ! $query->get( 'order' ) ) {
			$query->set( 'orderby', 'title' );
			$query->set( 'order', 'ASC' );
		}

	}

	/**
	 * Get a post object based on its ID
	 *
	 * @param int
	 * @return obj|false
	 */
	public static function get_post_by_id( $post_id ) {
		if ( ! $post_id ) {
			return false;
		}

		$post = get_post( $post_id );
		if ( ! $post ) {
			return false;
		}

		$class = '\runcommand\Objects\\' . ucwords( $post->post_type );
		if ( ! class_exists( $class ) ) {
			return false;
		}
		return new $class( $post );
	}

}
