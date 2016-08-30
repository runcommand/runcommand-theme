<?php get_header(); ?>

	<div class="site-content">

		<?php if ( have_posts() ) : ?>

			<div class="row">
				<div class="columns">

				<?php while( have_posts() ) : the_post(); ?>

						<header class="page-header">
							<?php
								$button_label = get_post_meta( get_the_ID(), 'purchase_button_label', true );
								$button_url = get_post_meta( get_the_ID(), 'purchase_button_url', true );
								?>
							<?php if ( $button_label && $button_url ) : ?>
							<div class="right">
								<a class="button" href="<?php echo esc_url( $button_url ); ?>"><?php echo esc_html( $button_label ); ?></a>
							</div>
							<?php endif; ?>
							<h2>wp <?php the_title(); ?><?php edit_post_link( ' <small><i class="fa fa-pencil"></i></small>' ); ?></h2>
						</header>

						<div class="page-content">
							<div class="content-meta row">
								<div class="columns">
									<?php echo runcommand::get_template_part( 'share-buttons', array(
										'obj'  => runcommand\Query::get_post_by_id( get_the_ID() ),
									) ); ?>
								</div>
							</div>
							<?php the_content(); ?>
						</div>

				<?php endwhile; ?>

				</div>

			</div>

		<?php endif; ?>

	</div>

<?php get_footer(); ?>
