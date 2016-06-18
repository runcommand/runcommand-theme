<?php get_header(); ?>

	<div class="site-content">

		<?php if ( have_posts() ) : ?>

			<div class="row">
				<div class="columns">

				<p>A list of the WP-CLI commands maintained by runcommmand.</p>

				<ul>
					<?php while( have_posts() ) : the_post(); ?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> - <?php echo get_the_excerpt(); ?></li>
					<?php endwhile; ?>
				</ul>

				</div>

			</div>

		<?php endif; ?>

	</div>

<?php get_footer(); ?>
