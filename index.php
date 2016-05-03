<?php get_header(); ?>

	<script>
		window.runcommandInitialState = <?php echo json_encode( runcommand\REST\API::get_initial_state() ); ?>;
		window.runcommandGoogleAnalytics = <?php echo json_encode( 'runcommand.io' === parse_url( home_url(), PHP_URL_HOST ) ? 'UA-75452026-1' : 'UA-00000000-0' ); ?>;
	</script>

	<div id="app"></div>

<?php get_footer(); ?>
