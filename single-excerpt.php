<?php get_header(); ?>

	<div class="site-content">

		<?php if ( have_posts() ) : ?>

			<div class="row">
				<div class="columns medium-9">

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
								$matched_command = false;
								foreach( $commands as $command ) : ?>
									<div class="panel">
										<p><a href="<?php echo get_permalink( $command->ID ); ?>"><strong>wp <?php echo apply_filters( 'the_title', $command->post_title ); ?></strong> - <?php echo $command->post_excerpt; ?></a></p>
									</div>
								<?php 
								$matched_command = $command->ID;
								break;
								endforeach; ?>
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

				<div class="columns medium-3 sidebar">
					<?php
					$commands = get_posts( array(
						'post_type'       => 'command',
						'post_name__in'   => array( 'profile', 'doctor' ),
					) );
					if ( ! empty( $commands ) ) : ?>
					<h5>Premium Commands</h5>
					<ul>
						<?php foreach( $commands as $command ) : ?>
							<li><a href="<?php echo get_permalink( $command->ID ); ?>"><?php echo apply_filters( 'the_title', $command->post_title ); ?></a> - <?php echo str_replace( array( '<p>', '</p>' ), '', apply_filters( 'the_excerpt', $command->post_excerpt ) ); ?></li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
					<?php
					$args = array( 'post_type' => 'excerpt' );
					if ( $matched_command ) {
						$args['connected_type'] = 'command_to_excerpt';
						$args['connected_items'] = $matched_command;
					}
					$excerpts = get_posts( $args );
					if ( ! empty( $excerpts ) ) : ?>
					<h5><?php echo $matched_command ? 'Related ' : ''; ?>Excerpts</h5>
					<ul>
						<?php foreach( $excerpts as $excerpt ) : ?>
							<li><a href="<?php echo get_permalink( $excerpt->ID ); ?>"><?php echo apply_filters( 'the_title', $excerpt->post_title ); ?></a></li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
				</div>

			</div>

		<?php endif; ?>

	</div>

<?php get_footer(); ?>
