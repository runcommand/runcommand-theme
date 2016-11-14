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
							<div class="content-meta content-meta-top row">
								<div class="columns medium-7">
									<a href="https://twitter.com/danielbachhuber">@danielbachhuber</a> - <?php the_date(); ?>
								</div>
							</div>
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
					$tips = get_posts( array(
						'post_type'       => 'tip',
						'posts_per_page'  => 5,
					) );
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
