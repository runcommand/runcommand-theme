<?php get_header(); ?>

	<div class="site-content">

		<?php if ( have_posts() ) : ?>

			<div class="row">
				<div class="columns">

				<?php while( have_posts() ) : the_post(); ?>

						<header class="page-header">
							<h2><?php the_title(); ?><?php edit_post_link( ' <small><i class="fa fa-pencil"></i></small>' ); ?></h2>
						</header>

						<div class="page-content">
							<?php
								$commands = get_posts( array(
									'connected_type'  => 'command_to_excerpt',
									'connected_items' => get_the_ID(),
									'post_type'       => 'command',
								) );
								foreach( $commands as $command ) : ?>
									<div class="panel callout">
										<p><a href="<?php echo get_permalink( $command->ID ); ?>"><strong>wp <?php echo apply_filters( 'the_title', $command->post_title ); ?></strong></a> - <?php echo $command->post_excerpt; ?></p>
									</div>
								<?php endforeach; ?>
							<?php the_content(); ?>
							<div class="content-meta row">
								<div class="columns small-8">
									<?php echo runcommand::get_template_part( 'share-buttons', array(
										'obj'  => runcommand\Query::get_post_by_id( get_the_ID() ),
									) ); ?>
								</div>
								<div class="columns small-4">
									<div class="right"><em>Updated <?php the_modified_date(); ?></em></div>
								</div>
							</div>
						</div>

				<?php endwhile; ?>

				</div>

			</div>

		<?php endif; ?>

	</div>

<?php get_footer(); ?>
