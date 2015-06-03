<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Material Design
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	
	<?php
		$primary = array(
			'theme_location'  => 'primary',
			'menu'            => '',
			'container'       => false,
			'container_class' => false,
			'container_id'    => false,
			'menu_class'      => 'right hide-on-med-and-down',
			'menu_id'         => false,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul id="%1$s" class="%2$s"><li></li>%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
		);
		$primary_mobile = array(
			'theme_location'  => 'primary',
			'menu'            => '',
			'container'       => false,
			'container_class' => false,
			'container_id'    => false,
			'menu_class'      => 'side-nav',
			'menu_id'         => 'mobile-demo',
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
		);
	?>
	
	<header id="masthead" class="site-header" role="banner">
		<nav>
			<div class="container">
				<div class="nav-wrapper">
					<a class="brand-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
					<?php wp_nav_menu( $primary ); ?>
					<?php wp_nav_menu( $primary_mobile ); ?>
				</div>
			</div>
		</nav>
	</header><!-- #masthead -->
	<p>&nbsp;</p>
	<div id="content" class="site-content">
