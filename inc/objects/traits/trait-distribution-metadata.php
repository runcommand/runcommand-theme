<?php

namespace runcommand\Objects\Traits;

/**
 * Methods for getting Facebook, Twitter and SEO metadata for an object
 */
trait Distribution_Metadata {

	/**
	 * Get the SEO title for the object
	 *
	 * @return string
	 */
	public function get_seo_title() {
		$seo_title = $this->get_meta( 'seo_title' );
		if ( empty( $seo_title ) ) {
			$seo_title = $this->get_default_seo_title();
		}
		return strip_tags( $seo_title );
	}

	/**
	 * Get the default SEO title for the object
	 *
	 * @return string
	 */
	public function get_default_seo_title() {
		return $this->get_title() . ' - runcommand';
	}

	/**
	 * Get the SEO description for the object
	 *
	 * @return string
	 */
	public function get_seo_description() {
		$seo_description = $this->get_meta( 'seo_description' );
		if ( empty( $seo_description ) ) {
			$seo_description = $this->get_default_seo_description();
		}
		return strip_tags( $seo_description );
	}

	/**
	 * Set the SEO description for the object
	 *
	 * @param string
	 */
	public function set_seo_description( $description ) {
		$this->set_meta( 'seo_description', $description );
	}

	/**
	 * Get the default SEO description for the object
	 *
	 * @return string
	 */
	public function get_default_seo_description() {
		if( $this->get_field( 'post_excerpt' ) ) {
			return $this->get_field( 'post_excerpt' );
		}
		return $this->get_sentences_from_post_content( 1 );
	}

	/**
	 * Get a given Facebook Open Graph value for this object
	 *
	 * @param string $tag_name
	 * @return string
	 */
	public function get_facebook_open_graph_tag( $tag_name ) {

		$val = '';
		switch ( $tag_name ) {
			case 'title':
			case 'description':
				$val = $this->get_meta( "facebook_{$tag_name}" );
				break;
			case 'image':
				$image_id = $this->get_meta( 'facebook_image' );
				if ( intval( $image_id ) > 0 ) {
					$image = \runcommand\Query::get_post_by_id( $image_id );
					if ( $image instanceof \runcommand\Objects\Attachment ) {
						return $image->get_src( 'facebook-open-graph' );
					}
				}
				break;
		}

		if ( empty( $val ) ) {
			$val = $this->get_default_facebook_open_graph_tag( $tag_name );
		}

		if ( in_array( $tag_name, array( 'title', 'description' ) ) ) {
			$val = strip_tags( $val );
		}
		return $val;
	}

	/**
	 * Set a given Facebook Open Graph value for this object
	 *
	 * @param string $tag_name
	 * @param mixed $value
	 */
	public function set_facebook_open_graph_tag( $tag_name, $value ) {
		switch ( $tag_name ) {
			case 'title':
			case 'description':
			case 'image':
				$val = $this->set_meta( "facebook_{$tag_name}", $value );
				break;
		}
	}

	/**
	 * Get the default Facebook Open Graph value for this object
	 *
	 * @param string $tag_name
	 * @return string
	 */
	public function get_default_facebook_open_graph_tag( $tag_name ) {

		$val = '';
		switch ( $tag_name ) {
			case 'title':
				$val = $this->get_title();
				break;
			case 'description':
			        if( $this->get_field( 'post_excerpt' ) ) {
			    	        $val = $this->get_field( 'post_excerpt' );
			        } else {
			    	        $val = $this->get_sentences_from_post_content( 2 );
				}
				break;
			case 'url':
				$val = $this->get_permalink();
				break;
			case 'image':
				if ( $image = $this->get_featured_image() ) {
					$val = $image->get_src( 'facebook-open-graph' );
				}
				break;
		}
		return $val;

	}

