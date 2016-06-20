
	<footer class="site-footer">
		<div class="row">
			<div class="columns">
				<!-- Begin MailChimp Signup Form -->
				<div id="mc_embed_signup">
				<form action="//runcommand.us13.list-manage.com/subscribe/post?u=65c9e1ec3c097ee95eb468c9f&amp;id=5b6f61b116" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
				    <div id="mc_embed_signup_scroll">
				<div class="mc-field-group">
					<div class="row collapse">
						<div class="columns small-5 medium-3">
							<label for="mce-EMAIL" class="prefix">Sign up for updates</label>
						</div>
						<div class="columns small-7 medium-7">
							<input type="email" placeholder="Email address" value="" name="EMAIL" class="required email" id="mce-EMAIL">
						</div>
						<div class="columns small-12 medium-2">
							<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button postfix">
						</div>
					</div>
				</div>
					<div id="mce-responses" class="clear">
						<div class="response" id="mce-error-response" style="display:none"></div>
						<div class="response" id="mce-success-response" style="display:none"></div>
					</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
				    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_65c9e1ec3c097ee95eb468c9f_5b6f61b116" tabindex="-1" value=""></div>
				    </div>
				</form>
				</div>
				<!--End mc_embed_signup-->
			</div>
		</div>
		<div class="row">
			<div class="columns medium-3">
				<h4><a href="<?php echo esc_url( home_url( '/' ) ); ?>">runcommand</a></h4>
				<ul class="footer-list">
					<li><a href="#">About</a></li>
					<li><a href="<?php echo esc_url( home_url( 'for-hosts/' ) ); ?>">For Hosts</a></li>
					<li><a href="<?php echo esc_url( home_url( 'for-agencies/' ) ); ?>">For Agencies</a></li>
					<li><a href="<?php echo esc_url( home_url( 'pricing/' ) ); ?>">Pricing</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
			</div>
			<div class="columns medium-3">
				<?php
					$command_query = new WP_Query( array(
						'post_type'      => 'command',
						'posts_per_page' => 5,
						'post_status'    => 'publish',
						'orderby'        => 'modified',
					)); ?>
				<h4><a href="<?php echo esc_url( home_url( 'commands/' ) ); ?>">Commands <small>(<?php echo (int) $command_query->found_posts; ?>)</small></a></h4>
				<ul class="footer-list">
				<?php if ( $command_query->have_posts() ) : ?>
					<?php while( $command_query->have_posts() ) : $command_query->the_post(); ?>
						<li><a title="<?php echo esc_attr( get_the_excerpt() ); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endwhile; ?>
				<?php endif; ?>
				</ul>
			</div>
			<div class="columns medium-3 end">
				<?php
				$excerpt_query = new WP_Query( array(
					'post_type'      => 'excerpt',
					'posts_per_page' => 3,
					'post_status'    => 'publish',
					'orderby'        => 'modified',
				)); ?>
				<h4><a href="<?php echo esc_url( home_url( 'excerpts/' ) ); ?>">Excerpts <small>(<?php echo (int) $excerpt_query->found_posts; ?>)</small></a></h4>
				<ul class="footer-list">
					<?php if ( $excerpt_query->have_posts() ) : ?>
						<?php while( $excerpt_query->have_posts() ) : $excerpt_query->the_post(); ?>
							<li><a title="<?php echo esc_attr( get_the_excerpt() ); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
						<?php endwhile; ?>
					<?php endif; ?>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="columns text-center">
				<div class="made-by">
					<small>Made in <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/oregon.svg' ); ?>" /> by runcommand, LLC. &bull; <a href="https://github.com/runcommand"><i class="fa fa-github"></i> Github</a> &bull; <a href="https://twitter.com/runcommand"><i class="fa fa-twitter"></i> Twitter</a></small>
				</div>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>

	<?php if ( 'runcommand.io' === parse_url( home_url(), PHP_URL_HOST )
		&& ! current_user_can( 'manage_options' ) ) : ?>
		<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-75452026-1', 'auto');
		ga('send', 'pageview');

		</script>
	<?php endif; ?>

</body>
</html>
