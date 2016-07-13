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
							<div class="content-meta row">
								<div class="columns medium-7">
									<a href="https://twitter.com/danielbachhuber">@danielbachhuber</a> - <?php the_date(); ?>
								</div>
								<div class="columns medium-5">
									<a class="twitter-share-button" href="https://twitter.com/intent/tweet">Tweet</a>
									<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="standard" data-action="like" data-show-faces="true"></div>
								</div>
							</div>
							<?php the_content(); ?>
						</div>

				<?php endwhile; ?>

				</div>

			</div>

		<?php endif; ?>

	</div>

<?php get_footer(); ?>
