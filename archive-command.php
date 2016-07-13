<?php get_header(); ?>

	<div class="site-content">

		<?php if ( have_posts() ) : ?>

			<div class="row">
				<div class="columns">

				<?php echo runcommand::get_template_part( 'archive-page-header' ); ?>

				<ul>
					<?php while( have_posts() ) : the_post(); ?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> - <?php echo get_the_excerpt(); ?></li>
					<?php endwhile; ?>
				</ul>

				</div>

				<?php echo runcommand::get_template_part( 'pagination' ); ?>

			</div>

		<?php endif; ?>

	</div>

<?php get_footer(); ?>
