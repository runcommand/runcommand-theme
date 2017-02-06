<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header class="site-header">
		<div class="row show-for-medium-up">
			<div class="columns">
				<ul class="inline-list connect right">
					<li><a href="mailto:hello@runcommand.io">hello@runcommand.io</a></li>
					<li><a href="https://github.com/runcommand"><i class="fa fa-github"></i></a></li>
					<li><a href="https://twitter.com/runcommand"><i class="fa fa-twitter"></i></a></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="columns medium-5 large-6">
				<a class="site-title" href="<?php echo home_url( '/' ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/running-man.svg' ); ?>">runcommand</a>
			</div>
		</div>
	</header>

