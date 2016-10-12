
	<footer class="site-footer">
		<?php if ( empty( get_queried_object()->post_content ) || ! has_shortcode( get_queried_object()->post_content, 'newsletter-signup' ) ) : ?>
		<div class="row">
			<div class="columns">
				<?php echo \runcommand::get_template_part( 'newsletter-signup' ); ?>
			</div>
		</div>
		<?php endif; ?>
		<div class="row">
			<div class="columns medium-3">
				<h4><a href="<?php echo esc_url( home_url( '/' ) ); ?>">runcommand</a></h4>
				<ul class="footer-list">
					<li><a href="<?php echo esc_url( home_url( 'about/' ) ); ?>">About</a></li>
					<li><a href="<?php echo esc_url( home_url( 'blog/' ) ); ?>">Blog</a></li>
					<li><a href="<?php echo esc_url( home_url( 'for-hosts/' ) ); ?>">For Hosts</a></li>
					<li><a href="<?php echo esc_url( home_url( 'for-agencies/' ) ); ?>">For Agencies</a></li>
					<?php /* <li><a href="<?php echo esc_url( home_url( 'pricing/' ) ); ?>">Pricing</a></li> */ ?>
					<li><a href="<?php echo esc_url( home_url( 'contact/' ) ); ?>">Contact</a></li>
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
			<div class="columns medium-3">
				<?php
				$spark_query = new WP_Query( array(
					'post_type'      => 'spark',
					'posts_per_page' => 2,
					'post_status'    => 'publish',
				)); ?>
				<h4><a href="<?php echo esc_url( home_url( 'sparks/' ) ); ?>">Sparks <small>(<?php echo (int) $spark_query->found_posts; ?>)</small></a></h4>
				<ul class="footer-list">
					<?php if ( $spark_query->have_posts() ) : ?>
						<?php while( $spark_query->have_posts() ) : $spark_query->the_post(); ?>
							<li><a title="<?php echo esc_attr( get_the_excerpt() ); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
						<?php endwhile; ?>
					<?php endif; ?>
				</ul>
			</div>
			<div class="columns medium-3 end">
				<?php
				$excerpt_query = new WP_Query( array(
					'post_type'      => 'excerpt',
					'posts_per_page' => 2,
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
					<small>Made in <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/oregon.svg' ); ?>" alt="Tualatin, Oregon" /> by runcommand, LLC. &bull; <a href="https://github.com/runcommand"><i class="fa fa-github"></i> Github</a> &bull; <a href="https://twitter.com/runcommand"><i class="fa fa-twitter"></i> Twitter</a></small>
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

	<script async>window.twttr = (function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0],
		t = window.twttr || {};
		if (d.getElementById(id)) return t;
		js = d.createElement(s);
		js.id = id;
		js.src = "https://platform.twitter.com/widgets.js";
		fjs.parentNode.insertBefore(js, fjs);

		t._e = [];
		t.ready = function(f) {
		t._e.push(f);
		};

		return t;
	}(document, "script", "twitter-wjs"));</script>

	<div id="fb-root"></div>
	<script async>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

</body>
</html>
