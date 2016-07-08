<?php get_header(); ?>

	<div class="site-content">

		<?php if ( have_posts() ) : ?>

			<div class="row">
				<div class="columns">

				<?php while( have_posts() ) : the_post(); ?>

						<header class="page-header">
							<?php $post_type_object = get_post_type_object( get_post_type() ); ?>
							<h5><a href="<?php echo esc_url( get_post_type_archive_link( get_post_type() ) ); ?>"><?php echo esc_html( $post_type_object->label ); ?></a> - <?php echo esc_html( $post_type_object->description ); ?></h5>
							<h2><?php the_title(); ?><?php edit_post_link( ' <small><i class="fa fa-pencil"></i></small>' ); ?></h2>
						</header>

						<div class="page-content">
							<?php the_content(); ?>
						</div>

				<?php endwhile; ?>

				</div>

			</div>

		<?php endif; ?>

	</div>

<?php get_footer(); ?>
