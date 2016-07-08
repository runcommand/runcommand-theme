<header class="page-header">
<?php
	$edit_link = '';
	if ( current_user_can( get_queried_object()->cap->edit_posts ) ) {
		$edit_link = add_query_arg( 'post_type', get_queried_object()->name, admin_url( 'edit.php' ) );
		$edit_link = ' <a href="' . esc_url( $edit_link ) . '"><small><i class="fa fa-pencil"></i></small></a>';
	}
?>
<h2 class="page-title"><?php echo esc_html( get_queried_object()->label ); ?><?php echo $edit_link; ?></h2>
	<div class="page-description">
		<p><?php echo esc_html( get_queried_object()->description ); ?></p>
		<?php if ( ! empty( $extended_description ) ) : ?>
			<?php echo wpautop( $extended_description ); ?>
		<?php endif; ?>
	</div>
</header>
