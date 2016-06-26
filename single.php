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
							<p class="page-meta"><?php the_author(); ?> - <?php the_date(); ?></p>
							<?php the_content(); ?>
						</div>

				<?php endwhile; ?>

				</div>

			</div>

		<?php endif; ?>

	</div>

<?php get_footer(); ?>
