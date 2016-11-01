<?php get_header(); ?>

	<div class="site-content">

		<?php if ( have_posts() ) : ?>
			<div class="row">
				<div class="columns medium-9">

				<?php while( have_posts() ) : the_post(); ?>

						<header class="page-header">
							<h2>wp <?php the_title(); ?><?php edit_post_link( ' <small><i class="fa fa-pencil"></i></small>' ); ?></h2>
						</header>

						<div class="page-content">
							<?php the_content(); ?>
							<div class="content-meta row">
								<div class="columns">
									<?php echo runcommand::get_template_part( 'share-buttons', array(
										'obj'  => runcommand\Query::get_post_by_id( get_the_ID() ),
									) ); ?>
								</div>
							</div>
						</div>

				<?php endwhile; ?>

				</div>

				<div class="columns medium-3 sidebar">
					<?php
					$posts = get_posts( array(
						'connected_type'  => 'command_to_post',
						'connected_items' => get_the_ID(),
						'post_type'       => 'post',
					) );
					if ( ! empty( $posts ) ) : ?>
					<h5>Updates</h5>
					<ul>
						<?php foreach( $posts as $p ) : ?>
							<li><a href="<?php echo get_permalink( $p->ID ); ?>"><?php echo apply_filters( 'the_title', $p->post_title ); ?></a></li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
					<?php
					$excerpts = get_posts( array(
						'connected_type'  => 'command_to_excerpt',
						'connected_items' => get_the_ID(),
						'post_type'       => 'excerpt',
					) );
					if ( ! empty( $excerpts ) ) : ?>
					<h5>Excerpts</h5>
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
