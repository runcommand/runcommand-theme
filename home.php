<?php get_header(); ?>

	<div class="site-content">
		<div class="row">

			<div class="columns">

				<div class="page-content">
					<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">runcommand</a> is the first of its kind, blending enterprise support and custom development to effectively maintain the infrastructure your WordPress-based business depends on.</p>
					
					<p>Learn more about runcommand's offerings for <a href="<?php echo home_url( 'for-hosts/' ); ?>">managed WordPress hosts</a> and <a href="<?php echo home_url( 'for-agencies/' ); ?>">WordPress agencies</a>.</p>

					<?php
						$command_query = new WP_Query( array(
							'post_type'      => 'command',
							'posts_per_page' => 5,
							'post_status'    => 'publish',
						)); ?>
					<?php if ( $command_query->have_posts() ) : ?>
						<p>Check out runcommand's recently updated WP-CLI commands:</p>
						<ul>
						<?php while( $command_query->have_posts() ) : $command_query->the_post(); ?>
							<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> - <?php echo get_the_excerpt(); ?></li>
						<?php endwhile; ?>
						</ul>
						<p>Or, <a href="<?php echo esc_url( home_url( 'commands/' ) ); ?>">view all commands</a>.</p>
					<?php endif; ?>
				</div>

			</div>

		</div>
	</div>

<?php get_footer(); ?>
