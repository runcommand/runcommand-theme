<?php get_header(); ?>

	<div class="site-content">

		<div class="row">
			<div class="columns">

			<header class="page-header">
				<h2 class="page-title"><?php echo esc_html( get_queried_object()->label ); ?></h2>
				<div class="page-description">
					<p><?php echo esc_html( get_queried_object()->description ); ?></p>
					<p>When you think "how can I do this with WP-CLI?", you'll find your answer in an excerpt.</p>
				</div>
			</header>

		<?php if ( have_posts() ) : ?>

			<ul>
				<?php while( have_posts() ) : the_post(); ?>
					<li>
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<?php the_excerpt(); ?>
					</li>
				<?php endwhile; ?>
			</ul>

		<?php endif; ?>

			</div>

		</div>

	</div>

<?php get_footer(); ?>
