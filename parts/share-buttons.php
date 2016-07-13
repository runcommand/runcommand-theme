<div class="share-buttons">
	<?php
		$prepare_for_url = function( $value ) {
			return rawurlencode( htmlspecialchars_decode( html_entity_decode( $value ), ENT_QUOTES ) );
		};
		$twitter_url = add_query_arg( array(
			'url'      => $prepare_for_url( $obj->get_permalink() ),
			'text'     => $prepare_for_url( $obj->get_twitter_share_text() ),
			'via'      => 'runcommand',
			), 'https://twitter.com/intent/tweet' );
	?>
	<a class="twitter-share-button" href="<?php echo esc_url( $twitter_url ); ?>"></a>
	<div class="fb-like" data-href="<?php $obj->the_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="false"></div>
</div>
