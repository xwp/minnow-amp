<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Minnow_AMP
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1"><?php // Minnow mod: added minimum-scale=1. ?>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<?php
// Minnow mod: added [class] attribute and amp-state.
$body_classes = get_body_class();
?>
<body
	class="<?php echo esc_attr( implode( ' ', $body_classes ) ); ?>"
	[class]="minnow.bodyClasses.concat( minnow.navMenuExpanded ? 'sidebar-open' : '' ).filter( className => '' != className )"
>
<amp-state id="minnow">
	<?php
	$state = array(
		'bodyClasses'     => $body_classes,
		'navMenuExpanded' => false,
	)
	?>
	<script type="application/json"><?php echo wp_json_encode( $state ); ?></script>
</amp-state>

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'minnow' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<div class="site-branding">
			<?php the_custom_logo(); ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>

		<?php if ( has_nav_menu ( 'social' ) ) : ?>
			<?php wp_nav_menu( array( 'theme_location' => 'social', 'depth' => 1, 'link_before' => '<span class="screen-reader-text">', 'link_after' => '</span>', 'container_class' => 'social-links', ) ); ?>
		<?php endif; ?>

		<?php if ( has_nav_menu ( 'primary' ) || is_active_sidebar( 'sidebar-1' ) ) : ?>
			<?php // Minnow mod: added on attribute. ?>
			<button class="menu-toggle" on="tap:AMP.setState({ minnow: { navMenuExpanded: ! minnow.navMenuExpanded } })" title="<?php esc_attr_e( 'Sidebar', 'minnow' ); ?>"><span class="screen-reader-text"><?php _e( 'Sidebar', 'minnow' ); ?></span></button>
		<?php endif; ?>

		<div class="slide-menu" [class]="'slide-menu' + ( minnow.navMenuExpanded ? ' expanded' : '' )"><?php // Minnow mod: added amp-bind attribute ?>
			<?php if ( has_nav_menu ( 'primary' ) ) : ?>
				<h2 class="widget-title"><?php _e( 'Menu', 'minnow' ); ?></h2>
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				</nav><!-- #site-navigation -->
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'sidebar-1' ) ) {
				get_sidebar();
			} ?>

		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
