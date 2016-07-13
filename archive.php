<?php get_header(); ?>

	<div class="site-content">

		<div class="row">
			<div class="columns">

			<?php echo runcommand::get_template_part( 'archive-page-header' ); ?>

		<?php if ( have_posts() ) : ?>

			<ul>
				<?php while( have_posts() ) : the_post(); ?>
					<li>
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<?php the_excerpt(); ?>
					</li>
				<?php endwhile; ?>
			</ul>

			<?php echo runcommand::get_template_part( 'pagination' ); ?>

		<?php endif; ?>

			</div>

		</div>

	</div>

<?php get_footer(); ?>