	/**
	 * Get a given Twitter card value for this object
	 *
	 * @param string $tag_name
	 * @return string
	 */
	public function get_twitter_card_tag( $tag_name ) {

		$val = '';
		switch ( $tag_name ) {
			case 'title':
			case 'description':
				$val = $this->get_meta( "twitter_{$tag_name}" );
				break;
			case 'image':
				$image_id = $this->get_meta( 'twitter_image' );
				if ( intval( $image_id ) > 0 ) {
					$image = \runcommand\Query::get_post_by_id( $image_id );
					if ( $image instanceof \runcommand\Objects\Attachment ) {
						$src = $image->get_src( 'twitter-card' );
						return $src[0];
					}
				}
				break;

		}

		if ( empty( $val ) ) {
			$val = $this->get_default_twitter_card_tag( $tag_name );
		}

		if ( in_array( $tag_name, array( 'title', 'description' ) ) ) {
			$val = strip_tags( $val );
		}
		return $val;
	}

	/**
	 * Get the text to use when a user shares a link on Twitter
	 *
	 * @return string
	 */
	public function get_twitter_share_text() {

		$share_text = $this->get_meta( 'twitter_share_text' );
		if ( empty( $share_text ) ) {
			$share_text = $this->get_title();
		}
		if ( strlen( $share_text ) > RUNCOMMAND_TWITTER_SHARE_TEXT_MAX_LENGTH ) {
			$share_text = substr( $share_text, 0, RUNCOMMAND_TWITTER_SHARE_TEXT_MAX_LENGTH );
		}
		return $share_text;
	}

	/**
	 * Set a given Twitter Card value for this object
	 *
	 * @param string $tag_name
	 * @param mixed $value
	 */
	public function set_twitter_card_tag( $tag_name, $value ) {
		switch ( $tag_name ) {
			case 'title':
			case 'description':
			case 'image':
				$val = $this->set_meta( "twitter_{$tag_name}", $value );
				break;
		}
	}

	/**
	 * Get the default Twitter card value for this object
	 *
	 * @param string $tag_name
	 * @return string
	 */
	public function get_default_twitter_card_tag( $tag_name ) {

		$val = '';
		switch ( $tag_name ) {
			case 'title':
				$title = strip_tags( $this->get_title() );
				// Limited to 70 characters or less
				if ( strlen( $title ) > 70 ) {
					$parts = wordwrap( $title, 70, PHP_EOL );
					$parts = explode( PHP_EOL, $parts );
					$val = array_shift( $parts );
				} else {
					$val = $title;
				}
				break;
			case 'description':
				if( $this->get_field( 'post_excerpt' ) ) {
					$description = $this->get_field( 'post_excerpt' );
				} else {
					$description = $this->get_sentences_from_post_content( 2 );
				}
				// Limited to 200 characters or less
				if ( strlen( $description ) > 200 ) {
					$parts = wordwrap( $description, 200, PHP_EOL );
					$parts = explode( PHP_EOL, $parts );
					$val = array_shift( $parts );
				} else {
					$val = $description;
				}
				break;
			case 'url':
				$val = $this->get_permalink();
				break;
			case 'image':
				if ( $image = $this->get_featured_image() ) {
					$src = $image->get_src( 'twitter-card' );
					$val = $src[0];
				}
				break;
		}

		return $val;

	}

	/**
	 * Get a number of sentences from the object
	 *
	 * Used as default description for Facebook or Twitter
	 *
	 * @return string
	 */
	private function get_sentences_from_post_content( $sentence_count = 1 ) {

		// Stolen from wp_trim_excerpt()
		$text = strip_shortcodes( $this->get_field( 'post_content' ) );
		$text = strip_tags( $text );

		$sentences = preg_split( '#(?<=[.?!](\s|"))[\n\r\t\s]{0,}(?=[A-Z\b"])#',$text);

		if ( is_array( $sentences ) ) {
			$ret = '';
			for ( $i=0; $i < $sentence_count; $i++) {
				if ( isset( $sentences[ $i ] ) ) {
					$ret .= htmlspecialchars_decode( html_entity_decode( wptexturize( $sentences[ $i ] ) ), ENT_QUOTES );
				}
			}
			return trim( $ret );
		}

		return '';
	}

}
