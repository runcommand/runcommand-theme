<?php get_header(); ?>

	<div class="site-content">

		<div class="row">
			<div class="columns">

			<?php echo runcommand::get_template_part( 'archive-page-header', array(
				'extended_description' => 'Sparks represent the runcommand roadmap. Each spark starts with an idea for a problem to be solved. Once a spark has a proposed algorithm and sufficient backers, it grows into a WP-CLI command maintained by runcommand.',
			) ); ?>

		<?php if ( have_posts() ) : ?>

			<table>
				<thead>
					<tr>
						<td class="spark-column">Spark</td>
						<td class="problem-column">Problem</td>
						<td width="75" class="stage-column">Stage</td>
					</tr>
				</thead>
				<tbody>
				<?php while( have_posts() ) : the_post(); ?>
					<tr>
						<td>
							<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
						</td>
						<td>
							<?php the_excerpt(); ?>
						</td>
						<td>
							<a href="<?php the_permalink(); ?>">Idea</a>
						</td>
					</tr>
				<?php endwhile; ?>
				</tbody>
			</table>

		<?php endif; ?>

			</div>

		</div>

	</div>

<?php get_footer(); ?>
