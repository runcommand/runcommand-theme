<?php get_header(); ?>

	<script>
		window.runcommandInitialState = <?php echo json_encode( runcommand\REST\API::get_initial_state() ); ?>
	</script>

	<div id="app"></div>

<?php get_footer(); ?>
