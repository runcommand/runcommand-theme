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
		<div class="row">
			<div class="columns">
				<a class="site-title" href="<?php echo home_url( '/' ); ?>">runcommand</a> - <span class="site-description"><?php bloginfo( 'description' ); ?></span>
			</div>
		</div>
		<div class="row">
			<div class="columns">
				<ul class="inline-list right header-nav">
					<li><a href="<?php echo esc_url( home_url( 'for-hosts/' ) ); ?>">For Hosts</a></li>
					<li><a href="<?php echo esc_url( home_url( 'for-agencies/' ) ); ?>">For Agencies</a></li>
					<li><a href="<?php echo esc_url( home_url( 'commands/' ) ); ?>">Commands</a></li>
				</ul>
			</div>
		</div>
	</header>

