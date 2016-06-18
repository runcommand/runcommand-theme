
	<footer class="site-footer">
		<div class="row">
			<div class="columns">
				<a href="<?php echo home_url( '/' ); ?>">runcommand</a> - Premium WP-CLI services for WordPress-based businesses, brought to you by Daniel Bachhuber, the maintainer of WP-CLI.
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>

	<?php if ( 'runcommand.io' === parse_url( home_url(), PHP_URL_HOST ) ) : ?>
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
