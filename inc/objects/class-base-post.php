<?php

namespace runcommand\Objects;

abstract class Base_Post extends \WordPress_Objects\Post {

	/**
	 * Get the featured image ID for the post
	 *
	 * @return int|false
	 */
	public function get_featured_image_id() {
		return (int) $this->get_meta( '_thumbnail_id' );
	}

	/**
	 * Set the featured image for the post
	 *
	 * @param int $featured_image_id
	 */
	public function set_featured_image_id( $featured_image_id ) {
		$this->set_meta( '_thumbnail_id', (int) $featured_image_id );
	}

	/**
	 * Get the featured image object for the post
	 *
	 * @return Attachment|false
	 */
	public function get_featured_image() {
		$attachment = \runcommand\Query::get_post_by_id( $this->get_featured_image_id() );
		if ( $attachment && 'attachment' === $attachment->get_type() ) {
			return $attachment;
		} else {
			return false;
		}
	}

}
