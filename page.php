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
							<?php the_content(); ?>
						</div>

				<?php endwhile; ?>

				</div>

				<div class="columns medium-3 sidebar show-for-medium-up">
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
					$posts = get_posts( array(
						'post_type'       => 'post',
						'posts_per_page'  => 5,
					) );
					if ( ! empty( $posts ) ) : ?>
					<h5>From The Blog</h5>
					<ul>
						<?php foreach( $posts as $p ) : ?>
							<li><a href="<?php echo get_permalink( $p->ID ); ?>"><?php echo apply_filters( 'the_title', $p->post_title ); ?></a></li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
					<?php
					$excerpts = get_posts( array(
						'post_type'       => 'excerpt',
						'posts_per_page'  => 5,
					) );
					if ( ! empty( $excerpts ) ) : ?>
					<h5>Recent How-Tos</h5>
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
