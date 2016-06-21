<?php

namespace runcommand\Fields;

use runcommand\Content_Model;

class Distribution_Metadata extends \runcommand\Controller {

	protected function setup_actions() {
		foreach( Content_Model::get_content_post_types() as $post_type ) {
			add_action( "fm_post_{$post_type}", array( $this, 'action_fm_post_register_distribution_fields' ) );
		}
	}
	
	protected function setup_filters() {
		add_filter( 'fm_element_markup_start', array( $this, 'filter_fm_element_markup_start' ), 10, 2 );
	}
	
	public function action_fm_post_register_distribution_fields() {
		$distribution_group = new \Fieldmanager_Group( false, array(
			'name'           => 'distribution',
			'serialize_data' => false,
			'add_to_prefix'  => false,
			'tabbed'         => true,
			) );
		/*
		 * Facebook
		 */
		$facebook_group = new \Fieldmanager_Group( 'Facebook', array(
			'name'           => 'facebook',
			'serialize_data' => false,
			'add_to_prefix'  => true,
			) );
		$facebook_group->add_child( new \Fieldmanager_Media( 'Image', array(
			'name'           => 'image',
			'description'    => 'Use an image that is at least 1200 x 630 pixels. If no image is selected, the featured image will be used.'
			) ) );
		$facebook_group->add_child( new \Fieldmanager_Textfield( 'Title', array(
			'name'           => 'title',
			'description'    => 'Defaults to the story title.',
			'attributes'     => array(
				'data-runcommand-max-length-countdown' => true,
				'maxlength'                           => 70,
				),
			) ) );
		$facebook_group->add_child( new \Fieldmanager_Textarea( 'Description', array(
			'name'           => 'description',
			'description'    => 'A clear description, at least two sentences long. Defaults to the first two sentences of the story.',
			'attributes'     => array(
				'rows'                                => 5,
				'data-runcommand-max-length-countdown' => true,
				'maxlength'                           => 200,
				),
			) ) );
		$distribution_group->add_child( $facebook_group );

		/*
		 * Twitter
		 */
		$twitter_group = new \Fieldmanager_Group( 'Twitter', array(
			'name'           => 'twitter',
			'serialize_data' => false,
			'add_to_prefix'  => true,
			) );
		$twitter_group->add_child( new \Fieldmanager_Textarea( 'Share Text', array(
			'name'           => 'share_text',
			'description'    => 'Defaults to the title and short link.',
			'attributes'     => array(
				'rows'                                => 2,
				'data-runcommand-max-length-countdown' => true,
				'maxlength'                           => RUNCOMMAND_TWITTER_SHARE_TEXT_MAX_LENGTH,
				),
			) ) );
		$twitter_group->add_child( new \Fieldmanager_Media( 'Image', array(
			'name'           => 'image',
			'description'    => 'Use an image that is at least 560 x 294 pixels. If no image is selected, the featured image will be used.'
			) ) );
		$twitter_group->add_child( new \Fieldmanager_Textfield( 'Title', array(
			'name'           => 'title',
			'description'    => 'Defaults to the story title.',
			'attributes'     => array(
				'data-runcommand-max-length-countdown' => true,
				'maxlength'                           => 70,
				),
			) ) );
		$twitter_group->add_child( new \Fieldmanager_Textarea( 'Description', array(
			'name'           => 'description',
			'attributes'     => array(
				'rows'                                => 5,
				'data-runcommand-max-length-countdown' => true,
				'maxlength'                           => 200,
				),
			) ) );
		$distribution_group->add_child( $twitter_group );

		/*
		 * SEO
		 */
		$seo_group = new \Fieldmanager_Group( 'SEO', array(
			'name'           => 'seo',
			'serialize_data' => false,
			'add_to_prefix'  => true,
			) );
		$seo_group->add_child( new \Fieldmanager_Textfield( 'Title', array(
			'name'           => 'title',
			'description'    => 'A concise, accurate title of 55 characters or less. Defaults to the title.',
			'attributes'     => array(
				'data-runcommand-max-length-countdown' => true,
				'maxlength'                           => 55,
				),
			) ) );
		$seo_group->add_child( new \Fieldmanager_Textarea( 'Description', array(
			'name'           => 'description',
			'description'    => 'A compelling description 155 characters or less. Defaults to truncated content.',
			'attributes'     => array(
				'rows' => 2,
				'data-runcommand-max-length-countdown' => true,
				'maxlength'                           => 155,
				),
			) ) );
		$distribution_group->add_child( $seo_group );

		$distribution_group->add_meta_box( 'Distribution', substr( current_action(), 8 ) );
	}
	
	/**
	 * Filter markup to include placeholders specific to these fields
	 */
	public function filter_fm_element_markup_start( $out, $fm ) {

		$fm_tree = $fm->get_form_tree();
		array_pop( $fm_tree );
		$parent = array_pop( $fm_tree );

		if ( empty( $parent ) || ! in_array( $parent->name, array( 'facebook', 'twitter', 'seo' ) ) ) {
			return $out;
		}

		$obj = \runcommand\Query::get_post_by_id( $fm->data_id );
		if ( ! $obj ) {
			return $out;
		}

		switch ( $parent->name . '_' . $fm->name ) {
			case 'seo_title':
				$fm->attributes['placeholder'] = $obj->get_default_seo_title();
				break;
			case 'seo_description':
				$fm->attributes['placeholder'] = $obj->get_default_seo_description();
				break;
			case 'facebook_title':
			case 'facebook_description':
				$fm->attributes['placeholder'] = $obj->get_default_facebook_open_graph_tag( $fm->name );
				break;
			case 'twitter_title':
			case 'twitter_description':
				$fm->attributes['placeholder'] = $obj->get_default_facebook_open_graph_tag( $fm->name );
				break;
			case 'twitter_share_text':
				$share_text = $obj->get_title();
				if ( strlen( $share_text ) > RUNCOMMAND_TWITTER_SHARE_TEXT_MAX_LENGTH ) {
					$share_text = substr( $share_text, 0, RUNCOMMAND_TWITTER_SHARE_TEXT_MAX_LENGTH );
				}
				$fm->attributes['placeholder'] = $share_text . ' https://t.co/abc123 via @runcommand';
				break;
		}
		return $out;
	}
}
