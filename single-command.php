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
					$title = 'Updates';
					if ( empty( $posts ) ) {
						$posts = get_posts( array(
							'post_type'       => 'post',
							'posts_per_page'  => 5,
						) );
						$title = 'From The Blog';
					}
					if ( ! empty( $posts ) ) : ?>
					<h5><?php echo $title; ?></h5>
					<ul>
						<?php foreach( $posts as $p ) : ?>
							<li><a href="<?php echo get_permalink( $p->ID ); ?>"><?php echo apply_filters( 'the_title', $p->post_title ); ?></a></li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
					<?php
					$tips = get_posts( array(
						'connected_type'  => 'command_to_tip',
						'connected_items' => get_the_ID(),
						'post_type'       => 'tip',
					) );
					if ( empty( $tips ) ) {
						$tips = get_posts( array(
							'post_type'       => 'tip',
							'posts_per_page'  => 5,
						) );
					}
					if ( ! empty( $tips ) ) : ?>
					<h5>Recent Tips</h5>
					<ul>
						<?php foreach( $tips as $tip ) : ?>
							<li><a href="<?php echo get_permalink( $tip->ID ); ?>"><?php echo apply_filters( 'the_title', $tip->post_title ); ?></a></li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
				</div>

			</div>

		<?php endif; ?>

	</div>

<?php get_footer(); ?>
